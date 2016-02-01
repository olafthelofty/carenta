<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
<li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h2 class="panel-title"><?php echo __('Viewing Project '); ?><?= h($project->name) ?></h2>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($project->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Slug') ?></td>
            <td><?= h($project->slug) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created At') ?></td>
            <td><?= h($project->created_at) ?></td>
        </tr>
        <tr>
            <td><?= __('Updated At') ?></td>
            <td><?= h($project->updated_at) ?></td>
        </tr>
        <tr>
            <td><?= __('Dateofbirth') ?></td>
            <td><?= h($project->dateofbirth) ?></td>
        </tr>
    </table>
</div>

