<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Pattern'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => ' Employees', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => ' Resources', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('employee_id'); ?></th>
            <th><?= $this->Paginator->sort('day_of_week'); ?></th>
            <th><?= $this->Paginator->sort('week_of_year'); ?></th>
            <th><?= $this->Paginator->sort('starting_on'); ?></th>
            <th><?= $this->Paginator->sort('start_time'); ?></th>
            <th><?= $this->Paginator->sort('end_time'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patterns as $pattern): ?>
        <tr>
            <td><?= $this->Number->format($pattern->id) ?></td>
            <td>
                <?= $pattern->has('employee') ? $this->Html->link($pattern->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $pattern->employee->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($pattern->day_of_week) ?></td>
            <td><?= $this->Number->format($pattern->week_of_year) ?></td>
            <td><?= $this->Number->format($pattern->starting_on) ?></td>
            <td><?= h($pattern->start_time) ?></td>
            <td><?= h($pattern->end_time) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $pattern->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $pattern->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $pattern->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pattern->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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