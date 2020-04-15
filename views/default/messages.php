<div class="users_background pt-3">
	
	<div class="container">
		<div class="row hideme" id='messageErrors'>
			<div class="col-md-6">
				<div class="alert alert-danger" role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'
					onclick='closeMessage("#messageErrors");'>
						<span aria-hidden='true'> x </span>
					</button>
					<span id='errorText'></span>
				</div>			
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group" id='messageData'>
					<textarea name="message" class='form-control' id="messageText" rows="5" placeholder='<?=ENTER_MESSAGE?>'></textarea>
					<input type="hidden" name='author_id' value='<?=$_SESSION['userData']['id']?>'>
					<input type="hidden" name='recipient_id' value='<?=$userId?>'>
					<a href="#" class='btn btn-success' onclick='sendMessage();'> <?=SEND_MESSAGE?> </a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<?php if (!empty($messages)): ?>
					<div class="wall">
						<?php foreach ($messages as $message): ?>
							<div class="message">
								<img class='message_avatar' src='/<?=FILE_UPLOAD_PATH.$message["user_image"]?>' width='60'>
								<p> <?=$message['text']?> </p>
								<i> <?=$message['created_at']?> </i>
							</div>
						<?php endforeach ?>
					</div>
				<?php else: ?>
					<h2> <?=NO_MESSAGES?> </h2>
				<?php endif; ?>
			</div>			
		</div>
	</div>

</div>