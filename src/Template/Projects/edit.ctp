<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $project->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($project); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Project']) ?></legend>
    <?php
           // echo $this->Form->input('name');
            //echo "";
            
            echo $this->Form->input('name');
           // echo $this->Form->input('slug');
            //echo "";
            
            echo $this->Form->input('slug');
           // echo $this->Form->input('created_at');
            //echo "";
           // echo $this->Form->input('updated_at');
            //echo "";
           // echo $this->Form->input('dateofbirth');
            //echo "";
            echo $this->Form->input('dateofbirth', ['type' => 'text', 'class' => 'datepicker']); 
            
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>