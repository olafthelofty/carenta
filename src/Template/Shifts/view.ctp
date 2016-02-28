<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Shift'), ['action' => 'edit', $shift->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Shift'), ['action' => 'delete', $shift->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shift->id)]) ?> </li>
<li><?= $this->Html->link(__('List Shifts'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Shift'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Day Parts'), ['controller' => 'DayParts', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Day Part'), ['controller' => 'DayParts', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Shift '); ?><?= h($shift->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($shift->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Day Part') ?></td>
            <td><?= $shift->has('day_part') ? $this->Html->link($shift->day_part->name, ['controller' => 'DayParts', 'action' => 'view', $shift->day_part->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($shift->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Hours') ?></td>
            <td><?= $this->Number->format($shift->hours) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($shift->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($shift->modified) ?></td>
        </tr>
    </table>
</div>

