<div class="users_background">

	<div class="container pt-5">
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col"> <?=USER_ID?></th>
					<th scope='col'> <?=USER_IMAGE?> </th>
					<th scope="col"> <?=USERNAME?> </th>
					<th scope="col"> <?=USER_EMAIL?> </th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user): ?>
					<tr>
						<th scope="row"> <?=$user['id']?> </th>
						<td>
							<img class='avatar' src='/<?=FILE_UPLOAD_PATH.$user["image"]?>' width='150'>
						</td>
						<td>
							<a href='/user/<?=$user["id"]?>'> <?=$user['name']?> </a>
						</td>
						<td> <?=$user['email']?> </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>