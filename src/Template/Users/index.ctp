<?php 
use Cake\Log\Log;
use Cake\Routing\Router;
?>

<div class="row bg-info form-group">
	<div class="btn-group btn-group-sm col-md-6" role="group">
		<?= $this->Html->link('New Volunteer', ['controller' => 'users', 'action' => 'add' ], ['class'=>'btn btn-default'] )  ?>
	</div>
	<div class="col-md-2 dropdown" role="group">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Job Interest
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<?php foreach($jobs as $job): ?>
			<li><input type="checkbox" class="job-choice" id="job-select-<?= $job->id ?>" name="job-interest[]" value="<?= $job->id ?>"><?= h($job->description) ?></input></li>
			<?php endforeach; ?>
		</ul>
	</div>	
	<div class="col-md-2" role="group">
		<input type="text" class="form-control" placeholder="Search" id="search-data">
	</div>	
	<div class="col-md-2" role="group">
		<button type="submit" class="btn btn-primary glyphicon glyphicon-search" id="search-button"></button>
	</div>
</div>

	<div class="row">
		<div class="col-md-12"> 
		<table cellpadding="0" cellspacing="0" class="table table-striped">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('first_name', 'Name') ?></th>
					<th><?= $this->Paginator->sort('role') ?></th>
					<th><?= $this->Paginator->sort('created') ?></th>
					<th><?= $this->Paginator->sort('scheduled_hours') ?></th>
					<th><?= $this->Paginator->sort('veteran') ?></th>
					<th><?= $this->Paginator->sort('email') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr class="table-striped">
					<td><?= h($user->full_name) ?></td>
					<td><?= h($user->role) ?></td>
					<td><?= h($user->created) ?></td>
					<td><?= h($user->scheduled_hours) ?></td>
					<td><?= h($user->veteran) ?></td>
					<td><a href="mailto:<?= h($user->email) ?>" _target="top"><?= h($user->email) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('Schedule'), ['action' => 'calendar', $user->id]) ?>
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->full_name)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>


	<div class="paginator row">
		<ul class="pagination nav nav-tabs">
			<?= $this->Paginator->prev('< ' . __('previous'), ['class' => 'nav-link']) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >', ['class' => 'nav-link']) ?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>

	<script>
		$('#search-button').on('click', 
			function () {
				var c = "<?php echo Router::url(['controller' => 'Users', 'action' => 'index']) ?>";
				var q = $('#search-data').val();
				var j = '?';
				
				$(".job-choice")  // for all checkboxes
					.each(
						function(e) {  // first pass, create name mapping
							if($(this).is(':checked')){
								j += '&job-interest[]=' + $(this).val();
							}
						}
					);
					
				window.location.href = c + '/index/' + q + j;				
			}
		);
</script>