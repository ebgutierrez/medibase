var slidewidth = 960;
var leftItem = 0;
var totalWidth;
var chatClicked = 0;
var supportClicked = 0;
var t = 0;
var w = 0;
var myWind;


$('html').click(function(e){
	console.log(e.target.getAttribute('class') );
	if(
			e.target.getAttribute('class') != 'chat_button_drawer' 	&& 
			e.target.getAttribute('class') != 'chat_button_panel' 	&& 
			e.target.getAttribute('class') != 'chat_online_panel' 	&& 
			chatClicked == 1
	) {

		$('.chat_panel').animate(
			{
				left: '-=263'
			},
			300,
			function(){
				clearInterval(t);
			}
		);
		chatClicked = 0;
	}
});

function display(className){
	$('.' + className).show();
}

function hide(className){
	$('.' + className).hide();	
}

function next(width){
	leftItem++;
	$('.frontEndTable').animate({
		marginLeft: '-='+slidewidth
	},
	1000,
	function(){
		if((width-(leftItem*slidewidth)) <= slidewidth)
			$('.next').hide();
		$('.previous').show();
	});

}

function prev(width) {
	leftItem--;
	$('.frontEndTable').animate({
		marginLeft: '+='+slidewidth
	},
	1000,
	function(){		
		if(leftItem == 0)
			$('.previous').hide();
		$('.next').show();
	});
}

function displayChat(){
	if(chatClicked == 0) {
		t = setInterval(function(){getOnlineReps()},500);
		/*$('.banner_loader').ajaxStart(function(){
			$(this).hide();
			$('.pic_container').show();
		});

		$('.banner_loader').ajaxStop(function(){
			$(this).show();
			$('.pic_container').hide();
		});*/
		$('.chat_panel').animate(
			{
				left: '+=263'
			},
			300
		);
		chatClicked = 1;
	} else {
		/*$('.banner_loader').ajaxStart(function(){
			$(this).show();
			$('.pic_container').hide();
		});

		$('.banner_loader').ajaxStop(function(){
			$(this).hide();
			$('.pic_container').show();
		});*/
		$('.chat_panel').animate(
			{
				left: '-=263'
			},
			300,
			function(){
				clearInterval(t);
			}
		);
		chatClicked = 0;
	}
}

function getOnlineReps(){
	var protocol = window.location.protocol;
	//var host = window.locaton.hostname;
	//console.log(window.location.pathname);

	var base_url = window.location.hostname + window.location.pathname;
	$.ajax({
		url: base_url + 'Chat/getOnline',
		type:"POST",
		data:{'supportClicked':supportClicked},
		success:function(result){			
			$('#chat_online_list_ul').html(result);
		}
	});

	if(supportClicked) {
		$("#chat_online_list_ul li").attr('onclick','');
	} else {

	}
}

function openChatInquiryWindow(user_support_id,base_url,ev){


	var url = base_url + 'Chat/inquire?u_id=' + user_support_id;
    var windowName = "inquire_" + user_support_id;//$(this).attr("name");
    var windowSize = 'width=400,height=500,scrollbars=yes,resizable=no';

    supportClicked = 1;
    
    myWind = window.open(url, windowName, windowSize);

    w = setInterval(function(){checkIfWindowisClosed(base_url,myWind)},500);

    /*myWind.onbeforeunload = function(){
    	deactivateClientUserSession(base_url);
    	
    };

    myWind.onunload = function(){
    	console.log('unload');
    };

    if(myWind.closed){
    	console.log('closed');
    }*/
    

    ev.preventDefault();
}

function checkIfWindowisClosed(base_url,myWind){
	if(myWind.closed){
		deactivateClientUserSession(base_url);
		clearInterval(w);
	}
	/*if(myWind.closed){
    	console.log('closed');
    }*/
}

function deactivateClientUserSession(base_url){
	console.log(base_url);
	$.ajax({
		url:base_url + 'Chat/deactivateClientUserSession',
		success:function(result){
			console.log(result);
			supportClicked = 0;
		}
	});
}