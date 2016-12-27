<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schedule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Schedules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schedules form large-9 medium-8 columns content">
    <?= $this->Form->create($schedule) ?>
    <fieldset>
        <legend><?= __('Edit Schedule') ?></legend>
        <?php
            echo $this->Form->input('job_id', ['options' => $jobs, 'empty' => true]);
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
