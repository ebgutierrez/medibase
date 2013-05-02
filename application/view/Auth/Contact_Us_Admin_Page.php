<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$title}</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/admin.css">


		
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
				                <li><a href="{$base_url}Auth/Admin/representatives">Representatives</a></li>
				                <li class="menu_selected"><a href="#">Pages</a></li>
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
								<a onclick="window.location='{$base_url}Auth/Pages'">Add Page</a>
							</div>
							<div class="panel-title">
								<span><h5>Pages</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									{foreach from=$default_pages item=default_page}
										<li class="category">
											<div class="services category {if $id == $default_page.id}category_selected{/if}" id="d_{$default_page.id}" onclick="window.location='{$base_url}Auth/Pages/viewPage?type={$default_page.type}&id={$default_page.id}&name={$default_page.name}'">{$default_page.text}</div>																					
										</li>
									{/foreach}
									{foreach from=$generated_pages item=generated_page}
										<li class="category">
											<div class="services category" id="g_{$generated_page.id}" onclick="window.location='{$base_url}Auth/Pages/viewPage?action=edit&type={$generated_page.type}&id={$generated_page.id}&name={$generated_page.name}'">{$generated_page.text}</div>																					
										</li>
									{/foreach}
								</ul>
							</div>
						</div>						
					</div>

					<div class="users-panel general-data">
						<form method="POST" action='{$base_url}Auth/Pages/editPage?action={$action}&id={$id}&type={$type}&name={$name}' enctype='multipart/form-data'>
							<div class="inner-panel">
								<div class="add buttons">
									<input type="submit" value="Save" name="action"> |
									<input type="reset" value="Reset" name="reset">
								</div>
								<div class="panel-title">
									<span><h5>General Data - {if $action == 'add'}Add Page{else}Edit Page{/if}</h5></span>
								</div>
								<div class="panel-data">
									{$load_errors}
									<div class="content">
										<table>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Name:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="name" value="{$name}" readonly/>
													</div>
												</td>											
											</tr>

											<tr class="row"  >
												<td>
													<div class="label">
														<span>Display Text:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="display_text" value="{$display_text}" />
														<input type="hidden" name="token" value="{$token}" />
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Company Name:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="company_name" value="{$company_name}" />
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Address:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="address" value="{$address}" />
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Email:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="email" value="{$email}" />
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Contacts:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="contacts" value="{$contacts}" />
														<span>Separate contacts with (" | ")</span>
													</div>
												</td>											
											</tr>
										</table>										
									</div>
									<div class="add buttons">
											<input type="submit" value="Save" name="action"> |
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

		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="{$javascript}/sage.js"></script>

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