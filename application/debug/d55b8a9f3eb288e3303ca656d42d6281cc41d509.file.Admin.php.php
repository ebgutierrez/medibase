<?php /* Smarty version Smarty-3.1.13, created on 2013-03-14 14:14:09
         compiled from "application\view\Auth\Admin.php" */ ?>
<?php /*%%SmartyHeaderCode:193965141cd21ae74b2-63488477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd55b8a9f3eb288e3303ca656d42d6281cc41d509' => 
    array (
      0 => 'application\\view\\Auth\\Admin.php',
      1 => 1363259768,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193965141cd21ae74b2-63488477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'css' => 0,
    'javascript' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5141cd21ba52f3_16930532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5141cd21ba52f3_16930532')) {function content_5141cd21ba52f3_16930532($_smarty_tpl) {?><html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/default.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/admin.css">


		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['javascript']->value;?>
/jquery.min.js"></script>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="header-wrapper">
					<div class="title">
						<h3><span>JCA Admin</span></h3>
					</div>
					<div class="homeMenu">        
				        <div class="menuSide">
				            <ul class="ul">
				                <li class="menu_selected"><a href="#">Home</a></li>                
				                <li><a href="#">Services</a></li>
				                <li><a href="#">Users</a></li>
				                <li><a href="#">Pages</a></li>
				            </ul>
				        </div><!--closing for menuSide-->
				    </div>
				</div>
			</div>
			<div class="body">
				<div class="inner-body">
					<div class="users-panel">
						<div class="inner-panel">
							<div class="panel-title">
								<span><h5>Users</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									<li>
										<div class="user-img">
											<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>									
									</li>
									<li>
										<div class="user-img">
											<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status offline">Offline</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
									<li>
										<div class="user-img">
											<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
									<li>
										<div class="user-img">
											<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
								</ul>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="footer"></div>
		</div>
	</body>
</html><?php }} ?>