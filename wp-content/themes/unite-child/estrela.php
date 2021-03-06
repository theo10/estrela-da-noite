<?php
/**
 * Template Name: Estrela Da Noite (poll page)
 *
 * 
 */

get_header(); 
$home = get_home_url();
$default_args = array('posts_per_page'=> -1,
					'order'=>'ASC',
					'orderby'=>'title',
					'post_type'=>'star');
global $post;
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
			<h3>Male</h3>
			<ul class="row star-list">
			<?php 
			$default_args['category_name']='male';
			$query = new WP_Query($default_args);
			while ( $query->have_posts() ) {
				$query->the_post();
				$category = get_the_category();
			?>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(array(150,200));
					?>
					<?php the_post_thumbnail('large',array('class'=>'hidden fullImage')); ?>
					<?php
				}
				?>
				<h4><?php the_title();?></h4>
				<a href="<?php the_permalink();?>" class="btn btn-default vote-btn" rel="<?php the_ID();?>" data-category="<?php echo $category[0]->cat_ID;?>">Vote</a>
			</li>
			<?php } 
			wp_reset_postdata();
			?>
			</ul>
			<h3>Female</h3>
			<ul class="row star-list">
			<?php 
			$default_args['category_name']='female';
			$query = new WP_Query($default_args);
			while ( $query->have_posts() ) {
				$query->the_post();
				$category = get_the_category();
			?>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(array(150,200));
					?>
					<?php the_post_thumbnail('large',array('class'=>'hidden fullImage')); ?>
					<?php
				}
				?>
				<h4><?php the_title();?></h4>
				<a href="<?php the_permalink();?>" class="btn btn-default vote-btn" rel="<?php the_ID();?>" data-category="<?php echo $category[0]->cat_ID;?>">Vote</a>
			</li>
			<?php } 
			wp_reset_postdata();
			?>
			</ul>

		</main><!-- #main -->
	</div><!-- #primary -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"> 
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title"></h4>
		  </div>
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<div class="modal fade" id="myFormModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myFormModalLabel" aria-hidden="true">
		 <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Use your CORP ID to vote</h4>
	     		 </div>
				<div class="modal-body">
					<div id="vote-form">
						<form class="form-inline" role="form" method="post">
							<div class="form-group">
								<label class="sr-only" for="corpID">Corp ID</label>
								<input type="text" required="required" class="form-control" id="corpID" name="corpID" placeholder="Corp ID" />
							 </div>
							<?php wp_nonce_field('votesubmit') ?>
							<input type="hidden" id="postID" name="postID" value="" />
							<input type="hidden" id="pageID" name="pageID" value="<?php echo ($post->ID==1)?6:$post->ID;?>" />
							<input type="hidden" id="termID" name="termID" value="<?php echo $category[0]->cat_ID;?>" />
							<input type="hidden" id="action" name="action" value="submitvote" />
							<input type="submit" class="btn btn-default" value="Vote" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
