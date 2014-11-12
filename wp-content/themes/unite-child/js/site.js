jQuery(document).ready(function(){
    var imgModal = jQuery('#myModal'),
		li = jQuery('.star-list').find('li');
    li.find('img').on('click',function(){
		var src = jQuery(this).siblings('.fullImage').attr('src');
		var title = jQuery(this).siblings('h4').text();
		var img = '<img src="' + src + '" class="img-responsive"/>';

		imgModal.find('.modal-body').html(img);
		imgModal.find('.modal-title').html(title);

		imgModal.modal();
    }); 
   
	imgModal.on('hidden.bs.modal', function(){
		imgModal.find('.modal-body').html('');
		imgModal.find('.modal-title').html('');
	});
	
	li.find('h4').on('click',function(){
		jQuery(this).siblings('img').eq(0).trigger('click');
	});	
	
	jQuery('.vote-btn').on('click', function(e){
		var currentTarget = jQuery(e.currentTarget);
		jQuery('#postID').val(currentTarget.attr('rel'));
		jQuery('#termID').val(currentTarget.data('category'));
		jQuery('#myFormModal').modal();
		return false;
	});
		
})