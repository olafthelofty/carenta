<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Role'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List RoleGroups'), ['controller' => 'RoleGroups', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Role Group'), ['controller' => ' RoleGroups', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Roles'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('name'); ?></th>
                    <th><?= $this->Paginator->sort('role_group_id'); ?></th>
                    <th><?= $this->Paginator->sort('created'); ?></th>
                    <th><?= $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                    <td><?= $this->Number->format($role->id) ?></td>
                    <td><?= h($role->name) ?></td>
                    <td>
                    <?= $role->has('role_group') ? $this->Html->link($role->role_group->name, ['controller' => 'RoleGroups', 'action' => 'view', $role->role_group->id]) : '' ?>
                </td>
                    <td><?= h($role->created) ?></td>
                    <td><?= h($role->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $role->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $role->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>