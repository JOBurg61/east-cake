<?= $this->assign('title', 'Schedule Venue'); ?>

	 <div class="row">
		<div class="col-sm-8"><p class="h4 blockquote-reverse">Schedule for <b><?= h($venue->description) ?></b></p></div>
	</div>
	 <div class="row"><div class="col-sm-12">
		 <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:500px; padding:10px;'>
			<div class="dhx_cal_navline">
				<div class="dhx_cal_prev_button">&nbsp;</div>
				<div class="dhx_cal_next_button">&nbsp;</div>
				<!-- <div class="dhx_cal_today_button"></div> -->
				<div class="dhx_cal_date"></div>
				<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
				<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
				<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
			</div>
			<div class="dhx_cal_header"></div>
			<div class="dhx_cal_data"></div>       
		</div>
	</div></div>
	
	<div id="volunteer-list" class="form-group" hidden><select class="selectpicker" data-live-search=”true” id="volunteer-select"></select></div>
	<div id="task-list" class="form-group" hidden><select class="form-control inputstl selectpicker" data-live-search=”true” id="task-select"></select></div>

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

<?= $this->Html->script(['date.format','venue_calendar']); ?>	
