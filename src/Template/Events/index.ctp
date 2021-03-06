<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Event'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => ' Resources', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('title'); ?></th>
            <th><?= $this->Paginator->sort('startdate'); ?></th>
            <th><?= $this->Paginator->sort('enddate'); ?></th>
            <th><?= $this->Paginator->sort('allDay'); ?></th>
            <th><?= $this->Paginator->sort('Resource'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $this->Number->format($event->id) ?></td>
            <td><?= h($event->title) ?></td>
            <td><?= h($event->startdate) ?></td>
            <td><?= h($event->enddate) ?></td>
            <td><?= h($event->allDay) ?></td>
            <td><?= $event->has('resource') ? $this->Html->link($event->resource->title, ['controller' => 'Resources', 'action' => 'view', $event->resource->id]) : '' ?></td>
            <td><?= h($event->created) ?></td>
            <td><?= h($event->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $event->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $event->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>