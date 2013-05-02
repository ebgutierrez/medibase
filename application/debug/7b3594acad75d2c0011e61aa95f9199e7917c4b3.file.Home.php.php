<?php /* Smarty version Smarty-3.1.13, created on 2013-03-14 14:18:34
         compiled from "application\view\Home.php" */ ?>
<?php /*%%SmartyHeaderCode:45785141ce2a173e59-32036806%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b3594acad75d2c0011e61aa95f9199e7917c4b3' => 
    array (
      0 => 'application\\view\\Home.php',
      1 => 1362889432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45785141ce2a173e59-32036806',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css' => 0,
    'image' => 0,
    'base_url' => 0,
    'mission' => 0,
    'vision' => 0,
    'services' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5141ce2a3d63e4_41579076',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5141ce2a3d63e4_41579076')) {function content_5141ce2a3d63e4_41579076($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JCABookkeeping Services</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/default.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div class="topWrap">
	<div class="topColumn">
    	<div class="logo">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/logo.png" />
        </div><!--End of logo-->
        <div class="searchBar">
            <p>Searching....</p>
        </div><!--End of searhBar-->
    </div><!--End of topColumn-->
</div><!--End of topWrap-->
<!-- ------------------------------------------------------------------------------- -->
<div class="menuWrap">
    <div class="homeMenu">        
        <div class="menuSide">
            <ul class="ul">
                <li class="menu_selected"><a href="#">Home</a></li>                
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
index.php/Home/services">Services</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
index.php/Home/about_us">About Us</a></li>
                <li><a href="#">Clients</a></li>
                <li><a href="#">Contact Us</a></li>            
            </ul>
        </div><!--closing for menuSide-->
    </div><!--closing for homeMenu-->
</div><!--End of menuWrap-->
<!-- ------------------------------------------------------------------------------- -->
<div class="animationWrap">
	<div class="animation">
		<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/sample-1.jpg" /></div>
    </div><!--End of animation-->
</div><!--End of animationWrap-->
<!-- ------------------------------------------------------------------------------- -->
<div class="bodyWrap">
	<div class="bodyColumn1">
    	<h5>Mission</h5>
        <p class="misDescription">
        	<?php echo $_smarty_tpl->tpl_vars['mission']->value;?>
 
        </p>
    	<h5>Vision</h5>
        <p class="visDescription">
        	<?php echo $_smarty_tpl->tpl_vars['vision']->value;?>
         
        </p> 
   
    </div><!--End of bodyColumn-->
	<div class="bodyColumn2">
        <div class="galleryBody">
            <img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
/YEAH.jpg">
        </div><!--End of galleryBody-->
    </div><!--End of bodyColumn-->
    <div class="clear" style="clear:both;"></div>
    <div class="services">
    	<div class="title">
            <h3>
            	Services Offered
            </h3>
        </div><!--End of servicesTitle-->
        <div class="frontEndImage">
            <table class="frontEndTable">
                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['name'] = 'serviceIndex';
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['services']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['serviceIndex']['total']);
?>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['serviceIndex']['iteration']==1){?>
                        <tr>
                    <?php }?>
                        <td>
                            <div class="img">                  
                             <a href="http://www.google.com">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
<?php echo $_smarty_tpl->tpl_vars['services']->value[$_smarty_tpl->getVariable('smarty')->value['section']['serviceIndex']['index']]['image'];?>
" title="" alt="Pictures"/>
                                <div class="desc"><?php echo $_smarty_tpl->tpl_vars['services']->value[$_smarty_tpl->getVariable('smarty')->value['section']['serviceIndex']['index']]['name'];?>
</div>
                            </a>
                             
                            </div><!--closing of img division-->                
                        </td>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['serviceIndex']['iteration']==$_smarty_tpl->getVariable('smarty')->value['section']['serviceIndex']['loop']){?>
                        </tr>
                    <?php }?>
                <?php endfor; else: ?>
                    <tr><td>No Services found</td></tr>
                <?php endif; ?>
                              
                 
            </table>
     </div><!--End of frontEndImage-->
    </div><!--End of services-->
    <div class="ourPartners">
    	<div class="title"><h3>Our Partners</h3></div>
        <div class="partnersBox1">
            <p><a href="#">Employment Visa Philippines</a></p>
            <p><a href="#">Work Visa Philippines</a></p>
            <p><a href="#">AVEG Visa Philippines</a></p>
            <p><a href="#">Visa Consulting Philippines</a></p>
        </div>
        <div class="partnersBox1">
            <p><a href="#">Employment Visa Philippines</a></p>
            <p><a href="#">Work Visa Philippines</a></p>
            <p><a href="#">AVEG Visa Philippines</a></p>
            <p><a href="#">Visa Consulting Philippines</a></p>      
        </div>
        <div class="partnersBox1">
            <p><a href="#">Employment Visa Philippines</a></p>
            <p><a href="#">Work Visa Philippines</a></p>
            <p><a href="#">AVEG Visa Philippines</a></p>
            <p><a href="#">Visa Consulting Philippines</a></p>        
        </div>
        <div class="partnersBox1">
            <p><a href="#">Employment Visa Philippines</a></p>
            <p><a href="#">Work Visa Philippines</a></p>
            <p><a href="#">AVEG Visa Philippines</a></p>
            <p><a href="#">Visa Consulting Philippines</a></p>       
        </div><!--End of partnersBox1-4 --> 
        <div class="clearfix" style="clear:both"></div>                       
    </div><!--End of ourPartners-->
</div><!--End of bodyWrap-->
<div class="footer">

</div><!--End of footer-->
<div class="copyrights">
    <p>ALrights Reserved JCA Bookkeeping Services 2013</p>
</div><!--End of copyrights-->
</body>
</html>
<?php }} ?>