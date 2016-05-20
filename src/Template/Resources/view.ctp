<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<div class="container col-md-12">
    <div class="row">
        <div class="panel panel-success">
            <!-- Panel header -->
            <div class="panel-heading">
                <h2 class="panel-title">
                    <?php echo __('Viewing Resource: '); ?><?= h($resource->title) ?>
                    <div class="btn-group pull-right">
                        
                        <?= $this->Html->link('', [
                            'controller' => 'Resources', 
                            'action' => 'edit', 
                            $resource->id,
                            //get current url including page number to pass to controller
                            'url' => $this->Paginator->generateUrl()],
                            ['title' => __('Edit'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-pencil']
                            ) 
                        ?>              
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-bordered table-responsive col-md-12">
            <tr>
                <td><?= __('Id') ?></td>
                <td><?= $this->Number->format($resource->id) ?></td>
            </tr>        
            <tr>
                <td><?= __('Title') ?></td>
                <td><?= h($resource->title) ?></td>
            </tr>
            <tr>
                <td><?= __('Heading') ?></td>
                <td>
                    <?php echo ($resource->heading?'Yes':'No') ?>
                </td>
            </tr>
            <tr>
                <td><?= __('Parent') ?></td>
                <td>              
                    <?= $resource->has('parent') ? $this->Html->link($resource->parent->title, ['controller' => 'Resources', 'action' => 'view', $resource->parent->id]) : 'This is a heading' ?>            
                </td>
            </tr>
            <tr>
                <td><?= __('Night Shift') ?></td>
                <td><?php echo ($resource->night_shift? 'Yes':'No') ?></td>
            </tr>
            <tr>
                <td><?= __('Start Time') ?></td>
                <td><?= h($resource->start_time->format('H:i')) ?></td>
            </tr>
            <tr>
                <td><?= __('End Time') ?></td>
                <td><?= h($resource->end_time->format('H:i')) ?></td>
            </tr>       
            <tr>
                <td><?= __('Event Background Colour') ?></td>
                <td>
                    <div class="output">
                            <span style="background:<?php echo $resource->event_background_color; ?>">
                    </div>                
                </td>
            
            </tr>        
        </table>
    </div>
    
    <div class="row">

        <div class="panel panel-success">
            <!-- Panel header -->
            <div class="panel-heading">
                <h2 class="panel-title"><?= __('Related Events') ?></h2>
            </div>
            <div class="panel-body">
                 <?php if (!empty($resource->events)): ?>

                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Title') ?></th>
                        <th><?= __('Start Date') ?></th>
                        <th><?= __('End Date') ?></th>
                        <th><?= __('All Day') ?></th>
                        <!--<th class="actions myActions"><?= __('Actions') ?></th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resource->events as $events): ?>
                        <tr>
                            <td><?= h($events->id) ?></td>
                            <td><?= h($events->title) ?></td>
                            <td><?= h(date('d M Y',strtotime($events->startdate))) ?></td>                   
                            <td><?= h(date('d M Y',strtotime($events->enddate))) ?></td>
                            <td><?= h($events->allDay) ?></td>
                            <!--<td class="actions myActions">
                                <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'view', $events->id], ['title' => __('View'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-eye-open']) ?>
                                <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'edit', $events->id], ['title' => __('Edit'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-pencil']) ?>
                                <?= $this->Form->postLink('', ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id), 'title' => __('Delete'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-trash']) ?>
                            </td>-->
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
        
                <?php else: ?>
                    <p class="panel-body">no related Events</p>
                <?php endif; ?>
                
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                </div> 
                  
            </div>
            
        </div>
       
    </div>
    
    <div class="row">

        <div class="panel panel-success">
            <!-- Panel header -->
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Related Patterns') ?></h3>
            </div>
            <div class="panel-body">
                 <?php if (!empty($resource->patterns)): ?>
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Employee Id') ?></th>
                            <th><?= __('Day Of Week') ?></th>
                            <th><?= __('Week Of Year') ?></th>
                            <th><?= __('Starting On') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('Repeat After') ?></th>
                            <th><?= __('Night Shift') ?></th>
                            <th><?= __('Resource Id') ?></th>
                            <!--<th class="actions myActions"><?= __('Actions') ?></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($resource->patterns as $patterns): ?>
                            <tr>
                                <td><?= h($patterns->id) ?></td>
                                
                                
                                <td>
                                    <?= 
                                        $patterns->has('employee') ? 
                                            $this->Html->link($patterns->employee->name, [
                                                'controller' => 'Employees', 'action' => 'view', $patterns->employee->id
                                                ]) : 
                                            'No employee' ?></td>              
                                
                                <td><?= h($patterns->day_of_week) ?></td>
                                <td><?= h($patterns->week_of_year) ?></td>
                                <td><?= h($patterns->starting_on) ?></td>
                                <td><?= h($patterns->start_time) ?></td>
                                <td><?= h($patterns->end_time) ?></td>
                                <td><?= h(date('d M Y',strtotime($patterns->start_date))) ?></td> 
                                <td><?= h($patterns->repeat_after) ?></td>
                                <td><?= h($patterns->night_shift) ?></td>
                                <td><?= h($patterns->resource_id) ?></td>
                                <!--<td class="actions myActions">
                                    <?= $this->Html->link('', ['controller' => 'Patterns', 'action' => 'view', $patterns->id], ['title' => __('View'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-eye-open']) ?>
                                    <?= $this->Html->link('', ['controller' => 'Patterns', 'action' => 'edit', $patterns->id], ['title' => __('Edit'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-pencil']) ?>
                                    <?= $this->Form->postLink('', ['controller' => 'Patterns', 'action' => 'delete', $patterns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patterns->id), 'title' => __('Delete'), 'class' => 'btn btn-xs btn-default glyphicon glyphicon-trash']) ?>
                                </td>-->
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="panel-body">no related Patterns</p>
                <?php endif; ?>
            </div>
        </div>
       
    </div>
</div>