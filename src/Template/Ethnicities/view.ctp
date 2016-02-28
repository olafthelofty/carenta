<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Ethnicity'), ['action' => 'edit', $ethnicity->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Ethnicity'), ['action' => 'delete', $ethnicity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ethnicity->id)]) ?> </li>
<li><?= $this->Html->link(__('List Ethnicities'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ethnicity'), ['action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Ethnicity '); ?><?= h($ethnicity->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($ethnicity->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($ethnicity->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($ethnicity->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($ethnicity->modified) ?></td>
        </tr>
    </table>
</div>

