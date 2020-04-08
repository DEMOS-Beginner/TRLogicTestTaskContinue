<div class="users_background">
	<?php foreach ($users as $user): ?>
		<a href='/user/<?=$user["id"]?>'> <?=$user['name']?> </a>
		<br>

	<?php endforeach; ?>
</div>