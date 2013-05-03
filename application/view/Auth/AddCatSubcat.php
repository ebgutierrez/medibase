<form method="POST" action='{$base_url}Auth/Admin/services?q={$type}' enctype='multipart/form-data'>
	<div class="inner-panel">
		<div class="add buttons">
			<input type="submit" value="Add" name="save"> | 
			<input type="reset" value="Reset" name="reset">
		</div>
		<div class="panel-title">
			<span><h5>General Data - {$gen_data}</h5></span>
		</div>
		<div class="panel-data">
			{if count($form_errors) > 0}
				<div class="form_error">
					{foreach from=$form_errors item=error}
						<div>{$error}</div> 
					{/foreach}
				</div>
			{/if}
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
									<input type="file" name="subcat_image" id="file" size="100%" onchange="displaySelectedImage(event)"/>
									<input type="text" name="overlap" id="overlap" value="Browse image (.png,.jpg,.jpeg,.gif,) less than 2MB"/>
									<img src="" id="img_src">
								</div>
							</td>											
						</tr>
					{/if}
					<tr class="row">
						<td>
							<div class="label">
								<span>Description:<font color="red">*</font> </span>
							</div>
						</td>
						<td class="input">
							<div >
								<input type="hidden" name="token" value="{$token}" />
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
									<select name="subcat_cat">
										<option value="" label="Select one">--Select one--</option>
										{foreach from=$categories item=category}
											<option value="{$category.id}" label="{$category.name}">{$category.name}</option>
										{/foreach}
									</select>
								</div>
							</td>											
						</tr>
					{/if}
				</table>										
			</div>
			<div class="add buttons">
				<input type="submit" value="Add" name="save"> | 
				<input type="reset" value="Reset" name="reset">
			</div>
		</div>
	</div>			
</form>	
<script type="text/javascript">
	initTinyMce();
</script>