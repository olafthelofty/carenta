<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $patternParent->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $patternParent->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $patternParent->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $patternParent->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($patternParent); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Pattern Parent']) ?></legend>
    <?php
    echo $this->Form->input('parent_start');
    echo $this->Form->input('parent_end');
    echo $this->Form->input('employee_id', ['options' => $employees]);
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
