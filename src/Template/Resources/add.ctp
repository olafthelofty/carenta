<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Resources'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($resource); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Resource']) ?></legend>
    <?php
           // echo $this->Form->input('title');
            //echo "";
            
            echo $this->Form->input('title');
           // echo $this->Form->input('parentID');
            //echo "";
            
            echo $this->Form->input('parentID');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>