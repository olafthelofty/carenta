<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Pattern Parent'), ['action' => 'edit', $patternParent->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Pattern Parent'), ['action' => 'delete', $patternParent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patternParent->id)]) ?> </li>
<li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Pattern Parent'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Pattern Parent'), ['action' => 'edit', $patternParent->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Pattern Parent'), ['action' => 'delete', $patternParent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patternParent->id)]) ?> </li>
<li><?= $this->Html->link(__('List Pattern Parents'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Pattern Parent'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($patternParent->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Employee') ?></td>
            <td><?= $patternParent->has('employee') ? $this->Html->link($patternParent->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $patternParent->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($patternParent->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Parent Start') ?></td>
            <td><?= h($patternParent->parent_start) ?></td>
        </tr>
        <tr>
            <td><?= __('Parent End') ?></td>
            <td><?= h($patternParent->parent_end) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($patternParent->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($patternParent->modified) ?></td>
        </tr>
    </table>
</div>

<div class="row">

        <div class="panel panel-success">
            <!-- Panel header -->
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Related Patterns') ?></h3>
            </div>
            <div class="panel-body">
                 <?php if (!empty($patternParent->patterns)): ?>
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Employee Name') ?></th>
                            <th><?= __('Day Of Week') ?></th>
                            <th><?= __('Week Of Year') ?></th>
                            <th><?= __('Starting On') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('Repeat After') ?></th>
                            <th><?= __('Night Shift') ?></th>
                            <th><?= __('Resource Id') ?></th>
                            <!--<th class="actions myActions"><?= __('Actions') ?></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($patternParent->patterns as $patterns): ?>
                            <tr>
                                <td><?= h($patterns->id) ?></td>
                                
                                
                                <td>
                                    <?= 
                                        $patterns->has('employee') ? 
                                            $this->Html->link($patterns->employee->first_name . ' ' . $patterns->employee->last_name, [
                                                'controller' => 'Employees', 'action' => 'view', $patterns->employee->id
                                                ]) : 
                                            'No employee' ?></td>              
                                
                                <td><?= h($patterns->day_of_week) ?></td>
                                <td><?= h($patterns->week_of_year) ?></td>
                                <td><?= h($patterns->starting_on) ?></td>
                                <td><?= h(date('H:i',strtotime($patterns->resource->start_time))) ?></td>
                                <td><?= h(date('H:i',strtotime($patterns->resource->end_time))) ?></td>
                                <td><?= h(date('d M Y',strtotime($patterns->start_date))) ?></td> 
                                <td><?= h($patterns->repeat_after) ?></td>
                                <td><?= h($patterns->resource->night_shift)?'Yes':'No' ?></td>
                                <td><?= h($patterns->resource_id) ?></td>
                                <!--<td class="actions myActions">
                                    <?= $this->Html->link('', ['controller' => 'Patterns', 'action' => 'view', $patterns->id], ['title' => __('View'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-eye-open']) ?>
                                    <?= $this->Html->link('', ['controller' => 'Patterns', 'action' => 'edit', $patterns->id], ['title' => __('Edit'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-pencil']) ?>
                                    <?= $this->Form->postLink('', ['controller' => 'Patterns', 'action' => 'delete', $patterns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patterns->id), 'title' => __('Delete'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-trash']) ?>
                                </td>-->
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="panel-body">no related Patterns</p>
                <?php endif; ?>
            </div>
        </div>
       
    </div>

