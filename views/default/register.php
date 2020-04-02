<div class="register_background">

	<div class="container">
		<div class="row">
			<h1 class='welcome'> <?=REGISTER_FORM?> </h1>			
		</div>

		<div class="row hideme" id='registerErrors'>
			<div class="col-md-6">
				<div class="alert alert-danger" role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'
					onclick='closeMessage("#registerErrors");'>
						<span aria-hidden='true'> x </span>
					</button>
					<span id='errorText'></span>
				</div>			
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div id='registerData'>
					<div class="form-group">
						<label for="name" class='form_label'> <?=ENTER_NAME?> </label>
						<input type="text" name='name' class='form-control' placeholder="<?=NAME_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<label for="name" class='form_label'> <?=ENTER_EMAIL?> </label>
						<input type="text" name='email' class='form-control' placeholder="<?=EMAIL_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<label for="city" class='form_label'> <?=ENTER_CITY?> </label>
						<input type="text" name='city' class='form-control' placeholder="<?=CITY_PLACEHOLDER?>">
					</div>		

					<div class="form-group">
						<label for="password" class='form_label'> <?=ENTER_PASSWORD?> </label>
						<input type="password" name='password' class='form-control' placeholder="<?=PASSWORD_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<label for="password2" class='form_label'> <?=ENTER_PASSWORD2?> </label>
						<input type="password" name='password2' class='form-control' placeholder="<?=PASSWORD_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<label for="about" class='form_label'> <?=ENTER_ABOUT?> </label>
						<textarea name='about' class='form-control' placeholder="<?=ABOUTME_PLACEHOLDER?>"></textarea>
					</div>

					<div class="form-group">
						<a onclick='register()' class='btn btn-success btn-block'><?=SIGN_UP?></a>
					</div>		
				</div>
			</div>
		</div>
	</div>	
	
</div>