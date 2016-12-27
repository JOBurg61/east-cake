<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Venue'), ['action' => 'edit', $venue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Venue'), ['action' => 'delete', $venue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Venues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venue'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="venues view large-9 medium-8 columns content">
    <h3><?= h($venue->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($venue->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($venue->id) ?></td>
        </tr>
    </table>
</div>
