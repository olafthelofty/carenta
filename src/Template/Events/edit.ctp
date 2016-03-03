<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $event->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $event->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($event); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Event']) ?></legend>
    <?php
    echo $this->Form->input('title');
    echo $this->Form->input('startdate');
    echo $this->Form->input('enddate');
    echo $this->Form->input('allDay');
    echo $this->Form->input('resource_id', ['options' => $resources]);
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
