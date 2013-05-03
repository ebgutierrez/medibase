function centerTheBox(box,h,w){
	console.log('height: ' + h);
	var win_h;
	var win_w;
	var top;
	var left;


	
	win_h = $(window).height();
	win_w = $(window).width();

	top = (win_h - h) / 2;
	left = (win_w - w) / 2;
	console.log(top);
	box.css({
		"top": top + "px",
		"left": left + "px"
	});
}

function openInquiry(){	
	$('.fade-box').show();
	$('.customer_information').show();
}

function closeInquiry(){
	$('.fade-box').hide();
	$('.customer_information').hide();
}