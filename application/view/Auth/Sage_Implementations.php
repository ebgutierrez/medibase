<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$title}</title>

		<link rel="stylesheet" type="text/css" href="{$css}/default.css">
		<link rel="stylesheet" type="text/css" href="{$css}/admin.css">
		<link rel="stylesheet" type="text/css" href="{$css}/services.css">


		<script type="text/javascript" src="{$javascript}/jquery.min.js"></script>
		<script type="text/javascript" src="{$javascript}/tiny_mce/tiny_mce.js"></script>
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
				                <li ><a href="{$base_url}Auth/Admin">Home</a></li>                
				                <li><a href="{$base_url}Auth/Services">Services</a></li>
				                <li class="menu_selected sage">
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
							<div class="add">
								<a onclick="window.location='{$base_url}Auth/Sage/implementations'">Add Client</a>
							</div>
							<div class="panel-title">
								<span><h5>List of Clients(Peachtree Implementations)</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									{foreach from=$implementations item=implementation}
										<li class="category">
											<div class="services category "  onclick="">{$implementation.type_name}</div>											
											<ul class="ul_subcategory">
												{foreach from=$implementation.clients item=client}
													<li class="subcategory">														
														<div class="services subcategory {if $id == $client.id}category_selected{/if}" id="{'client_'|cat:$client.id}" onclick="window.location='{$base_url}Auth/Sage/implementations?action=edit&id={$client.id}'">{$client.name}</div>														
													</li>
												{/foreach}
											</ul>									
										</li>
									{/foreach}					
								</ul>
							</div>
						</div>						
					</div>

					<div class="users-panel general-data">
						<form method="POST" action="" enctype='multipart/form-data'>
							<div class="inner-panel">
								<div class="add buttons">
									<input type="submit" value="{if $action == 'add'}Add{else}Save{/if}" name="save"> | 
									{if $action == 'edit'}
										<input type="button" value="Remove" name="remove" onclick=""> |
									{/if}
									<input type="reset" value="Reset" name="reset">
								</div>
								<div class="panel-title">
									<span><h5>General Data - {if $action == 'add'}Add Client{else}Edit Client{/if}</h5></span>
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
														<input type="text" name="name" value="{$name}"/>														
														<input type="hidden" name="token" value="{$token}" />
													</div>
												</td>											
											</tr>	
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Type:</span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="type" value="{$type}"/>
														{if isset($type_id)}
															<input type="hidden" name="type_id" value="{$type_id}" />
														{/if}
													</div>
												</td>											
											</tr>
											<tr class="row"  >
												<td>
													<div class="label">
														<span>Location:</span>
													</div>
												</td>
												<td class="input">
													<div >
														<input type="text" name="location" value="{$location}"/>
													</div>
												</td>											
											</tr>											
										</table>										
									</div>
									<div class="add buttons">
											<input type="submit" value="{if $action == 'add'}Add{else}Save{/if}" name="save"> | 
											{if $action == 'edit'}
												<input type="button" value="Remove" name="remove" onclick=""> |
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
	</body>
</html>