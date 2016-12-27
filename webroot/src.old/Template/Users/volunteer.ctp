<?= 

$this->assign('title', 'Volunteer for Wintergrass!'); 


?>
<?php echo $this->Facebook->initJsSDK(); ?>
<div class="row" style="text-align: center"><h1>Two ways to volunteer!</h1></div>

<div class="border row" id="form-volunteer">

	<div  class="border col-xs-6 img-rounded" style="background-color: #c0dfd9; margin-bottom: 7px; margin-right: 7px; padding:15px">
		<h3>Fill out this form.</h3>
        <?php
			echo $this->Form->create();
            echo $this->Form->input('first_name', [ 'class' => 'form-control']);
            echo $this->Form->input('last_name', [ 'class' => 'form-control']);
            echo $this->Form->input('email',[ 'class' => 'form-control']);
			echo $this->Form->input('password',[ 'class' => 'form-control']);
			echo $this->Form->input('Once More on the Password',[ 'class' => 'form-control', 'type' => 'password']);
		?>
			<div style="padding:15px">
			<?php echo $this->Form->button('Volunteer!',[ 'class' => 'btn btn-primary btn-block']); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>			
	</div>

	<div class="border col-xs-5 img-rounded" style="background-color: #c0dfd9; height: 100%; overflow: hidden; margin-bottom: 7px; padding:15px; box-sizing: border-box" id="facebook-volunteer">
	<div style="text-align: center"><h3>Or just click the Facebook logo.</h3></div>
	<div style="text-align: center">
		<?php 
			echo $this->Facebook->loginLink($options = ['label' => '<img src="/img/FB-f-Logo__blue_144.png">']); 
		?>
	</div>
	</div>

</div>



