jQuery(document).ready(function(){
   jQuery('li').find('img').on('click',function(){
		var src = jQuery(this).attr('src');
		var title = jQuery(this).siblings('h4').text();
		var img = '<img src="' + src + '" class="img-responsive"/>';
		jQuery('#myModal').modal();
		jQuery('#myModal').on('shown.bs.modal', function(){
			jQuery('#myModal').find('.modal-body').html(img);
			jQuery('#myModal').find('.modal-title').html(title);
		});
		jQuery('#myModal').on('hidden.bs.modal', function(){
			jQuery('#myModal').find('.modal-body').html('');
			jQuery('#myModal').find('.modal-title').html('');
		});
   }); 
	jQuery('li').find('h4').on('click',function(){
		jQuery(this).siblings('img').trigger('click');
	});	
	
	jQuery('#myFormModal').on('shown.bs.modal', function(e){
		console.log(e);
	});
		
})