<html>
	<head>
		<title>JCA Live Inquiry</title>

		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/chat.css">

		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/chat.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				getMessage('{$base_url}',2,{$client_user_session_id},{$user_id},{$client_id});
			});
		</script>
	</head>
	<body>
			{$subject}
			<div class="messages"></div>
			<textarea name="message" id="message_input" onkeyup="$('#send_button').removeAttr('disabled');"></textarea>
			<input id="send_button" disabled="disabled" type="button" name="send" value="send" onclick="sendChatMessage('{$base_url}',{$user_id},{$client_id},{$client_user_session_id},2)">
	</body>
</html>