<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Resource'), ['action' => 'edit', $resource->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Resource'), ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]) ?> </li>
<li><?= $this->Html->link(__('List Resources'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Resource'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Resource'), ['action' => 'edit', $resource->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Resource'), ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]) ?> </li>
<li><?= $this->Html->link(__('List Resources'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Resource'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($resource->title) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($resource->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($resource->id) ?></td>
        </tr>
        <tr>
            <td><?= __('ParentID') ?></td>
            <td><?= $this->Number->format($resource->parentID) ?></td>
        </tr>
        <tr>
            <td><?= __('Duration') ?></td>
            <td><?= $this->Number->format($resource->duration) ?></td>
        </tr>
        <tr>
            <td><?= __('Start Time') ?></td>
            <td><?= h($resource->start_time) ?></td>
        </tr>
        <tr>
            <td><?= __('End Time') ?></td>
            <td><?= h($resource->end_time) ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Events') ?></h3>
    </div>
    <?php if (!empty($resource->events)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Startdate') ?></th>
                <th><?= __('Enddate') ?></th>
                <th><?= __('AllDay') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Resource Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resource->events as $events): ?>
                <tr>
                    <td><?= h($events->id) ?></td>
                    <td><?= h($events->title) ?></td>
                    <td><?= h($events->startdate) ?></td>
                    <td><?= h($events->enddate) ?></td>
                    <td><?= h($events->allDay) ?></td>
                    <td><?= h($events->created) ?></td>
                    <td><?= h($events->modified) ?></td>
                    <td><?= h($events->resource_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'view', $events->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'edit', $events->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Events</p>
    <?php endif; ?>
</div>
