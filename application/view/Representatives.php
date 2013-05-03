<html>
	<head>
		<title>Reps</title>
		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/admin.css">

		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/chat.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				//ev = event;
				listen('{$base_url}');
				//console.log();
			});

		</script>
	</head>
	<body>
		<div class="greetings" >
	    	Welcome Name | <a href="{$base_url}Auth/Logout?token={$token}">Logout</a>
	    </div>
		Representative logged in
	</body>
</html>