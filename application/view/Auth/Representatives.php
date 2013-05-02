<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$title}</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/admin.css">
		<link rel="stylesheet" type="text/css" href="{$css}/services.css">


		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="{$javascript}/reps.js"></script>
		
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
				                <li><a href="{$base_url}Auth/Admin">Home</a></li>                
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
				                <li class="menu_selected"><a href="#">Representatives</a></li>
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
							<div class="add">
								<a onclick="">Add Representative</a>
							</div>
							<div class="panel-title">
								<span><h5>Representatives</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									<li>
										<div class="user-img">
											<img src="{$image}/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>									
									</li>
									<li>
										<div class="user-img">
											<img src="{$image}/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status offline">Offline</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
									<li>
										<div class="user-img">
											<img src="{$image}/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
									<li>
										<div class="user-img">
											<img src="{$image}/about_office.jpg" class="users">
										</div>
										<div class="users-data">
											<div class="name">User 1</div>												
											<div class="status online">Online</div>
											<div class="clear" style="clear:both;"></div>
										</div>
									</li>
								</ul>
								<!--<ul>
									{foreach from=$services item=categories}
										<li class="category">
											<div class="services category {if $selected == 'cat_'|cat:$categories.cat_id}category_selected {/if}" id="{'cat_'|cat:$categories.cat_id}" onclick="window.location='{$base_url}Auth/Admin/services?q=cat&id={'cat_'|cat:$categories.cat_id}';">{$categories.cat_name}</div>											
											<ul class="ul_subcategory">
												{foreach from=$categories.subcat item=subcategories}
													<li class="subcategory">														
														<div class="services subcategory {if $selected == 'subcat_'|cat:$subcategories.subcat_id|cat:'_'|cat:$categories.cat_id}category_selected{/if}" id="subcat_{$subcategories.subcat_id}_{$categories.cat_id}" onclick="window.location='{$base_url}Auth/Admin/services?q=subcat&id=subcat_{$subcategories.subcat_id}_{$categories.cat_id}';">{$subcategories.subcat_name}</div>														
													</li>
												{/foreach}
											</ul>									
										</li>
									{/foreach}
								
								</ul>
								-->
							</div>
						</div>						
					</div>

					<div class="users-panel general-data">
						<form method="POST" action='{$base_url}Auth/Admin/representatives?act={$action}{if isset($id)}&id={$id}{/if}' enctype='multipart/form-data'>
							<div class="inner-panel">
								<div class="add buttons">
									<input type="submit" value="{$submit_value}" name="save"> | 
									{if $action == 'edit'}
										<input type="button" value="Remove" name="remove" onclick="removeSelected('{$base_url}','{$remove_id}');"> |
									{/if}
									<input type="reset" value="Reset" name="reset">
								</div>
								<div class="panel-title">
									<span><h5>General Data - {if $action == 'add'}Add Representative{else}Edit Representative{/if}</h5></span>
								</div>
								<div class="panel-data">
									{$load_errors}
									<div class="content">
										<table>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Last Name:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="lastname" value="{$lastname}"/>
														<input type="hidden" name="token" value="{$token}" />
													</div>
												</td>											
											</tr>	
											<tr class="row"  >
												<td>
													<div class="label">
														<span>First Name:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="firstname" value="{$firstname}"/>
													</div>
												</td>											
											</tr>		
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Middle Initial</span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="mi" value="{$mi}"/>
													</div>
												</td>											
											</tr>	
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Image:</span>
													</div>
												</td>
												<td class="input">
													<div class="image" id="image">
														<input type="file" name="user_image" id="file_image" size="100%" onchange="handleFileSelect(event)" value="{$image}/{$subcat_image}"/>
														<input type="text" name="overlap" id="overlap" value="Browse image (.png,.jpg,.jpeg,.gif,) less than 2MB"/>															
														<div id="progress_bar"><div class="percent">0%</div></div>
														<img src="{if $user_image == ''}{else}{$image}/{$user_image}{/if}" class="subcat_thumb" id="img_src">
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label description">
														<span>Username:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div class="description">
														<input type="text" name="username" value="{$username}"/>
													</div>
												</td>											
											</tr>	
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Password:</span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="password" value="Jca2013!!" readonly/>
													</div>
												</td>											
											</tr>
										</table>										
									</div>
									<div class="add buttons">
											<input type="submit" value="{$submit_value}" name="save"> | 
											{if $action == 'edit'}
												<input type="button" value="Remove" name="remove" onclick="removeSelected('{$base_url}','{$remove_id}');"> |
											{/if}
											<input type="reset" value="Reset" name="reset">
										</div>
								</div>
							</div>			
						</form>			
					</div>
				</div>
			</div>
			<div class="footer"></div>
		</div>
		<div class="fade-box">
			<div class="loading">Loading data <img src="{$image}/loader-green.gif"></div>
		</div>

		{if isset($success)}
			<script type="text/javascript">				
				$('.fade-box').fadeIn(2000,function(){
					$('.fade-box').fadeOut(2000,function(){
						$('.fade-box .loading').html('Loading data <img src="{$image}/loader-green.gif">');
					});
				});
				$('.fade-box .loading').html('Successfully added <img src="{$image}/check.jpg"/>');
			</script>
		{else}
			<script type="text/javascript">				
				$('.fade-box').fadeOut(2000);
			</script>
		{/if}
	</body>
</html>