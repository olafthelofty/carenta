<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $exitDestination->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $exitDestination->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Exit Destinations'), ['action' => 'index']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($exitDestination); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Exit Destination']) ?></legend>
    <?php
           // echo $this->Form->input('name');
            //echo "";
            
            echo $this->Form->input('name');
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
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>