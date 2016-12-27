<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Venue Schedule'), ['action' => 'edit', $venueSchedule->venue_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Venue Schedule'), ['action' => 'delete', $venueSchedule->venue_id], ['confirm' => __('Are you sure you want to delete # {0}?', $venueSchedule->venue_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Venue Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venue Schedule'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Venues'), ['controller' => 'Venues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venue'), ['controller' => 'Venues', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="venueSchedules view large-9 medium-8 columns content">
    <h3><?= h($venueSchedule->venue_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($venueSchedule->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Venue') ?></th>
            <td><?= $venueSchedule->has('venue') ? $this->Html->link($venueSchedule->venue->id, ['controller' => 'Venues', 'action' => 'view', $venueSchedule->venue->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Venue') ?></th>
            <td><?= h($venueSchedule->venue) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($venueSchedule->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Job') ?></th>
            <td><?= h($venueSchedule->job) ?></td>
        </tr>
        <tr>
            <th><?= __('Volunteer Id') ?></th>
            <td><?= $this->Number->format($venueSchedule->volunteer_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Job Id') ?></th>
            <td><?= $this->Number->format($venueSchedule->job_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Date') ?></th>
            <td><?= h($venueSchedule->start_date) ?></td>
        </tr>
        <tr>
            <th><?= __('End Date') ?></th>
            <td><?= h($venueSchedule->end_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Volunteer Name') ?></h4>
        <?= $this->Text->autoParagraph(h($venueSchedule->volunteer_name)); ?>
    </div>
</div>
