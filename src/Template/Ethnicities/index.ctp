<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Ethnicity'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Ethnicities'); ?></h2>    
    
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
            <?php foreach ($ethnicities as $ethnicity): ?>
            <tr>
                    <td><?= $this->Number->format($ethnicity->id) ?></td>
                    <td><?= h($ethnicity->name) ?></td>
                    <td><?= h($ethnicity->created) ?></td>
                    <td><?= h($ethnicity->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $ethnicity->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $ethnicity->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $ethnicity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ethnicity->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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