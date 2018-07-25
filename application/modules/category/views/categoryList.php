<div class="container">
<br />
<a href="<?php echo base_url('category/addOrUpdateCategory/') ?>"><button class="btn-sm btn-primary glyphicon glyphicon-plus">ADD</button></a>
<hr />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>

				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php foreach($category_info as $key):?>
			<tbody>
				<tr>
					<td><?php  echo $key['category_name']; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url('category/deleteCategoryData/'.aes256encrypt($key['category_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
						<a href="<?php echo base_url('category/addOrUpdateCategory/'.aes256encrypt($key['category_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
						<a href="<?php echo base_url('category/showCategoryData/'.aes256encrypt($key['category_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
					</td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>