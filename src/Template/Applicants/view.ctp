<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant'), ['action' => 'edit', $applicant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicants view large-9 medium-8 columns content">
    <h3><?= h($applicant->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Job') ?></th>
            <td><?= $applicant->has('job') ? $this->Html->link($applicant->job->id, ['controller' => 'Jobs', 'action' => 'view', $applicant->job->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $applicant->has('user') ? $this->Html->link($applicant->user->full_name, ['controller' => 'Users', 'action' => 'view', $applicant->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicant->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Arrival') ?></th>
            <td><?= h($applicant->arrival) ?></td>
        </tr>
        <tr>
            <th><?= __('Departure') ?></th>
            <td><?= h($applicant->departure) ?></td>
        </tr>
    </table>
</div>
