<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
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
<?= $this->Form->create($employee); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Employee']) ?></legend>
     
    <?php
           // echo $this->Form->input('first_name');
            //echo "";
            
            echo $this->Form->input('first_name');
           // echo $this->Form->input('last_name');
            //echo "";
            
            echo $this->Form->input('last_name');
           // echo $this->Form->input('start_date');
            //echo "";
            echo $this->Form->input('start_date', [ 
                'empty' => true, 'default' => '',
                'minYear' => date('Y') - 20,
                'maxYear' => date('Y') + 2
                ]);
       
            
           // echo $this->Form->input('finish_date');
            //echo "";
            echo $this->Form->input('finish_date', [
                'empty' => true, 'default' => '',
                'minYear' => date('Y') - 5,
                'maxYear' => date('Y') + 2
                ]); 
            
           // echo $this->Form->input('telephone');
            //echo "";
            
            echo $this->Form->input('telephone');
           // echo $this->Form->input('mobile');
            //echo "";
            
            echo $this->Form->input('mobile');
           // echo $this->Form->input('email');
            //echo "";
            
            echo $this->Form->input('email');
           // echo $this->Form->input('address_1');
            //echo "";
            
            echo $this->Form->input('address_1');
           // echo $this->Form->input('address_2');
            //echo "";
            
            echo $this->Form->input('address_2');
           // echo $this->Form->input('town');
            //echo "";
            
            echo $this->Form->input('town');
            echo $this->Form->input('county_id', ['options' => $counties]);
           // echo $this->Form->input('postcode');
            //echo "";
            
            echo $this->Form->input('postcode');
           // echo $this->Form->input('date_of_birth');
            //echo "";
            echo $this->Form->input('date_of_birth', [
                'empty' => true, 'default' => '',
                'minYear' => date('Y') - 70,
                'maxYear' => date('Y') - 18
                ]
            ); 
            
           // echo $this->Form->input('ni_number');
            //echo "";
            
            echo $this->Form->input('ni_number');
           // echo $this->Form->input('timesheet_user');
            //echo "";
            
            echo $this->Form->input('timesheet_user');
        
            echo $this->Form->input('exit_reason_id', ['options' => $exitReasons]);
            echo $this->Form->input('exit_destination_id', ['options' => $exitDestinations]);
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('nationality_id', ['options' => $nationalities]);
            echo $this->Form->input('ethnicity_id', ['options' => $ethnicities]);
            
           // echo $this->Form->input('created');
            //echo "";
            //echo $this->Form->input('created', ['type' => 'text', 'class' => 'datepicker']); 
            
           // echo $this->Form->input('modified');
            //echo "";
            //echo $this->Form->input('modified', ['type' => 'text', 'class' => 'datepicker']); 
            
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>