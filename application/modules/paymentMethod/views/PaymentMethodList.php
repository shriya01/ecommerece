<div class="container">
<br />
<a href="<?php echo base_url('paymentMethod/AddOrUpdatePaymentMethod/') ?>"><button class="btn-sm btn-primary glyphicon glyphicon-plus">ADD</button></a>
<hr />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>

				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php foreach($payment_method_info as $key):?>
			<tbody>
				<tr>
					<td><?php  echo $key['payment_method_name']; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url('paymentMethod/DeletePaymentMethodData/'.aes256encrypt($key['payment_method_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
						<a href="<?php echo base_url('paymentMethod/AddOrUpdatePaymentMethod/'.aes256encrypt($key['payment_method_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
						<a href="<?php echo base_url('paymentMethod/ShowPaymentMethodData/'.aes256encrypt($key['payment_method_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
					</td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>