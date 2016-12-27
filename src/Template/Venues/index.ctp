<div class="row bg-info">
		<div class="btn-group btn-group-sm col-md-4" role="group">
			<?= $this->Html->link('New Venue', ['controller' => 'venues', 'action' => 'add' ], ['class'=>'btn btn-default'] )  ?>				
		</div>
</div>

<div class="row"> 
	<div class="col-md-12"> 
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('description') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($venues as $venue): ?>
				<tr>
					<td><?= h($venue->description) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('Schedule'), ['action' => 'calendar', $venue->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $venue->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $venue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venue->id)]) ?>
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
