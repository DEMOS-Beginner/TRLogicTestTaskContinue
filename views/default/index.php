<div class='index_background'>
	<div class="container vertical-center">
		<div class="row justify-content-center">
			<h1 class='welcome'><?=WELCOME?></h1>
		</div>

		<?php if (!isset($_SESSION['userData'])): ?>
			<div class="row justify-content-center">
				<a href="/auth" class='btn btn-primary mr-3'>
					<?=SIGN_IN?>
				</a>			
				<a href="/register" class='btn btn-primary ml-3'>
					<?=SIGN_UP?>
				</a>			
			</div>
		<?php else: ?>
		<div class="row justify-content-center">
			<a href="/user" class='btn btn-primary'>
				<?=TO_PROFILE?>
			</a>			
		</div>
		<?php endif; ?>
	</div>
</div>	