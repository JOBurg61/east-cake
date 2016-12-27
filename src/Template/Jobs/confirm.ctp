<?= $this->assign('title', 'Thank You!'); ?>

<div  class="row" style="text-align: center">

<h1>Thanks for volunteering,  <?= $this->request->session()->read('Auth.User.first_name') ?>!</h1>

We will be collecting voluneer data over the next few weeks and let you know as soon as you're confirmed.

In the mean time, how about letting us know what interests you and when you can be available?  We can't guarantee anything, but it helps us find the right place to make use of your unique talents!
</div>

<div class="border row" id="form-confirm">
	<?php echo $this->Form->create(); ?>
	<div class="border col-xs-6 img-rounded" style="background-color: #c0dfd9; margin-bottom: 7px; margin-right: 7px; padding:15px">
        <?php foreach ($jobs as $job): ?>
		<div class="checkbox wgjob">
			<label><input type="checkbox" name="job[]" value="<?= $job->id ?>"><?= $job->description ?></input></label>
		</div>
        <?php endforeach; ?>
	</div>
		
	<div border class="col-xs-5 img-rounded" style="background-color: #c0dfd9; height: 100%; overflow: hidden; margin-bottom: 7px; padding:15px; box-sizing: border-box" id="facebook-volunteer">
		  Let us know when you're getting here and when you're leaving...
		  <p>Arriving Date: <input type="text" name="arrived" id="arrivedate"></p>
		  <p>Departing Date: <input type="text" name="departed" id="departdate"></p>
	</div>
</div>

<div style="padding:15px">
			<?php echo $this->Form->button('Finish Up!',[ 'class' => 'btn btn-primary btn-block']); ?>
			<?php echo $this->Form->end(); ?>

			Or if you'd rather leave yourself to our mercy, just click here and be on your way....
			<a href="/east/users/logout">Surprise me!</a>
</div>
<script>
	
   $( function() {
    $( "#arrivedate" ).datepicker({ minDate: new Date(2017, 1, 19), maxDate:  new Date(2017,1,28)}); 
	$( "#departdate" ).datepicker({ minDate: new Date(2017, 1, 19), maxDate:  new Date(2017,1,28)}); 
  } );
  
</script>
