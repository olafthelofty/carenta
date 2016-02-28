<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Role Group'), ['action' => 'edit', $roleGroup->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Role Group'), ['action' => 'delete', $roleGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roleGroup->id)]) ?> </li>
<li><?= $this->Html->link(__('List Role Groups'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Role Group'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Role Group '); ?><?= h($roleGroup->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($roleGroup->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($roleGroup->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($roleGroup->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($roleGroup->modified) ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Roles') ?></h3>
    </div>
    <?php if (!empty($roleGroup->roles)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Role Group Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($roleGroup->roles as $roles): ?>
                <tr>
                    <td><?= h($roles->id) ?></td>
                    <td><?= h($roles->name) ?></td>
                    <td><?= h($roles->role_group_id) ?></td>
                    <td><?= h($roles->created) ?></td>
                    <td><?= h($roles->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Roles', 'action' => 'view', $roles->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Roles</p>
    <?php endif; ?>
</div>
