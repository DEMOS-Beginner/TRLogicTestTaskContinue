<div class="auth_background">
	<div class="container vertical-center">
		<div class="row">
			<h1 class='welcome'><?=LOGIN_FORM?></h1>			
		</div>

		<div class="row hideme" id='authErrors'>
			<div class="col-md-6">
				<div class="alert alert-danger" role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'
					onclick='closeMessage("#authErrors");'>
						<span aria-hidden='true'>x</span>
					</button>
					<span id='errorText'></span>
				</div>			
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div id='authData'>
					<div class="form-group">
						<label for="name" class='form_label'> <?=ENTER_EMAIL?> </label>
						<input type="text" name='email' class='form-control' placeholder="<?=EMAIL_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<label for="password" class='form_label'> <?=ENTER_PASSWORD?> </label>
						<input type="password" name='password' class='form-control' placeholder="<?=PASSWORD_PLACEHOLDER?>">
					</div>

					<div class="form-group">
						<a onclick='login();' class='btn btn-success btn-block'> <?=SIGN_IN?> </a>
					</div>		
				</div>
			</div>
		</div>
	</div>	
</div>
