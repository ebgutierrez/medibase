<?php /* Smarty version Smarty-3.1.13, created on 2013-03-14 14:14:33
         compiled from "application\view\Auth\Login.php" */ ?>
<?php /*%%SmartyHeaderCode:109255141cd39caa1d6-45310667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03e9fb383810100cacaa19b723c6dcfedcdff0ad' => 
    array (
      0 => 'application\\view\\Auth\\Login.php',
      1 => 1363087186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109255141cd39caa1d6-45310667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'css' => 0,
    'javascript' => 0,
    'login_title' => 0,
    'form_errors' => 0,
    'error' => 0,
    'username' => 0,
    'csrf_token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5141cd39dfa130_83560836',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5141cd39dfa130_83560836')) {function content_5141cd39dfa130_83560836($_smarty_tpl) {?><html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/login.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/default.css">

		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['javascript']->value;?>
/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['javascript']->value;?>
/login.js"></script>
	</head>

	<body>
		<div class="login-box">
			<div class="login-box-head">
				<?php echo $_smarty_tpl->tpl_vars['login_title']->value;?>

			</div>
			<div class="login-box-body">

				<?php if (count($_smarty_tpl->tpl_vars['form_errors']->value)>0){?>
					<div class="form_error">
						<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form_errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
							<div><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div> 
						<?php } ?>
					</div>
				<?php }?>
				<form method="POST">
					<label>
						<div class="form-label">
							<span >Username</span>
						</div>
					</label>
					<input class="input" type="text" aria-required="true" aria-label="Username" name="username" value = "<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">

					<br>

					<label>
						<div class="form-label">
							<span >Password</span>
						</div>
					</label>
					<input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrf_token']->value;?>
">
					<input class="input" type="password" aria-required="true" aria-label="Password" name="password">

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
</html><?php }} ?>