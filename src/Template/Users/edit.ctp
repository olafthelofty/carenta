<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $user->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($user); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['User']) ?></legend>
    <?php
           // echo $this->Form->input('username');
            //echo "";
            
            echo $this->Form->input('username');
           // echo $this->Form->input('password');
            //echo "";
            
            echo $this->Form->input('password');
           // echo $this->Form->input('role');
            //echo "";
            
            <?= $this->Form->input('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
            ]) ?>
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