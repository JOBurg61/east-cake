<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $venueSchedule->venue_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $venueSchedule->venue_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Venue Schedules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Venues'), ['controller' => 'Venues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venue'), ['controller' => 'Venues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="venueSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($venueSchedule) ?>
    <fieldset>
        <legend><?= __('Edit Venue Schedule') ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('volunteer_id');
            echo $this->Form->input('volunteer_name');
            echo $this->Form->input('venue');
            echo $this->Form->input('type');
            echo $this->Form->input('job_id');
            echo $this->Form->input('job');
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
