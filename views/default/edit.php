<div class="register_background">

	<div class="container">
		<div class="row">
			<h1 class='welcome'> <?=EDIT_FORM?> </h1>			
		</div>

		<div class="row hideme" id='editErrors'>
			<div class="col-md-6">
				<div class="alert alert-danger" role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'
					onclick='closeMessage("#editErrors");'>
						<span aria-hidden='true'> x </span>
					</button>
					<span id='errorText'></span>
				</div>			
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div id='editData'>
					<div class="form-group">
						<label for="name" class='form_label'> <?=ENTER_NAME?> </label>
						<input type="text" name='name' class='form-control' placeholder="<?=NAME_PLACEHOLDER?>"
						value='<?=$_SESSION['userData']['name']?>'>
					</div>

					<div class="form-group">
						<label for="name" class='form_label'> <?=ENTER_EMAIL?> </label>
						<input type="text" name='email' class='form-control' placeholder="<?=EMAIL_PLACEHOLDER?>"
						value='<?=$_SESSION['userData']['email']?>'>
					</div>

					<div class="form-group">
						<label for="city" class='form_label'> <?=ENTER_CITY?> </label>
						<input type="text" name='city' class='form-control' placeholder="<?=CITY_PLACEHOLDER?>"
						value='<?=$_SESSION['userData']['city']?>'>
					</div>		

					<div class="form-group">
						<label for="password" class='form_label'> <?=ENTER_OLD_PASSWORD?> </label>
						<input type="password" name='old_password' class='form-control' placeholder="<?=OLD_PASSWORD_PLACEHOLDER?>">
					</div>					
					
					<a href="#" class='btn btn-dark' onclick='showEditPassword();' id='editPasswordLink'>Изменить пароль</a>

					<div class="edit_password hideme" id='editPassword'>
						<div class="form-group">
							<label for="password" class='form_label'> <?=ENTER_PASSWORD?> </label>
							<input type="password" name='password' class='form-control' placeholder="<?=PASSWORD_PLACEHOLDER?>">
						</div>

						<div class="form-group">
							<label for="password2" class='form_label'> <?=ENTER_PASSWORD2?> </label>
							<input type="password" name='password2' class='form-control' placeholder="<?=PASSWORD_PLACEHOLDER?>">
						</div>
					
					</div>

					<div class="form-group">
						<label for="about" class='form_label'> <?=ENTER_ABOUT?> </label>
						<textarea name='about' class='form-control' placeholder="<?=ABOUTME_PLACEHOLDER?>"><?=$_SESSION['userData']['about']?>
						</textarea>
					</div>	

					<div class="form-group">
						<a onclick='edit()' class='btn btn-success btn-block'><?=EDIT?></a>
					</div>		
				</div>
			</div>
		</div>
	</div>	
	
</div>