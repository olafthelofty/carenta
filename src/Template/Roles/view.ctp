<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
<li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Role Groups'), ['controller' => 'RoleGroups', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Role Group'), ['controller' => 'RoleGroups', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Role '); ?><?= h($role->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($role->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Role Group') ?></td>
            <td><?= $role->has('role_group') ? $this->Html->link($role->role_group->name, ['controller' => 'RoleGroups', 'action' => 'view', $role->role_group->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($role->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($role->modified) ?></td>
        </tr>
    </table>
</div>

