<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JCABookkeeping Services</title>
<link href="{$css}/default.css" type="text/css" rel="stylesheet" />
<link href="{$css}/style.css" type="text/css" rel="stylesheet" />
<link href="{$css}/sage_products.css" type="text/css" rel="stylesheet" />
<link href="{$css}/contact_widget.css" type="text/css" rel="stylesheet" />
<link href="{$css}/contactUs.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
<script type="text/javascript" src="{$javascript}/sage_inquiry.js"></script>
<script type="text/javascript" src="{$javascript}/slide.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            slider('{$base_url}','{$image}');
            var box_h;
            var box_w;


            box_h = $('.customer_information').height();
            box_w = $('.customer_information').width();

            centerTheBox($('.customer_information'),box_h,box_w);
        });
    </script>
</head>

<body>
<div class="topWrap">
	<div class="topColumn">
    	<div class="logo">
        	<img src="{$image}/logo.png" />
            <img src="{$image}/jca_logo2.jpg" />
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
                <li><a href="{$base_url}">Home</a></li>                
                <li class="menu_selected"><a href="{$base_url}Home/services">Services</a></li>
                <li><a href="{$base_url}Home/about_us">About Us</a></li>
                <li><a href="{$base_url}Home/clients">Clients</a></li>
                <li><a href="{$base_url}Home/ContactUs">Contact Us</a></li>            
            </ul>
        </div><!--closing for menuSide-->
    </div><!--closing for homeMenu-->
</div><!--End of menuWrap-->
<!-- ------------------------------------------------------------------------------- -->
<div class="animationWrap">
	<div class="animation">
		<div class="pic_container"></div>
        <div class="banner_loader"><img src="{$image}/loader-green.gif"></div>
    </div><!--End of animation-->
</div><!--End of animationWrap-->
<!-- ------------------------------------------------------------------------------- -->
<div class="bodyWrap">
	
    <div class="page02Body">
      <div class="page02ColumnOne">
        <ul class="verticalMenu">
            {foreach from=$services item=categories}
                <li class="verticalMenuTitle" id="{'cat_'|cat:$categories.cat_id}">{$categories.cat_name}</li>

                {foreach from=$categories.subcat item=subcategories}
                    <li class="{if $subcategories.subcat_name == 'Peachtree (Sage 50)'}category_selected{else}none{/if}">
                        <a href="{$base_url}Home/service?cat_id={$categories.cat_id}&subcat_id={$subcategories.subcat_id}" id="subcat_{$subcategories.subcat_id}_{$categories.cat_id}">
                            {$subcategories.subcat_name}
                        </a>
                    </li>
                {/foreach}
            {/foreach}                            
        </ul>
        <!--contact widget-->
        <ul class="verticalMenu contact_widget">
            <li class="verticalMenuTitle">Contact Us</li>
            <li>
                <div class="company_name">{$contact_company_name}</div>
                <p class="address">{$contact_address}</p>
                <p class="mail contacts">
                    <strong>Mail:</strong>  <br/>
                    <span class="contact_row"><a href="mailto:{$contact_email}">{$contact_email}</a></span>  <br/>
                    <span class="contact_row"><a href="mailto:jcabs2007@gmail.com">jcabs2007@gmail.com</a></span>
                </p>
                <p class="contacts">
                    <strong>Contacts:</strong> <br/>
                    {for $contact = 0 to count($contact_contacts) - 1}
                        <span class="contact_row">{$contact_contacts[$contact]}</span> <br/>
                    {/for}
                </p>
            </li>                      
        </ul>
        <!--end contact widget-->
      </div><!--End of page02ColumnWrap-->
      <div class="page02ColumnTwo">
        <div class="aboutUs">
            <div class="aboutUsTile"><h2>Sage Products Inquiries</h2></div>
            <div class="send_inquiry">
                <a href="#info" class="send" name="send" onclick="openInquiry()">Send Inquiry</a>&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                <a href="{$base_url}Home/sageProducts" class="continue">continue browsing</a>
            </div>
            {foreach from=$products item=product}
                <div class="product_box">
                    <h5>{$product['name']}</h5>
                    <div class="product_details">
                        <table>
                            <tr >
                                <td rowspan="2"><img src="{$image}/{$product['image']}"></td>
                                <td class="label">Price: Php {$product['price']}</td>
                            </tr>
                            <tr>
                                <td class="label price" style="vertical-align:top !important;">
                                    <a href="#send" name="remove" onclick="window.location='{$base_url}Home/removeSageInquiry?id={$product['id']}'">remove</a>
                                </td>
                            </tr>
                        </table>                        
                    </div>
                </div>            
            {/foreach}
        </div><!--End of aboutUs-->        
        <div class="clearfix" style="clear:both;"></div><!--End of clearfix-->      
      </div><!--End of page02ColumnTwo-->
        <div class="clearfix" style="clear:both;"></div><!--End of clearfix-->    
    </div><!--End of page02Body-->


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
    <p>All Rights Reserved JCA Bookkeeping Services 2013</p>
</div><!--End of copyrights-->

<div class="fade-box">   
</div>
 <div class="customer_information" name="info">
    <div style="width: auto;height: 25px;">
        <a href="#send" class="close" onclick="closeInquiry()">X</a>
    </div>
    <form method="POST">
        {$load_errors}
        <table >
            <tr>
                <td>First Name <font color="red">*</font></td>
                <td class="input"><input type="text" name="firstname" value="{$firstname}"></td>
                <input type="hidden" name="subject" value="Sage Products Inquiry">
            </tr>
            <tr>
                <td>Last Name <font color="red">*</font></td>
                <td class="input"><input type="text" name="lastname" value="{$lastname}"></td>
            </tr>
            <tr>
                <td>Address <font color="red">*</font></td>
                <td class="input"><input type="text" name="address" value="{$address}"></td>
            </tr>
            <tr>
                <td>Email <font color="red">*</font></td>
                <td class="input"><input type="text" name="email" value="{$email}"></td>
            </tr>
            <tr>
                <td>Phone <font color="red">*</font></td>
                <td class="input"><input type="text" name="phone" value="{$phone}"></td>
            </tr>
            <tr>
                <td>Company</td>
                <td class="input"><input type="text" name="company" value="{$company}"></td>
            </tr>
            <tr>
                <td valign="top">Message / Comment <font color="red">*</font></td>
                <td class="input"><textarea name="message">{$message}</textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right">
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
 </div>
 {if $load_errors != ''}
    <script type="text/javascript">        
        openInquiry();
    </script>
{/if}
</body>
</html>