<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Exit Destination'), ['action' => 'edit', $exitDestination->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Exit Destination'), ['action' => 'delete', $exitDestination->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exitDestination->id)]) ?> </li>
<li><?= $this->Html->link(__('List Exit Destinations'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Exit Destination'), ['action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Exit Destination '); ?><?= h($exitDestination->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($exitDestination->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($exitDestination->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Code') ?></td>
            <td><?= $this->Number->format($exitDestination->code) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($exitDestination->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($exitDestination->modified) ?></td>
        </tr>
    </table>
</div>

