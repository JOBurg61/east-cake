<?= $this->assign('title', 'Schedule Venue'); ?>
	 <div class="row">
		<div class="col-md-10">
			<h4 class="blockquote-reverse">Schedule for <small class="text-muted"><?= h($user->full_name) ?></small></h4>
		</div>
	</div>
	 <div class="row"><div class="col-sm-12">
		<div id="gantt_here"  style='width:100%; height:400px;'></div>
	</div></div>

	 <?= $this->Html->script(['schedule.js']); ?>
	 
	<div hidden>
		<select id="jobs-selector-list" hidden></select>
	</div>
