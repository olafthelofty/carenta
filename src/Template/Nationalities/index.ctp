<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Nationality'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => ' Employees', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Nationalities'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('country'); ?></th>
                    <th><?= $this->Paginator->sort('code'); ?></th>
                    <th><?= $this->Paginator->sort('created'); ?></th>
                    <th><?= $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nationalities as $nationality): ?>
            <tr>
                    <td><?= $this->Number->format($nationality->id) ?></td>
                    <td><?= h($nationality->country) ?></td>
                    <td><?= $this->Number->format($nationality->code) ?></td>
                    <td><?= h($nationality->created) ?></td>
                    <td><?= h($nationality->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $nationality->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $nationality->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $nationality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nationality->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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