<div class="container">
<br />
<a href="<?php echo base_url('user/addOrUpdateData') ?>"><button class="btn-sm btn-primary glyphicon glyphicon-plus">ADD</button></a>
<hr />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Mobile Number</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php foreach($user_info as $key):?>
			<tbody>
				<tr>
					<td><?php  echo $key['user_firstname']; ?></td>
					<td><?php  echo $key['user_lastname']; ?></td>
					<td><?php  echo $key['user_email']; ?></td>		
					<td><?php  echo $key['user_gender'] == 1?'Male':($key['user_gender']== 2?'Female':'Others'); ?></td>
					<td><?php  echo $key['user_mobile']; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url('user/deleteUserData/'.aes256encrypt($key['user_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
						<a href="<?php echo base_url('user/addOrUpdateData/'.aes256encrypt($key['user_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
						<a href="<?php echo base_url('user/showUserData/'.aes256encrypt($key['user_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
					</td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>