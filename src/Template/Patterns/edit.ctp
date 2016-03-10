<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $pattern->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $pattern->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Patterns'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $pattern->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $pattern->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Patterns'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>

<?= $this->Form->create($pattern); ?>
<fieldset>
    <legend><?= __('Edit Shift {0}', ['Pattern']) ?></legend>
    <?php
    echo $this->Form->input('employee_id', ['options' => $employees]);
        
    echo $this->Form->input('day_of_week', array(
        'options' => array(
            '1' => 'Sunday',
            '2' => 'Monday',
            '3' => 'Tuesday',
            '4' => 'Wednesday',
            '5' => 'Thursday',
            '6' => 'Friday', 
            '7' => 'Saturday'
            ), 
            'empty' => '',
            'label' => 'Day of Week'));
        
    echo $this->Form->input('week_of_year', array(
        'options' => array(
            '1' => 'Week',
            '2' => '2 Weeks',
            '3' => '3 Weeks',
            '4' => '4 Weeks',
            '5' => '5 Weeks',
            '6' => '6 Weeks', 
            '7' => '7 Weeks',
            '8' => '8 Weeks'
            ), 
            'empty' => '',
            'label' => 'Repeat every:'));
        
    echo $this->Form->input('starting_on', array(
        'options' => array(
            '1' => 'Week 1',
            '2' => 'Week 2',
            '3' => 'Week 3',
            '4' => 'Week 4',
            '5' => 'Week 5',
            '6' => 'Week 6', 
            '7' => 'Week 7',
            '8' => 'Week 8'
            ), 
            'empty' => '',
            'label' => 'Start on:'));
        
    echo $this->Form->label('Pattern.start_time', 'Start Time');
    echo $this->Form->time('start_time', ['interval' => 15]);
    echo $this->Form->label('Pattern.end_time', 'End Time');
    echo $this->Form->time('end_time', ['interval' => 15]);
        
    echo $this->Form->input('repeat_after', array(
        'options' => array(
            '1' => '1 Week',
            '2' => '2 Weeks',
            '3' => '3 Weeks',
            '4' => '4 Weeks',
            '5' => '5 Weeks',
            '6' => '6 Weeks', 
            '7' => '7 Weeks',
            '8' => '8 Weeks'
            ), 
            'empty' => '',
            'label' => 'Pattern Length'));        
        
    echo $this->Form->input('start_date');
    echo $this->Form->input('night_shift');
    ?>
</fieldset>
<?= $this->Form->button(__("Save Changes")); ?>
<?= $this->Form->end() ?>
