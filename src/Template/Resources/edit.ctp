<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $resource->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Resources'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Patterns'), ['controller' => 'Patterns', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Pattern'), ['controller' => 'Patterns', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $resource->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Resources'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Patterns'), ['controller' => 'Patterns', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Pattern'), ['controller' => 'Patterns', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($resource); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Resource']) ?></legend>
    <?php
    echo $this->Form->input('title');
    echo $this->Form->input('heading', ['id' => 'heading']);
    echo $this->Form->input('allDay');
    echo $this->Form->input('night_shift');
    echo $this->Form->input('parent_id', ['options' => $query]);
    echo $this->Form->input('start_time');
    echo $this->Form->input('end_time'); 
    echo $this->Form->input('event_background_color', ['class' => 'colorpick']);
    
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
