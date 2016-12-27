<?php
	if(in_array($this->request->session()->read('Auth.User.role'), ['coordinator','admin'])){
?>
		<?= $this->Html->script(['date.format','adminfunctions']); ?>
<?php }else { ?>
		<?= $this->Html->script(['date.format','user_calendar']); ?>
<?php } ?>

<?= $this->assign('title', 'Schedule Volunteer'); ?>

	 <div class="row">
		<div class="col-md-4">
			<h4>Schedule for <small class="text-muted"><?= h($user->full_name) ?></small></h4>
		</div>
		
		<?php
		if(in_array($this->request->session()->read('Auth.User.role'), ['volunteer','applicant'])){
		?>
		<div class="col-md-8">
			<span class="pull-right">
				<?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout' ], ['class'=>'btn btn-default', 'confirm' => 'Are you sure you wish to log out?'] )  ?>
			</span>
		</div>
		
		<?php } ?>
	</div>
	 <div class="row">
		<div class="col-md-12">
			<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:600px; padding:10px;'>
				<div class="dhx_cal_navline">
					<div class="dhx_cal_prev_button">&nbsp;</div>
					<div class="dhx_cal_next_button">&nbsp;</div>
					<div class="dhx_cal_today_button"></div>
					<div class="dhx_cal_date"></div>
					<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
					<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
					<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
					<!-- <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div> -->

				</div>
				<div class="dhx_cal_header"></div>
				<div class="dhx_cal_data"></div>       
			</div>
		</div>
	</div>
	
	<div id="venue-list" hidden><select id="venue-select"></select></div>
	<div id="task-list" hidden><select id="task-select"></select></div>

	<style type="text/css" media="screen">
     #ajaxSpinnerImage {
		margin: auto;
		position: absolute;
		top: 50px; left: 50px;
		bottom: 50px; right: 50px;
		z-index:5;
		display: none;
     }
	</style>
	
	<div id="ajaxSpinnerContainer">
		<?= $this->Html->image('fiddler.gif',[ 'id'=>'ajaxSpinnerImage', 'title'=>'working...', 'alt'=>'Loading...']); ?>
	</div>


