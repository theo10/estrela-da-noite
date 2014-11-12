<?php
add_theme_support( 'post-thumbnails' ); 

add_image_size( 'star-thumb', 150, 200 );
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
	wp_enqueue_script( 'child-js', get_stylesheet_directory_uri().'/js/site.js','jQuery',null,true);
}

add_action('template_redirect','send_vote',1);

function send_vote(){
	if($_POST!=null && $_POST['action']=='submitvote'){
		if(wp_verify_nonce( $_POST['_wpnonce'], 'votesubmit' )){
			$postID = $_POST['postID'] * 1;
			$termID = $_POST['termID'] * 1;
			if($postID==0 || $termID==0){
				wp_redirect(add_query_arg( 'n', wp_create_nonce ('invalid_vote'), get_permalink($_POST['pageID']) ));
				exit;
			}
			global $wpdb;
			//verify if corpid exists and has not voted yet
			$sql = "select ID from edn_corpid where corpid = '".$_POST['corpID']."'";
			$corpID = $wpdb->get_var($sql);
			if($corpID!=null){
				$sql = $wpdb->prepare("select ID from edn_votes where corpid = %d and termid = %d",$corpID,$termID);
				$votes = $wpdb->get_var($sql);
				if($votes==null){
					//insert vote
					$columns = array('corpid'=>$corpID,
									'postid'=>$postID,
									'termid'=>$termID,
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
$msg = '';
$msgClass='';
if (trim($_GET['n'])!='' && wp_verify_nonce($_GET['n'], 'success_vote') ){
	$msg = 'You have successfully voted. Thank you!';
	$msgClass='bg-info';
}elseif (trim($_GET['n'])!='' && wp_verify_nonce($_GET['n'], 'duplicate_vote') ){
	$msg = "We know you want your chosen one to win but you can only vote once.";
	$msgClass='bg-danger';
}elseif (trim($_GET['n'])!='' && wp_verify_nonce($_GET['n'], 'corpid_error') ){
	$msg = "Your corp ID does not exists. Are you from Nav/SUS?";
	$msgClass='bg-danger';
}elseif (trim($_GET['n'])!='' && wp_verify_nonce($_GET['n'], 'security_error') ){
	$msg = "Nice try but you cannot easily hack me.";
	$msgClass='bg-danger';
}elseif (trim($_GET['n'])!='' && wp_verify_nonce($_GET['n'], 'invalid_vote') ){
	$msg = "I can't recognize what you are submitting.";
	$msgClass='bg-danger';
}

/*admin*/
add_action('admin_menu', 'edn_admin_actions');

function edn_admin_actions() {
    add_menu_page("Star of the Night Votes", "Star of the Night Votes", 'manage_categories', "ednvotes", "edn_admin");
}
function edn_admin() {
	global $wpdb;
	
	$prefix = $wpdb->base_prefix;
	$sql = "select p.ID,p.post_title,count(v.ID) as votes,t.name 
			from ".$wpdb->posts." p left join
			".$prefix."votes v on v.postid=p.ID 
			inner join ".$wpdb->term_relationships." tr on 
			tr.object_id=p.ID inner join ".$wpdb->terms." t on
			t.term_id=tr.term_taxonomy_id 
			where post_type = 'star'
			group by p.ID order by t.name ASC, votes desc";
	$votes = $wpdb->get_results($sql, ARRAY_A);
	//$totalvotes = $wpdb->get_var( "SELECT COUNT(v.ID) as votes FROM 
	//							 ".$wpdb->posts." p inner join ".$prefix."votes v on v.postid=p.ID" );
	//$totalvotestmp = ($totalvotes==0)?1:$totalvotes;

?>
<div class="wrap">  
 <?php    echo "<h2>" . __( 'ASOP Finalists Voting Tally', 'asop_trdom' ) . "</h2>"; ?>  
  
    <table border="1" cellpadding="2">
        <tr>
            <th style="width:180px;">Star of the Night</th>
			<th>Category</th>
            <th>Votes</th>
        </tr>
        <?php
		
        foreach($votes as $vote){
            ?>
            <tr>
                <td><?php echo $vote['post_title']?></td>
                <td><?php echo $vote['name']?></td>
                <td><?php echo $vote['votes']?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<?php } ?>