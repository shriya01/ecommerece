<div class="container">
	<table class="table table-bordered">
		<?php foreach ($payment_method_info as $key) :?>
			<tbody>
				<tr>
					<th>Name</th>
					<td><?php  echo $key['payment_method_name']; ?></td>
				</tr>
				
			</tbody>
		<?php endforeach; ?>
	</table>
	<a href="<?php echo base_url().'paymentMethod/'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
</div>