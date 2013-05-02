var t = 0;
var m = 0;
var myWindow = new Array();


function listen(base_url){
	t = setInterval(function(){listenForNewInquiry(base_url)},3000);
}

function getMessage(base_url,type_id,client_user_session_id,from,to){
	m = setInterval(function(){getChatMessage(base_url,type_id,client_user_session_id,from,to)},1500);
}

function listenForNewInquiry(base_url){
	$.ajax({
		url: base_url + 'Auth/Support/listenForNewInquiry',
		success:function(result){
			console.log(result);
			if(result != 0) {
				
				var url = base_url + 'Auth/Support/startChat?' + result;
			    var windowName = "session_" + result;
			    var windowSize = 'width=400,height=500,scrollbars=yes,resizable=no';

			    
			    myWind = window.open(url, windowName, windowSize);

			    myWind.onbeforeunload = function(){
			    	isSessionActive(base_url, result);
			    };
			}
		}
	});
}

function isSessionActive(base_url,result){
	var cus_id;

	var explodedResult = result.split('&');
	var cus_id = explodedResult[0].split('=')[1];
	$.ajax({
		url: base_url + 'Auth/Support/isClientUserSessionActive',
		type:'POST',
		data:{
			'cus_id':cus_id
		}
	});
}

function sendChatMessage(base_url,from, to,client_user_session_id,type_id) {
	var message = $('#message_input').val();
	$.ajax({
		url: base_url + 'Chat/sendChatMessage',
		type:'POST',
		data:{
			'from':from,
			'to':to,
			'message':message ,
			'client_user_session_id':client_user_session_id,
			'type_id':type_id
		},
		success:function(result){
			if(result) {
				getChatMessage(base_url,type_id,client_user_session_id,from,to);
				$('#message_input').val('');
				$('#send_button').attr('disabled','disabled');
			}
		}
	});

}

function getChatMessage(base_url,type_id,client_user_session_id,from,to) {
	$.ajax({
		url: base_url + 'Chat/getChatMessage',
		type:'POST',
		data:{
			'from':from,
			'to':to,
			'client_user_session_id':client_user_session_id,
			'type_id':type_id
		},
		dataType : "json",
		success:function(result){
			console.log(result);
			if(result.active == 1) {
				$('.messages').html(result.message);
			} else {
				clearInterval(m);
					
				var z = setTimeout(function(){
					clearTimeout(z);
					var htmlMessage = $('.messages').html();
					$('.messages').html(htmlMessage + '<p>Client has ended the session</p>');
				},500);


				
			}
		}
	});

	$('.messages').scroll(0,1000);
}