<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Shift'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List DayParts'), ['controller' => 'DayParts', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Day Part'), ['controller' => ' DayParts', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Shifts'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('name'); ?></th>
                    <th><?= $this->Paginator->sort('day_part_id'); ?></th>
                    <th><?= $this->Paginator->sort('hours'); ?></th>
                    <th><?= $this->Paginator->sort('created'); ?></th>
                    <th><?= $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shifts as $shift): ?>
            <tr>
                    <td><?= $this->Number->format($shift->id) ?></td>
                    <td><?= h($shift->name) ?></td>
                    <td>
                    <?= $shift->has('day_part') ? $this->Html->link($shift->day_part->name, ['controller' => 'DayParts', 'action' => 'view', $shift->day_part->id]) : '' ?>
                </td>
                    <td><?= $this->Number->format($shift->hours) ?></td>
                    <td><?= h($shift->created) ?></td>
                    <td><?= h($shift->modified) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $shift->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $shift->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $shift->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shift->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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