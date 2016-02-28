<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Counties'), ['controller' => 'Counties', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New County'), ['controller' => ' Counties', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List ExitReasons'), ['controller' => 'ExitReasons', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Exit Reason'), ['controller' => ' ExitReasons', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Role'), ['controller' => ' Roles', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Nationalities'), ['controller' => 'Nationalities', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Nationality'), ['controller' => ' Nationalities', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Ethnicities'), ['controller' => 'Ethnicities', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Ethnicity'), ['controller' => ' Ethnicities', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List ExitDestinations'), ['controller' => 'ExitDestinations', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Exit Destination'), ['controller' => ' ExitDestinations', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
<h2><?php echo __('All Employees'); ?></h2>    
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('first_name'); ?></th>
                    <th><?= $this->Paginator->sort('last_name'); ?></th>
                    <th><?= $this->Paginator->sort('start_date'); ?></th>
                    <th><?= $this->Paginator->sort('finish_date'); ?></th>
                    <th><?= $this->Paginator->sort('telephone'); ?></th>
                    <th><?= $this->Paginator->sort('mobile'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
            <tr>
                    <td><?= $this->Number->format($employee->id) ?></td>
                    <td><?= h($employee->first_name) ?></td>
                    <td><?= h($employee->last_name) ?></td>
                    <td><?php echo $employee->start_date->format("d-m-Y"); ?></td>
                    <td><?php 
                        if($employee->finish_date)
                            {echo $employee->finish_date->format("d-m-Y");}
                        else
                            {echo "Current";} ?>
                    </td>
                    <td><?= h($employee->telephone) ?></td>
                    <td><?= h($employee->mobile) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $employee->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $employee->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
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