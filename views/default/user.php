<div class="user_background">

	<div class="container">
		<div class="row">
			<h1 class='mt-5'> <?=YOUR_PROFILE?> </h1>
		</div>
		<div class="row">
			<div class="col-md-6 profile">
				<div class="base_info">
					<img class='avatar' src='<?=FILE_UPLOAD_PATH.$_SESSION['userData']['image']?>' width='150'>
					<div class="info">
						<h2> <?=$_SESSION['userData']['name']?> </h2>
						<span> <?=EMAIL_PLACEHOLDER.': '.$_SESSION['userData']['email']?> </span> <br>
						<span> <?=CITY_PLACEHOLDER.': '.$_SESSION['userData']['city']?> </span>				
					</div>
				</div>
				<form action="/register/upload" method='POST' enctype="multipart/form-data">
					<input type="file" name='image'> <br>
					<button type='submit'> <?=IMAGE_UPLOAD?> </button> <span> (<?=FILE_MAX_SIZE?>) </span>
				</form>
				<br>					
				<p class="aboutme"> <?=$_SESSION['userData']['about']?> </p>
			</div>		
		</div>
	</div>

</div>
