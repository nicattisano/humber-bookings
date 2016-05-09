$(document).ready(function(){
	$('#login').on('click', function(){
//		console.log('hey');
		$('.create').css({'display': 'none'});
		$('.log').css({'display': 'block'});
		$('.switcherLogin').css({'display':'block'});
		$('.switcherCreate').css({'display':'none'});
	});
	
	$('#create').on('click', function(){
//		console.log('hey');
		$('.create').css({'display': 'block'});
		$('.log').css({'display': 'none'});
		$('.switcherLogin').css({'display':'none'});
		$('.switcherCreate').css({'display':'block'});
	});
	
});