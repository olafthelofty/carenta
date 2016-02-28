<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Day Part'), ['action' => 'edit', $dayPart->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Day Part'), ['action' => 'delete', $dayPart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dayPart->id)]) ?> </li>
<li><?= $this->Html->link(__('List Day Parts'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Day Part'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Shifts'), ['controller' => 'Shifts', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Shift'), ['controller' => 'Shifts', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Day Part '); ?><?= h($dayPart->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($dayPart->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($dayPart->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($dayPart->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($dayPart->modified) ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Shifts') ?></h3>
    </div>
    <?php if (!empty($dayPart->shifts)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Day Part Id') ?></th>
                <th><?= __('Hours') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dayPart->shifts as $shifts): ?>
                <tr>
                    <td><?= h($shifts->id) ?></td>
                    <td><?= h($shifts->name) ?></td>
                    <td><?= h($shifts->day_part_id) ?></td>
                    <td><?= h($shifts->hours) ?></td>
                    <td><?= h($shifts->created) ?></td>
                    <td><?= h($shifts->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Shifts', 'action' => 'view', $shifts->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Shifts', 'action' => 'edit', $shifts->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Shifts', 'action' => 'delete', $shifts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shifts->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Shifts</p>
    <?php endif; ?>
</div>
