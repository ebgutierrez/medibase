<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$title}</title>

		<link rel="stylesheet" type="text/css" href="{$css}/login.css">
		<link rel="stylesheet" type="text/css" href="{$css}/default.css">

		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/login.js"></script>
	</head>

	<body>
		<div class="login-box">
			<div class="login-box-head">
				{$login_title}
			</div>
			<div class="login-box-body">

				{$load_errors}
				<form method="POST">
					<label>
						<div class="form-label">
							<span >Username</span>
						</div>
					</label>
					<input class="input" type="text"  name="username" value = "{$username}">

					<br>

					<label>
						<div class="form-label">
							<span >Password</span>
						</div>
					</label>
					<input type="hidden" name="token" value="{$token}">
					<input class="input" type="password" name="password">

					<br>

					<div class="button-container">						
						<input type="submit" value="Submit" name="submit" class="button"/>
						<input type="reset" value="Reset" name="reset" class="button"/>
					</div>
				</form>
			</div>
			<div class="login-box-foot">
			</div>
		</div>
	</body>
</html>