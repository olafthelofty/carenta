<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Role Group'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Role'), ['controller' => ' Roles', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Role Groups'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('name'); ?></th>
                    <th><?= $this->Paginator->sort('created'); ?></th>
                    <th><?= $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roleGroups as $roleGroup): ?>
            <tr>
                    <td><?= $this->Number->format($roleGroup->id) ?></td>
                    <td><?= h($roleGroup->name) ?></td>
                    <td><?= h($roleGroup->created) ?></td>
                    <td><?= h($roleGroup->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $roleGroup->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $roleGroup->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $roleGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roleGroup->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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