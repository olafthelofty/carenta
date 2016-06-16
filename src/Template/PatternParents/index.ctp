<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Pattern Parent'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => ' Employees', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('parent_start'); ?></th>
            <th><?= $this->Paginator->sort('parent_end'); ?></th>
            <th><?= $this->Paginator->sort('employee_id'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patternParents as $patternParent): ?>
        <tr>
            <td><?= $this->Number->format($patternParent->id) ?></td>
            <td><?= h($patternParent->parent_start) ?></td>
            <td><?= h($patternParent->parent_end) ?></td>
            <td>
                <?= $patternParent->has('employee') ? $this->Html->link($patternParent->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $patternParent->employee->id]) : '' ?>
            </td>
            <td><?= h($patternParent->created) ?></td>
            <td><?= h($patternParent->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $patternParent->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $patternParent->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $patternParent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patternParent->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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