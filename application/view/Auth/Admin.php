<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$title}</title>

		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/admin.css">


		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/sage.js"></script>
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
				                <li><a href="{$base_url}Auth/Services">Services</a></li>
				                <li class="sage">
				                	<a href="#" class="sage">Peachtree</a>
				                	<div class="sub-menu sage">
					                	<ul class="sage">
					                		<li class="sage"><a href="{$base_url}Auth/Sage/products" class="sage">Products</a></li>
					                		<li class="sage"><a href="{$base_url}Auth/Sage/implementations" class="sage">Implementations/Clients</a></li>
					                	</ul>
					                </div>
				                </li>
				                <li><a href="{$base_url}Auth/Admin/representatives">Representatives</a></li>
				                <li><a href="{$base_url}Auth/Pages">Pages</a></li>
				                <li><a href="{$base_url}Auth/Clients">Clients</a></li>
				            </ul>
				        </div><!--closing for menuSide-->
				    </div>
				    <div class="greetings">
				    	Welcome Name | <a href="{$base_url}Auth/Logout?token={$token}">Logout</a>
				    </div>
				</div>
			</div>
			<div class="body">
				<div class="inner-body">
					<div class="users-panel services">
						<div class="inner-panel">
							<div class="panel-title">
								<span><h5>Representatives</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									{foreach from=$online_reps item=reps}
										<li>
											<div class="user-img">
												<img src="{$image}/{$reps['image']}" class="users">
											</div>
											<div class="users-data">
												<div class="name">{$reps['name']}</div>
												{if $reps['status'] == 'Online'}
													<div class="status online">{$reps['status']}</div>
												{elseif $reps['status'] == 'Offline'}
													<div class="status offline">{$reps['status']}</div>
												{/if}
												
												<div class="clear" style="clear:both;"></div>
											</div>									
										</li>
									{/foreach}									
								</ul>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="footer"></div>
		</div>
	</body>
</html>