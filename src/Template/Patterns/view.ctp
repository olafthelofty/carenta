<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Pattern'), ['action' => 'edit', $pattern->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Pattern'), ['action' => 'delete', $pattern->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pattern->id)]) ?> </li>
<li><?= $this->Html->link(__('List Patterns'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Pattern'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Pattern'), ['action' => 'edit', $pattern->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Pattern'), ['action' => 'delete', $pattern->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pattern->id)]) ?> </li>
<li><?= $this->Html->link(__('List Patterns'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Pattern'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h('Pattern id: ' . $pattern->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Employee') ?></td>
            <td><?= $pattern->has('employee') ? $this->Html->link($pattern->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $pattern->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Start Time') ?></td>
            <td><?= h($pattern->start_time->format('H:i')) ?></td>
        </tr>
        <tr>
            <td><?= __('End Time') ?></td>
            <td><?= h($pattern->end_time->format('H:i')) ?></td>
        </tr>
        <tr>
            <td><?= __('Day Of Week') ?></td> 
            <td><?php echo date('l', strtotime("Sunday +{$pattern->day_of_week} days")); ?></td>    
        </tr>
        <tr>
            <td><?= __('Week Of Year') ?></td>
            <td><?= $this->Number->format($pattern->week_of_year) ?></td>
        </tr>
        <tr>
            <td><?= __('Starting On') ?></td>
            <td><?= $this->Number->format($pattern->starting_on) ?></td>
        </tr>
        <tr>
            <td><?= __('Start Date') ?></td>
            <td><?= h($pattern->start_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Night Shift') ?></td>
            <td><?= h($pattern->night_shift ? 'Yes' : 'No') ?></td>
        </tr>        
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($pattern->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($pattern->modified) ?></td>
        </tr>
    </table>
</div>

