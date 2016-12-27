<?= $this->assign('title', 'Schedule Venue'); ?>
 <div class="container-fluid">
	 
	 <div class="row"><div class="col-sm-10"><p class="h4 blockquote-reverse">Venue Schedule for <b><?= h($venue->description) ?></b></p></div></div>
	 <div class="row"><div class="col-sm-12">
		<div id="gantt_here"  style='width:100%; height:400px;'></div>
	</div></div>

	 <?= $this->Html->script(['schedule.js']); ?>
	 
	<div hidden>
		<select id="jobs-selector-list" hidden></select>
	</div>
</div>