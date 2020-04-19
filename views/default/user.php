<div class="user_background">

	<div class="container">
		<div class="row">
			<h1 class='mt-5'> <?=PROFILE?> </h1>
		</div>
		<div class="row">
			<div class="col-md-6 profile">

				<?php if ($error): ?>
					<div class="row" id='uploadError'>
						<div class="col-md-12">
							<div class="alert alert-danger" role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'
								onclick='closeMessage("#uploadError");'>
									<span aria-hidden='true'>x</span>
								</button>
								<span> <?=$error?></span>
							</div>			
						</div>
					</div>
				<?php endif; ?>

				<div class="base_info">
					<img class='avatar' src='/<?=FILE_UPLOAD_PATH.$userData["image"]?>' width='150'>
					<div class="info">
						<h2> <?=$userData['name']?> </h2>
						<span> <?=EMAIL_PLACEHOLDER.': '.$userData['email']?> </span> <br>
						<span> <?=CITY_PLACEHOLDER.': '.$userData['city']?> </span>				
					</div>
				</div>

				<?php if ($userData['id'] === $_SESSION['userData']['id']): ?>
					<form action="/register/upload" method='POST' enctype="multipart/form-data">
						<input type="file" name='image'> <br>
						<button type='submit'> <?=IMAGE_UPLOAD?> </button> <span> (<?=FILE_MAX_SIZE?>) </span>
					</form>
					<br>
				<?php else: ?>
					<a href="/message/<?=$userData['id']?>" class='btn btn-primary btn-sm mt-2'> <?=SEND_MESSAGE?> </a>
				<?php endif; ?>	

				<p class="aboutme"> <?=$userData['about']?> </p>

				<?php if ($userData['id'] === $_SESSION['userData']['id']): ?>
					<a href="/user/editpage" class='btn btn-primary'> <?=EDIT?> </a>
				<?php endif; ?>	
				
			</div>		
		</div>
	</div>

</div>
