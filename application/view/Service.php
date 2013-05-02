<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JCABookkeeping Services</title>
<link href="{$css}/default.css" type="text/css" rel="stylesheet" />
<link href="{$css}/style.css" type="text/css" rel="stylesheet" />
<link href="{$css}/contact_widget.css" type="text/css" rel="stylesheet" />
<link href="{$css}/contactUs.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
<script type="text/javascript" src="{$javascript}/slide.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            slider('{$base_url}','{$image}');
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
                    <li class="{if $selected == 'subcat_'|cat:$subcategories.subcat_id|cat:'_'|cat:$categories.cat_id}category_selected{else}none{/if}">
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

        {section name=serviceIndex loop=$all_services}
            <div class="page02ColumnTwo_01" style="height:100%;border:0px !important; width: 412px !important" id="{$all_services[serviceIndex].category_id}_{$all_services[serviceIndex].id}">
                <div class="page02ColumnTwo_01Title" ><h4>{$all_services[serviceIndex].name}</h4></div><!--End of page02ColumnTwo_01-->
                <hr>
                <p>{$all_services[serviceIndex].description}</p>                
            </div><!--End of page02ColumnTwo_01-->

            <div class="page02ColumnTwo_02" style="height:100%;border:0px !important; padding-left:0 !important"  id="img_{$all_services[serviceIndex].category_id}_{$all_services[serviceIndex].id}">
                <img  style="border:1px solid #bbb !important;border-style:inset;" src="{$image}/{$all_services[serviceIndex].image}" title="{$all_services[serviceIndex].name}" alt="{$all_services[serviceIndex].name}"/>
            </div><!--End of page02ColumnTwo_02-->            
        {sectionelse}
            No Services found
        {/section}                
        <div class="clearfix" style="clear:both;"></div><!--End of clearfix-->  
        <div class="contactUsMapWrapper">
                <div class="contactUsMapTitle" style="border-bottom:0px; border-top: 1px dotted #ccc;margin-top: 20px;">
                    Contact JCA Bookkeeping Services
                </div><!--End of contactUsMapTitle-->
                {$load_errors}
                <div class="contactUsDataText">
                    <form method="POST">
                        <p class="no">Firstname:</p>
                        <p class="no"><input class="inputbox" type="text" name="firstname"></p>
                        <p class="no">Lastname:</p>
                        <p class="no"><input class="inputbox" type="text" name="lastname"></p>
                        <p class="no">Address:</p>
                        <p class="no"><input class="inputbox" type="text" name="address"></p>
                        <p class="no">Email:</p>
                        <p class="no"><input class="inputbox" type="text" name="email"></p>
                        <p class="no">Phone:</p>
                        <p class="no"><input class="inputbox" type="text" name="phone"></p>
                        <p class="no">Company:</p>
                        <p class="no"><input class="inputbox" type="text" name="company"></p>
                        <p class="no">Message:</p>
                        <p class="no"><textarea class="textArea" name="message"></textarea></p>   
                        <input type="hidden" name="subject" value="JCA User Inquiry"/>                                                                
                        <p class="no"><input class="subButton" type="submit" name="Contact" value="Contact Us"></p> 
                    </form>
                </div><!--End of contactUsDataText-->
            </div><!--End of contactUsMapWrapper--> 
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
</body>
</html>
