<?php
/**
 * Template Name: Estrela Da Noite Template (poll page)
 *
 * 
 */

get_header(); 
$home = get_home_url();
?>

	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
			<h3>Male</h3>
			<ul class="row">
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/jamir.jpg" />
				<h4>Jamir Garcia</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/jamir.jpg" />
				<h4>Jamir Garcia</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/jamir.jpg" />
				<h4>Jamir Garcia</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/jamir.jpg" />
				<h4>Jamir Garcia</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/jamir.jpg" />
				<h4>Jamir Garcia</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			</ul>
			<h3>Female</h3>
			<ul class="row">
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/kitchie.jpg" />
				<h4>Kitchie Nadal</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/kitchie.jpg" />
				<h4>Kitchie Nadal</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/kitchie.jpg" />
				<h4>Kitchie Nadal</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/kitchie.jpg" />
				<h4>Kitchie Nadal</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
			<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<img src="<?php echo $home?>/kitchie.jpg" />
				<h4>Kitchie Nadal</h4>
				<a href="#" class="btn btn-default vote-btn">Vote</a>
			</li>
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
						<form class="form-inline" role="form">
							<div class="form-group">
								<label class="sr-only" for="corpID">Corp ID</label>
								<input type="text" required="required" class="form-control" id="corpID" placeholder="Corp ID" />
							 </div>
							<input type="submit" class="btn btn-default" value="Vote" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
