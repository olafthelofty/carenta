<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Project'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

   
<div id='later'></div>

<h2><?php echo __('All Projects'); ?></h2> 
    
<div class="table-responsive">     
    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped">
        <thead>
            <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('name'); ?></th>
                    <th><?= $this->Paginator->sort('slug'); ?></th>
                    <th><?= $this->Paginator->sort('created_at'); ?></th>
                    <th><?= $this->Paginator->sort('updated_at'); ?></th>
                    <th><?= $this->Paginator->sort('dateofbirth'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                    <td><?= $this->Number->format($project->id) ?></td>
                    <td><?= h($project->name) ?></td>
                    <td><?= h($project->slug) ?></td>
                    <td><?= h($project->created_at) ?></td>
                    <td><?= h($project->updated_at) ?></td>
                    <td><?= h($project->dateofbirth) ?></td>
                    <td class="actions col-md-3">
                    <div class="btn-group input-group btn-group-justified">
                    <?= $this->Html->link('View', ['action' => 'view', $project->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm']) ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $project->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']) ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!--
<div id="calendar"></div>
<div id="eventdata">hi</div>
-->


	<div id='wrap'>

		<div id='external-events'>
			<h4>Draggable Events</h4>
			<div class='fc-event'>New Event</div>
            <div class='fc-event'>Another Event</div>
			<p>
				<img src="img/trashcan.png" id="trash" alt="">
			</p>
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

		<xspan class="tt">x</xspan>
        
	</div>

<!--<div class="cal1"><script type="text/template" id="template-calendar"><?php //echo $this->element('Projects/template-calendar'); ?></script></div>-->

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>