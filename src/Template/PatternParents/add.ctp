<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($patternParent); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Pattern Parent']) ?></legend>
    <?php
    echo $this->Form->input('parent_start');
    echo $this->Form->input('parent_end');
    echo $this->Form->input('employee_id', ['options' => $employees]);
    echo $this->Form->input('leave_factor');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
