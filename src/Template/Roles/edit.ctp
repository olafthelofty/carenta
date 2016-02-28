<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $role->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Role Groups'), ['controller' => 'RoleGroups', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Role Group'), ['controller' => 'RoleGroups', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($role); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Role']) ?></legend>
    <?php
           // echo $this->Form->input('name');
            //echo "";
            
            echo $this->Form->input('name');
            echo $this->Form->input('role_group_id', ['options' => $roleGroups]);
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