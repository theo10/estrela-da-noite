<?php
add_theme_support( 'post-thumbnails' ); 

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
	wp_enqueue_script( 'child-js', get_stylesheet_directory_uri().'/js/site.js','jQuery',null,true);
}

add_action('template_redirect','send_vote',1);

function send_vote(){
	if($_POST!=null){
		if(wp_verify_nonce( $_POST['_wpnonce'], 'votesubmit' )){
			global $wpdb;
			//verify if corpid exists and has not voted yet
			$sql = "select ID from edn_corpid where corpid = '".$_POST['corpID']."'";
			$corpID = $wpdb->get_var($sql);
			$postID = $_POST['postID'] * 1;
			if($corpID!=null){
				$sql = $wpdb->prepare("select ID from edn_votes where corpid = %d",$corpID);
				$votes = $wpdb->get_var($sql);
				if($votes==null){
					//insert vote
					$columns = array('corpid'=>$corpID,
									'postid'=>$postID,
									'datevoted'=>date('Y-m-d'));

					$wpdb->insert("edn_votes",$columns);
					wp_redirect(add_query_arg( 'n', wp_create_nonce ('success_vote'), get_permalink($_POST['pageID']) ));
					exit;
				}else{
					//error, already voted
					wp_redirect(add_query_arg( 'n', wp_create_nonce ('duplicate_vote'), get_permalink($_POST['pageID']) ));
					exit;
				}
				exit;
			}else{
				wp_redirect(add_query_arg( 'n', wp_create_nonce ('corpid_error'), get_permalink($_POST['pageID']) ));
				exit;
			}
		}else{
			//security fail here
			wp_redirect(add_query_arg( 'n', wp_create_nonce ('security_error'), get_permalink($_POST['pageID']) ));
			exit;
		}
	}
}