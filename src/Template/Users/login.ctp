<div class="input-group users form">
<?= $this->Flash->render('auth') ?>


				
<?= $this->Form->create() ?>
    <fieldset>
		
		<div class="container">
			<form class="navbar-form navbar-left" role="login" id="login-form" method="post">
				<h3>Please log in to access this page.</h3>
				<div class="form-group col-xs-4">
					<?= $this->Form->input('username',['label' => 'Email', 'type' => 'text', 'class' => 'form-control col-xs-2', 'placeholder' => 'email']) ?>
					<?= $this->Form->input('password', ['label' => 'Password', 'type' => 'password', 'class' => 'form-control col-xs-2', 'placeholder' => 'password']) ?>
					<input type="hidden" class="form-control" name="ltype" value="admin">
					<?= $this->Form->button(__('Login'), ['class' => 'btn btn-default', 'id' => 'lbtn']); ?>
				</div>
			</form>
		</div>	
    </fieldset>

<?= $this->Form->end() ?>
</div>