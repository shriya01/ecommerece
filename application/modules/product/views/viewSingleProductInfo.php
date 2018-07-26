<div class="container">
	<table class="table table-bordered">
		<?php foreach ($product_info as $key) :?>
			<tbody>
				<tr>
					<th>Name</th>
					<td><?php  echo $key['category_name']; ?></td>
				</tr>
				
			</tbody>
		<?php endforeach; ?>
	</table>
	<a href="<?php echo base_url().'product/'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
</div>