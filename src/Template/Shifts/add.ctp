<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Shifts'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Day Parts'), ['controller' => 'DayParts', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Day Part'), ['controller' => 'DayParts', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($shift); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Shift']) ?></legend>
    <?php
           // echo $this->Form->input('name');
            //echo "";
            
            echo $this->Form->input('name');
            echo $this->Form->input('day_part_id', ['options' => $dayParts]);
           // echo $this->Form->input('hours');
            //echo "";
            
            echo $this->Form->input('hours');
           // echo $this->Form->input('created');
            //echo "";
            echo $this->Form->input('created', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('modified');
            //echo "";
            echo $this->Form->input('modified', ['type' => 'text', 'class' => 'datepicker']); 
            
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>