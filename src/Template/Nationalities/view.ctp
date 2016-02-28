<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Nationality'), ['action' => 'edit', $nationality->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Nationality'), ['action' => 'delete', $nationality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nationality->id)]) ?> </li>
<li><?= $this->Html->link(__('List Nationalities'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Nationality'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Nationality '); ?><?= h($nationality->id) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Country') ?></td>
            <td><?= h($nationality->country) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($nationality->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Code') ?></td>
            <td><?= $this->Number->format($nationality->code) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($nationality->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($nationality->modified) ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Employees') ?></h3>
    </div>
    <?php if (!empty($nationality->employees)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Start Date') ?></th>
                <th><?= __('Finish Date') ?></th>
                <th><?= __('Telephone') ?></th>
                <th><?= __('Mobile') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Address 1') ?></th>
                <th><?= __('Address 2') ?></th>
                <th><?= __('Town') ?></th>
                <th><?= __('County Id') ?></th>
                <th><?= __('Postcode') ?></th>
                <th><?= __('Date Of Birth') ?></th>
                <th><?= __('Ni Number') ?></th>
                <th><?= __('Timesheet User') ?></th>
                <th><?= __('Exit Reason Id') ?></th>
                <th><?= __('Role Id') ?></th>
                <th><?= __('Nationality Id') ?></th>
                <th><?= __('Ethnicity Id') ?></th>
                <th><?= __('Exit Destination Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($nationality->employees as $employees): ?>
                <tr>
                    <td><?= h($employees->id) ?></td>
                    <td><?= h($employees->first_name) ?></td>
                    <td><?= h($employees->last_name) ?></td>
                    <td><?= h($employees->start_date) ?></td>
                    <td><?= h($employees->finish_date) ?></td>
                    <td><?= h($employees->telephone) ?></td>
                    <td><?= h($employees->mobile) ?></td>
                    <td><?= h($employees->email) ?></td>
                    <td><?= h($employees->address_1) ?></td>
                    <td><?= h($employees->address_2) ?></td>
                    <td><?= h($employees->town) ?></td>
                    <td><?= h($employees->county_id) ?></td>
                    <td><?= h($employees->postcode) ?></td>
                    <td><?= h($employees->date_of_birth) ?></td>
                    <td><?= h($employees->ni_number) ?></td>
                    <td><?= h($employees->timesheet_user) ?></td>
                    <td><?= h($employees->exit_reason_id) ?></td>
                    <td><?= h($employees->role_id) ?></td>
                    <td><?= h($employees->nationality_id) ?></td>
                    <td><?= h($employees->ethnicity_id) ?></td>
                    <td><?= h($employees->exit_destination_id) ?></td>
                    <td><?= h($employees->created) ?></td>
                    <td><?= h($employees->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Employees', 'action' => 'view', $employees->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Employees', 'action' => 'edit', $employees->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Employees</p>
    <?php endif; ?>
</div>
