<?php
/**
 * Template Name: Winner
 *
 * 
 */

get_header(); 
$home = get_home_url();
global $post;
global $wpdb;
	
$prefix = $wpdb->base_prefix;
$sql = "select a.id, a.post_title,a.votes,a.name from (select p.ID,p.post_title,count(v.ID) as votes,t.name 
		from ".$wpdb->posts." p left join
		".$prefix."votes v on v.postid=p.ID 
		inner join ".$wpdb->term_relationships." tr on 
		tr.object_id=p.ID inner join ".$wpdb->terms." t on
		t.term_id=tr.term_taxonomy_id 
		where post_type = 'star'
		group by p.ID order by t.name ASC, votes desc) a group by a.name";
$votes = $wpdb->get_results($sql, ARRAY_A);
?>

	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
			<h3>Star of the Night</h3>
			<ul class="row star-list">
			<?php 
			foreach($votes as $vote){
				$id = $vote['id'];
			?>
			<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?php 
				if ( has_post_thumbnail($id) ) {
					echo get_the_post_thumbnail($id,'full',array('class'=>'fullImage')); 
				}
				?>
				<h4><?php echo $vote['post_title'];?></h4>
			</li>
			<?php } 
			?>
			</ul>
			

		</main><!-- #main -->
	</div><!-- #primary -->
  
<?php get_footer(); ?>
