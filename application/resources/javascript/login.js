$(document).ready(function(){
	var login_box_h;


	login_box_h = $('.login-box').height();

	centerTheBox($('.login-box'),login_box_h);
});

function centerTheBox(box,h){
	console.log('height: ' + h);

	
	var win_h;
	var top;
	var left;


	
	win_h = $(window).height();

	top = (win_h - h) / 2;

	box.css({
		"margin-top": top + "px"
	});
}