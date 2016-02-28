<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Nationalities'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($nationality); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Nationality']) ?></legend>
    <?php
           // echo $this->Form->input('country');
            //echo "";
            
            echo $this->Form->input('country');
           // echo $this->Form->input('code');
            //echo "";
            
            echo $this->Form->input('code');
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