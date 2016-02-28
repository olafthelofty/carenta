<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Event '); ?><?= h($event->title) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($event->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Resource') ?></td>
            <td><?= $event->has('resource') ? $this->Html->link($event->resource->title, ['controller' => 'Resources', 'action' => 'view', $event->resource->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <td><?= __('All Day') ?></td>
            <td><?= $this->Number->format($event->all_day) ?></td>
        </tr>
        <tr>
            <td><?= __('Start') ?></td>
            <td><?= h($event->start) ?></td>
        </tr>
        <tr>
            <td><?= __('End') ?></td>
            <td><?= h($event->end) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($event->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($event->modified) ?></td>
        </tr>
    </table>
</div>

