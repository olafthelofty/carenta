<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $dayPart->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $dayPart->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Day Parts'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Shifts'), ['controller' => 'Shifts', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Shift'), ['controller' => 'Shifts', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($dayPart); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Day Part']) ?></legend>
    <?php
           // echo $this->Form->input('name');
            //echo "";
            
            echo $this->Form->input('name');
           // echo $this->Form->input('created');
            //echo "";
            echo $this->Form->input('created', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('modified');
            //echo "";
            echo $this->Form->input('modified', ['type' => 'text', 'class' => 'datepicker']); 
            
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>