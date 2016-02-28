<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Exit Reason'), ['action' => 'edit', $exitReason->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Exit Reason'), ['action' => 'delete', $exitReason->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exitReason->id)]) ?> </li>
<li><?= $this->Html->link(__('List Exit Reasons'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Exit Reason'), ['action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Exit Reason '); ?><?= h($exitReason->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($exitReason->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($exitReason->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($exitReason->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($exitReason->modified) ?></td>
        </tr>
    </table>
</div>

