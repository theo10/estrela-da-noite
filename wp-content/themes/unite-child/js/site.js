jQuery(document).ready(function(){
   var imgModal = jQuery('#myModal');
   jQuery('li').find('img').on('click',function(){
		var src = jQuery(this).attr('src');
		var title = jQuery(this).siblings('h4').text();
		var img = '<img src="' + src + '" class="img-responsive"/>';
		imgModal.find('.modal-body').html(img);
		imgModal.find('.modal-title').html(title);
		imgModal.modal();
   }); 
   
	imgModal.on('hidden.bs.modal', function(){
		jQuery('#myModal').find('.modal-body').html('');
		jQuery('#myModal').find('.modal-title').html('');
	});

	jQuery('li').find('h4').on('click',function(){
		jQuery(this).siblings('img').trigger('click');
	});	
	
	jQuery('.vote-btn').on('click', function(e){
		var currentTarget = jQuery(e.currentTarget);
		jQuery('#postID').val(currentTarget.attr('rel'));
		jQuery('#myFormModal').modal();
		return false;
	});
		
})