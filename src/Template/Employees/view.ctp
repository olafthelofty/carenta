<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Counties'), ['controller' => 'Counties', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New County'), ['controller' => 'Counties', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Exit Reasons'), ['controller' => 'ExitReasons', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Exit Reason'), ['controller' => 'ExitReasons', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Nationalities'), ['controller' => 'Nationalities', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Nationality'), ['controller' => 'Nationalities', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Ethnicities'), ['controller' => 'Ethnicities', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ethnicity'), ['controller' => 'Ethnicities', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Exit Destinations'), ['controller' => 'ExitDestinations', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Exit Destination'), ['controller' => 'ExitDestinations', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Employee '); ?><?= h($employee->id) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('First Name') ?></td>
            <td><?= h($employee->first_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Last Name') ?></td>
            <td><?= h($employee->last_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Telephone') ?></td>
            <td><?= h($employee->telephone) ?></td>
        </tr>
        <tr>
            <td><?= __('Mobile') ?></td>
            <td><?= h($employee->mobile) ?></td>
        </tr>
        <tr>
            <td><?= __('Email') ?></td>
            <td><?= h($employee->email) ?></td>
        </tr>
        <tr>
            <td><?= __('Address 1') ?></td>
            <td><?= h($employee->address_1) ?></td>
        </tr>
        <tr>
            <td><?= __('Address 2') ?></td>
            <td><?= h($employee->address_2) ?></td>
        </tr>
        <tr>
            <td><?= __('Town') ?></td>
            <td><?= h($employee->town) ?></td>
        </tr>
        <tr>
            <td><?= __('County') ?></td>
            <td><?= $employee->has('county') ? $this->Html->link($employee->county->name, ['controller' => 'Counties', 'action' => 'view', $employee->county->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Postcode') ?></td>
            <td><?= h($employee->postcode) ?></td>
        </tr>
        <tr>
            <td><?= __('Ni Number') ?></td>
            <td><?= h($employee->ni_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Exit Reason') ?></td>
            <td><?= $employee->has('exit_reason') ? $this->Html->link($employee->exit_reason->name, ['controller' => 'ExitReasons', 'action' => 'view', $employee->exit_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Role') ?></td>
            <td><?= $employee->has('role') ? $this->Html->link($employee->role->name, ['controller' => 'Roles', 'action' => 'view', $employee->role->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Nationality') ?></td>
            <td><?= $employee->has('nationality') ? $this->Html->link($employee->nationality->country, ['controller' => 'Nationalities', 'action' => 'view', $employee->nationality->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Ethnicity') ?></td>
            <td><?= $employee->has('ethnicity') ? $this->Html->link($employee->ethnicity->name, ['controller' => 'Ethnicities', 'action' => 'view', $employee->ethnicity->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Exit Destination') ?></td>
            <td><?= $employee->has('exit_destination') ? $this->Html->link($employee->exit_destination->name, ['controller' => 'ExitDestinations', 'action' => 'view', $employee->exit_destination->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Start Date') ?></td>
            <td><?php echo $employee->start_date->format("l jS \of F Y"); ?></td>
        </tr>
        <tr>
            <td><?= __('Finish Date') ?></td>
            <td><?php echo $employee->finish_date->format("l jS \of F Y"); ?></td>
        </tr>
        <tr>
            <td><?= __('Date Of Birth') ?></td>
            <td><?php echo $employee->date_of_birth->format("l jS \of F Y") . " (" . $age . " years old)"; ?></td>
        </tr>
<!--
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($employee->modified) ?></td>
        </tr>
-->
        <tr>
            <td><?= __('Timesheet User') ?></td>
            <td><?= $employee->timesheet_user ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

