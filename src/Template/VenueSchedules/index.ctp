<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Venue Schedule'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Venues'), ['controller' => 'Venues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venue'), ['controller' => 'Venues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="venueSchedules index large-9 medium-8 columns content">
    <h3><?= __('Venue Schedules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
     
                <th><?= $this->Paginator->sort('volunteer_name') ?></th>
                <th><?= $this->Paginator->sort('venue') ?></th>
                <th><?= $this->Paginator->sort('job') ?></th>
                <th><?= $this->Paginator->sort('start_date') ?></th>
                <th><?= $this->Paginator->sort('end_date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($venueSchedules as $venueSchedule): ?>
            <tr>
                <td><?= h($venueSchedule->volunteer_name) ?></td>
                <td><?= h($venueSchedule->venue) ?></td>
                <td><?= h($venueSchedule->job) ?></td>
                <td><?= h($venueSchedule->start_date) ?></td>
                <td><?= h($venueSchedule->end_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $venueSchedule->venue_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $venueSchedule->venue_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $venueSchedule->venue_id], ['confirm' => __('Are you sure you want to delete # {0}?', $venueSchedule->venue_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
