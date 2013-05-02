<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JCABookkeeping Services</title>
    <link href="{$css}/default.css" type="text/css" rel="stylesheet" />
    <link href="{$css}/style.css" type="text/css" rel="stylesheet" />
    <link href="{$css}/contactUs.css" type="text/css" rel="stylesheet" />
    <link href="{$css}/contact_widget.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
    <script type="text/javascript" src="{$javascript}/home.js"></script>
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
                <li class="menu_selected"><a href="#">Home</a></li>                
                <li><a href="{$base_url}Home/services">Services</a></li>
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
	<div class="bodyColumn1">
    	<h5>Mission Ni siya nooh</h5>
        <p class="misDescription">
        	{$mission} 
        </p>
    	<h5>Vision</h5>
        <p class="visDescription">
        	{$vision}         
        </p> 
   
    </div><!--End of bodyColumn-->
	<div class="bodyColumn2">
        <div class="galleryBody">
            <div class="contactUsWrapper">
                <div class="contactTitle">
                    Contact Us
                </div><!--End of contactTitle-->
                <div class="contactData">
                    <div class="company_name">{$contact_company_name}</div>
                    <p class="address">{$contact_address}</p>
                    <p class="mail contacts">
                        <strong>Mail:</strong>  <br/>
                        <span class="contact_row"><a href="mailto:{$contact_email}">{$contact_email}</a></span>  <br/>
                        <span class="contact_row"><a href="mailto:jcabs2007@gmail.com">jcabs2007@gmail.com</a></span>
                    </p>
                    <p class="contacts">
                        <strong>Contacts:</strong>  <br/> 
                        {for $contact = 0 to count($contact_contacts) - 1}
                            <span class="contact_row">{$contact_contacts[$contact]}</span> <br/>                            
                        {/for}
                    </p>
                </div><!--End of contactData-->
            </div><!--End of contactUsWrapper-->
        </div><!--End of galleryBody-->
    </div><!--End of bodyColumn-->
    <div class="clear" style="clear:both;"></div>
    <div class="services">
    	<div class="title">
            <h3>
            	Services Offered
            </h3>
        </div><!--End of servicesTitle-->

        <div class="frontEndImage" onmouseover="display('nextPrevious')" onmouseout="hide('nextPrevious')">

            <div class="frontEndTable" style="width:{$services|@count * 240}px;">
                {section name=serviceIndex loop=$services}
                    <div class="img">                  
                        <a href="{$base_url}Home/service?cat_id={$services[serviceIndex].category_id}&subcat_id={$services[serviceIndex].id}">
                            <img src="{$image}/{$services[serviceIndex].image}" title="{$services[serviceIndex].name}" alt="{$services[serviceIndex].name}"/>
                            <div class="desc">{$services[serviceIndex].name}</div>
                        </a>                         
                    </div>
                {sectionelse}
                    No Services found
                {/section}                
            </div>
            <div class="nextPrevious">
                <div class="previous" onclick="prev({$services|@count * 240})">&lt;</div>
                <div class="next"  onclick="next({$services|@count * 240})">&gt;</div>
            </div>        
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
    <p>All Rights Reserved JCA Bookkeeping Services 2013</p>
</div><!--End of copyrights-->

<div class="chat_panel">
    <div class="chat_inner_panel">
        <div class="chat_online_panel">
            <div class="chat_header">Support Representatives</div>
            <div class="chat_online_list">
                <ul id="chat_online_list_ul">
                {foreach from=$online_reps item=reps}
                    {if $reps['status'] == 'Online'}
                        <li>{$reps['name']}</li>
                    {/if}
                {/foreach}
                </ul> 
            </div>
        </div>
        <div class="chat_button_panel" onclick="displayChat()">
            <span class="chat_button_drawer">Chat</span>
        </div>
        <div class="clearfix" style="clear:both"></div>  
    </div>
</div>
</body>
</html>
