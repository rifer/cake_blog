$('#search').on('click', function(){
	$('section .form').removeClass('hide').animate({width:'90%'});
	$(this).parent('.columns').addClass('hide');
})