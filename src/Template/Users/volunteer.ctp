<?= $this->assign('title', 'Volunteer for Wintergrass!'); ?>
<?php echo $this->Facebook->initJsSDK(); ?>
<div class="row" style="text-align: center"><h1>Two ways to volunteer!</h1></div>

<div class="border row" id="form-volunteer">

	<div  class="border col-xs-6 img-rounded form-group has-success has-feedback" style="background-color: #c0dfd9; margin-bottom: 7px; margin-right: 7px; padding:15px">
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
			<?php echo $this->Form->button('Volunteer!',[ 'class' => 'btn btn-primary btn-block', 'id' => 'form-submit-button']); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>			
	</div>

	<div class="border col-xs-5 img-rounded" style="background-color: #c0dfd9; height: 100%; overflow: hidden; margin-bottom: 7px; padding:15px; box-sizing: border-box" id="facebook-volunteer">
		<div style="text-align: center"><h3>Or just click the Facebook logo.</h3></div>
		<div style="text-align: center">
			<?php 
				if($this->request->session()->read('Auth.User')){
					echo "You're already volunteered!";
				}else{
					echo $this->Facebook->loginLink($options = ['label' => '<img src="/img/FB-f-Logo__blue_144.png">']);
				}
			?>
		</div>
	</div>

</div>

<script>
	function checkSubmit(){
		//console.log("f:" + f_name + " l:" + l_name + " e:" + email + " p:" + pw + " pwmatch:" + pwmatch);
		if(f_name && l_name && email && pw && pwmatch){
			$("#form-submit-button").prop('disabled', false);
		}
	}

	var f_name, l_name, email, pw, pwmatch = false;
	
	$("#form-submit-button").prop('disabled', true);
	$("#once-more-on-the-password").prop('disabled', true);
	
	$("#first-name").on('blur',
		function(event){
			f_name = $("#first-name").val().length > 1;
			checkSubmit();
		}
	);
	
	$("#last-name").on('blur',
		function(event){
			l_name = $("#last-name").val().length > 1;			
			checkSubmit();
		}
	);
	
	$("#email").on('blur',
		function(event){
			email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val());
			checkSubmit();
		}
	);
	
	$("#password").on('blur',
		function(event){
			if($("#password").val().length < 5){
				alert("Passwords need to be at least six characters long.")
			}else{
				pw = true;
				$("#once-more-on-the-password").prop('disabled', false);
				checkSubmit();
			}
		}
	);
	
	$("#once-more-on-the-password").on('input', 
		function(event){
			var pw = $("#password").val();
			
			if(pw == event.target.value){
				pwmatch = true;
				checkSubmit();
			}else{
				$("#form-submit-button").prop('disabled', true);
			}
		}
	);	
</script>



