<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Event'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => ' Resources', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Events'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('title'); ?></th>
                    <th><?= $this->Paginator->sort('start'); ?></th>
                    <th><?= $this->Paginator->sort('end'); ?></th>
                    <th><?= $this->Paginator->sort('all_day'); ?></th>
                    <th><?= $this->Paginator->sort('created'); ?></th>
                    <th><?= $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                    <td><?= $this->Number->format($event->id) ?></td>
                    <td><?= h($event->title) ?></td>
                    <td><?= h($event->start) ?></td>
                    <td><?= h($event->end) ?></td>
                    <td><?= $this->Number->format($event->all_day) ?></td>
                    <td><?= h($event->created) ?></td>
                    <td><?= h($event->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $event->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $event->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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