<?php
/**
 * Template Name: Estrela Da Noite (poll page)
 *
 * 
 */

get_header(); 
$home = get_home_url();
?>

	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title();?></h3>
			<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('full');
				}
				the_content();
			?>
			<form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="corpID">Corp ID</label>
					<input type="text" required="required" class="form-control" id="corpID" placeholder="Corp ID" />
				 </div>
				<input type="submit" class="btn btn-default" value="Vote" />
			</form>
		<?php endwhile; // end of the loop. ?>
			
		</main><!-- #main -->
	</div><!-- #primary -->
   
<?php get_footer(); ?>
