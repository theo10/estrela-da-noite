<?php

get_header(); 
$home = get_home_url();
?>

	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
		<?php
		if($msg!=''){
		?>
			<p id="errorMessage" class="<?php echo $msgClass;?>"><?php echo $msg;?></p>
		<?php
		}
		?>
		<?php while ( have_posts() ) : the_post();
				$category = get_the_category();
			?>
			<h3><?php the_title();?></h3>
			<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('full');
				}
				the_content();
			?>
			<p></p>
			<form class="form-inline" role="form" method="post">
				<div class="form-group">
					<label class="sr-only" for="corpID">Corp ID</label>
					<input type="text" required="required" class="form-control" id="corpID" name="corpID" placeholder="Corp ID" />
				 </div>
				<?php wp_nonce_field('votesubmit') ?>
				<input type="hidden" id="postID" name="postID" value="<?php the_ID();?>" />
				<input type="hidden" id="pageID" name="pageID" value="<?php the_ID();?>" />
				<input type="hidden" id="termID" name="termID" value="<?php echo $category[0]->cat_ID;?>" />
				<input type="hidden" id="action" name="action" value="submitvote" />
				<input type="submit" class="btn btn-default" value="Vote" />
			</form>
		<?php endwhile; // end of the loop. ?>
			
		</main><!-- #main -->
	</div><!-- #primary -->
   
<?php get_footer(); ?>
