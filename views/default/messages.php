<div class="users_background pt-3">
	
	<div class="container">
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


		<div class="col-md-6">
			<?php if (!empty($messages)): ?>
				<div class="wall" id='wallMessages'>
					<?php foreach ($messages as $message): ?>
						<div class="message">
							<img class='message_avatar' src='/<?=FILE_UPLOAD_PATH.$message["author_image"]?>' width='60'>							
							<a href="/user/<?=$message['author_id']?>"> <?=$message['author_name']?> </a>
							<p class='message_text mt-2'> <?=$message['text']?> </p>
							<?php if ($message['file']): ?>
								<div class="card">
									<div class="card-body">
										<a download href='/<?=FILE_UPLOAD_PATH.$message["file"]?>' class='file'> <?=$message['original_filename']?> </a> <br>										
									</div>
								</div>
							<?php endif; ?>
							<i> <?=$message['created_at']?> </i>
						</div>
					<?php endforeach ?>
				</div>
			<?php else: ?>
				<h2> <?=NO_MESSAGES?> </h2>
			<?php endif; ?>
		</div>			


		<div class="row mt-2">
			<div class="col-md-6">
				<div class="form-group">
					<form action="/message/send" method='POST' enctype='multipart/form-data'>
						<textarea name="message" class='form-control' id="messageText" rows="5" placeholder='<?=ENTER_MESSAGE?>' required></textarea>
						<input type="hidden" name='author_id' value='<?=$_SESSION['userData']['id']?>'>
						<input type="hidden" name='recipient_id' value='<?=$userId?>'>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name='messageFile'>
							<label class="custom-file-label" for="messageFile"> <?=CHOOSE_FILE?> </label>
						</div> <br>	<br>
						<button type='submit' class='btn btn-success'> <?=SEND_MESSAGE?> </button>
					</form>	
				</div>
			</div>
		</div>		
	</div>

</div>