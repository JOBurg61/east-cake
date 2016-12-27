
	<div class="row">
		<ul class="nav nav-pills">
			<li class="heading"><?= __('Actions') ?></li>
			<li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
		</ul>
	</div>
	<div class="row">
		<h3><?= __('Users') ?></h3>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('full_name') ?></th>
					<th><?= $this->Paginator->sort('role') ?></th>
					<th><?= $this->Paginator->sort('created') ?></th>
					<th><?= $this->Paginator->sort('modified') ?></th>
					<th><?= $this->Paginator->sort('fbid') ?></th>
					<th><?= $this->Paginator->sort('email') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?= h($user->full_name) ?></td>
					<td><?= h($user->role) ?></td>
					<td><?= h($user->created) ?></td>
					<td><?= h($user->modified) ?></td>
					<td><?= h($user->fbid) ?></td>
					<td><?= h($user->email) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


	<div class="paginator row">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
