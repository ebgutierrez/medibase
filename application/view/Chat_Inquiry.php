<html>
	<head>
		<title>JCA Live Inquiry</title>

		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
	</head>
	<body>
		{$load_errors}
		<form method="POST" action="{$base_url}Chat/inquire?u_id={$uid}&start=true">
			<table>
				<tr>
					<th>Last Name <font color="red">*</font>:</th>
					<td><input type="text" name="lastname" value={$lastname}></td>
					<input type="hidden" name="uid" value="{$uid}">
					<input type="hidden" name="inquiry_type" value="1">
				</tr>
				<tr>
					<th>First Name <font color="red">*</font>:</th>
					<td><input type="text" name="firstname" value={$firstname}></td>
				</tr>
				<tr>
					<th>Email <font color="red">*</font>:</th>
					<td><input type="text" name="email" value={$email}></td>
				</tr>
				<tr>
					<th>Subject <font color="red">*</font>:</th>
					<td><input type="text" name="subject" value={$subject}></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>