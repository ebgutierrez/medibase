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
		<script type="text/javascript" src="{$javascript}/services.js"></script>
		
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
				                <li class="menu_selected"><a href="#">Services</a></li>
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
							<div class="add">
								<a onclick="window.location='{$base_url}Auth/Services?type=cat'">Add Category</a> | 
								<a onclick="window.location='{$base_url}Auth/Services?type=subcat'">Add Subcategory</a>
							</div>
							<div class="panel-title">
								<span><h5>Services</h5></span>
							</div>
							<div class="panel-data">
								<ul>
									{foreach from=$services item=categories}
										<li class="category">
											<div class="services category {if ($type|cat:'_'|cat:$cat_id) == ('cat_'|cat:$categories.cat_id)}category_selected{/if}" id="{'cat_'|cat:$categories.cat_id}" onclick="window.location='{$base_url}Auth/Services/edit?type=cat&cat_id={$categories.cat_id}'">{$categories.cat_name}</div>											
											<ul class="ul_subcategory">
												{foreach from=$categories.subcat item=subcategories}
													<li class="subcategory">														
														<div class="services subcategory {if ($type|cat:'_'|cat:$cat_id|cat:'_'|cat:$subcat_id) == ('subcat_'|cat:$categories.cat_id|cat:'_'|cat:$subcategories.subcat_id)}category_selected{/if}" id="{'subcat_'|cat:$categories.cat_id|cat:'_'|cat:$subcategories.subcat_id}" onclick="window.location='{$base_url}Auth/Services/edit?type=subcat&cat_id={$categories.cat_id}&subcat_id={$subcategories.subcat_id}'">{$subcategories.subcat_name}</div>														
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
						<form method="POST" action="{if $action == 'add'}{$base_url}Auth/Services/add{else}{$base_url}Auth/Services/edit?type={$type}&cat_id={$cat_id}{if isset($subcat_id)}&subcat_id={$subcat_id}{/if}{/if}" enctype='multipart/form-data'>
							<div class="inner-panel">
								<div class="add buttons">
									<input type="submit" value="{if $action == 'add'}Add{else}Save{/if}" name="save"> | 
									{if $action == 'edit'}
										<input type="button" value="Remove" name="remove" onclick="removeSelected('{$base_url}','{$remove_id}');"> |
									{/if}
									<input type="reset" value="Reset" name="reset">
								</div>
								<div class="panel-title">
									<span><h5>General Data - {if $action == 'add'}Add {if $type == 'cat'}Category{else}Subcategory{/if}{else}Edit {if $type == 'cat'}Category{else}Subcategory{/if}{/if}</h5></span>
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
														{if $type == 'cat'}
															<input type="text" name="cat_name" value="{$cat_name}"/>
														{else}
															<input type="text" name="subcat_name" value="{$subcat_name}"/>
														{/if}
														
														<input type="hidden" name="token" value="{$token}" />
														<input type="hidden" name="type" value="{$type}" />
													</div>
												</td>											
											</tr>		
											{if $type == 'subcat'}
												<tr class="row"  >
													<td>
														<div class="label">
															<span>Image:<font color="red">*</font> </span>
														</div>
													</td>
													<td class="input">
														<div class="image" id="image">
															<input type="file" name="subcat_image" id="file_image" size="100%"  value="{$subcat_image}" onchange="handleFileSelect(event)"/>
															<input type="text" name="overlap" id="overlap" value="Browse image (.png,.jpg,.jpeg,.gif,) less than 2MB"/>															
															<div id="progress_bar"><div class="percent">0%</div></div>
															<img src="{if $subcat_image == ''}{else}{$image}/{$subcat_image}{/if}" id="img_src" class="subcat_thumb" style="{if $subcat_image == ''}{else}display:block{/if}">

															<!--{if $subcat_image != ''}
																<script type="text/javascript">
																	resizeImage();
																</script>
															{/if}-->
														</div>
													</td>											
												</tr>	
											{/if}						
											<tr class="row">
												<td>
													<div class="label description">
														<span>Description:<font color="red">*</font> </span>
													</div>
												</td>
												<td class="input">
													<div class="description">
														{if $type == 'cat'}
															<textarea type="text" name="cat_desc" >{$cat_desc}</textarea>
														{else}
															<textarea type="text" name="subcat_desc" >{$subcat_desc}</textarea>
														{/if}
													</div>
												</td>											
											</tr>

											{if $type == 'subcat'}
												<tr class="row"  >
													<td>
														<div class="label">
															<span>Category:<font color="red">*</font> </span>
														</div>
													</td>
													<td class="input">

														<div>
															<select name="cat_id" value="{$cat_id}">
																<option value="" label="Select one">--Select one--</option>																
																{foreach from=$cats item=category}
																	{if $subcat_cat == $category.id}
																		<option selected="selected" value="{$category.id}" label="{$category.name}">{$category.name}</option>											
																	{else}
																		<option value="{$category.id}" label="{$category.name}">{$category.name}</option>											
																	{/if}																	
																{/foreach}
															</select>
														</div>
													</td>											
												</tr>
											{/if}
										</table>										
									</div>
									<div class="add buttons">
											<input type="submit" value="{if $action == 'add'}Add{else}Save{/if}" name="save"> | 
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