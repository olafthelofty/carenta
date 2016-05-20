<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Resource'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => ' Events', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Patterns'), ['controller' => 'Patterns', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Pattern'), ['controller' => ' Patterns', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('title'); ?></th>
            <th><?= $this->Paginator->sort('start_time'); ?></th>
            <th><?= $this->Paginator->sort('end_time'); ?></th>
            <th><?= $this->Paginator->sort('event_background_color', 'Colour'); ?></th>   
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
      
        <?php 
            foreach ($resources as $parent):
                if($parent->heading){
                    echo '<tr><td colspan="7"><b>'. $parent->title .'</b></td></tr>';
                } else {
                    echo '<tr><td colspan="7"></td></tr>';
                }
        ?>
          
        <?php foreach ($parent->children as $resource): ?>
            
        <tr>
            <?php if($resource->heading){ ?>

                <td><?= $this->Number->format($resource->id) ?></td>
                <td><b><?= h($resource->title) ?></b></td>           
                <td></td>
                <td></td> 
                <td></td>           
  
            <?php }else{ ?>
            
                <td><?= $this->Number->format($resource->id) ?></td>
                <td><?= h($resource->title) ?></td>
                <td><?= h($resource->start_time->format('H:i')) ?></td>
                <td><?= h($resource->end_time->format('H:i')) ?></td>
                <td>
                    <div class="output">
                        <span style="background:<?php echo $resource->event_background_color; ?>">
                    </div>
                </td>
            
            <?php } ?>
            
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $resource->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $resource->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
</div>