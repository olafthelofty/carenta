<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit County'), ['action' => 'edit', $county->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete County'), ['action' => 'delete', $county->id], ['confirm' => __('Are you sure you want to delete # {0}?', $county->id)]) ?> </li>
<li><?= $this->Html->link(__('List Counties'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New County'), ['action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing County '); ?><?= h($county->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($county->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($county->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($county->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($county->modified) ?></td>
        </tr>
    </table>
</div>

