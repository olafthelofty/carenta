<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($event); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Event']) ?></legend>
    <?php
           // echo $this->Form->input('title');
            //echo "";
            
            echo $this->Form->input('title');
           // echo $this->Form->input('start');
            //echo "";
            echo $this->Form->input('start', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('end');
            //echo "";
            echo $this->Form->input('end', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('all_day');
            //echo "";
            
            echo $this->Form->input('all_day');
           // echo $this->Form->input('created');
            //echo "";
            echo $this->Form->input('created', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('modified');
            //echo "";
            echo $this->Form->input('modified', ['type' => 'text', 'class' => 'datepicker']); 
            
            echo $this->Form->input('resource_id', ['options' => $resources]);
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>