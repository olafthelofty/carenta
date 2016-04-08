<?php

//use Cake\Routing\Router;

$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<?php foreach ($employees as $employee): ?>

<div class="row">
    <div class="col-sm-3">
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
       
        <div class="text-center">  
         <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
        
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
        </div>
            </div>
        
       
    </div>
    
     <div class="table-responsive">
         
        <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($employee->full_name) ?></td>
        </tr>
        <tr>
            <td><?= __('ID') ?></td>
            <td><?= h($employee->id) ?></td>
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
            <td><?= $employee->has('ethnicity') ? $this->Html->link($this->Text->truncate($employee->ethnicity->name, 32, ['ellipsis' => '...', 'exact' => false]), ['controller' => 'Ethnicities', 'action' => 'view', $employee->ethnicity->id]) : '' ?></td>
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
            <td><?= h(date('d M Y',strtotime($employee->start_date))) ?></td>
        </tr>
        <tr>
            <td><?= __('Finish Date') ?></td>
            <td><?= h($employee->finish_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Date Of Birth') ?></td>
            <td><?= h(date('d M Y',strtotime($employee->date_of_birth))) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h(date('d M Y',strtotime($employee->created))) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h(date('d M Y',strtotime($employee->modified))) ?></td>
        </tr>
        <tr>
            <td><?= __('Timesheet User') ?></td>
            <td><?= $employee->timesheet_user ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Current') ?></td>
            <td><?= $employee->current ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    </div>    
    
</div>
 </div>       
        <div class="col-sm-9">
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                        <button type="button" class="btn btn-success btn-sm" id="patternRefresh">Refresh Calendar</button>                                    
                        
                    </div>
                    <div class="panel-body">
                        <div id='calendar'></div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <!-- Panel header -->
                    
                    <div class="panel-heading text-right">
                      <div class="nav"><!-- clears floated buttons -->

                        <div class="btn-group pull-left" data-toggle="buttons">
                            <h3 class="panel-title"><?php echo 'Shift Pattern for ' . $employee->full_name; ?></h3>
                        </div>

                            <!--<button type="button" class="btn btn-success btn-sm" id="testStuff">Test</button>
                            <button type="button" data-id=<?php echo $employee->id; ?> class="btn btn-success btn-sm" id="patternApply">Apply Shift Template</button>-->
                            <?php

                                    echo $this->Html->link('Test',
                                    array('controller' => 'Events', 'action' => 'patternevent'),
                                    array('class' => 'btn btn-danger btn-sm active')
                                    ); 
                    
                            ?>
                            <?php

                                if (!empty($employee->patterns)){

                                    echo $this->Html->link('Delete Shift Template',
                                    array('controller' => 'Patterns', 'action' => 'deleteWeekTemplate', 'employee_id' => $employee->id),
                                    array('class' => 'btn btn-danger btn-sm active')
                                    ); 
                                }else{
                                    echo $this->Html->link('New Shift Template',
                                    array('controller' => 'Patterns', 'action' => 'addWeekTemplate', 'employee_id' => $employee->id),
                                    array('class' => 'btn btn-success btn-sm active')
                                    );
                                }
                            ?> 
                        

                      </div>
                    </div>

                    <?php if (!empty($employee->patterns)): ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                
                                <th><?= __('Day of Week') ?></th>
                                <th><?= __('Repeat Every') ?></th>
                                <th><?= __('Starting On') ?></th>
                                <th><?= __('Start Date') ?></th>
                                <th><?= __('Repeat After') ?></th>
                                <th><?= __('Night Shift') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($employee->patterns as $patterns): ?>
                                <tr>
                                    
                                    <td><?php echo date('l', strtotime("Saturday +{$patterns->day_of_week} days")); ?></td>
                                    <td><?= h($patterns->week_of_year) ?></td>
                                    <td><?= h($patterns->starting_on) ?></td>
                                    <td><?= h($patterns->start_date ? date('d M Y',strtotime($patterns->start_date)) : 'not set') ?></td>
                                    <td><?= h($patterns->repeat_after) ?></td>
                                    <td><?= h($patterns->night_shift ? 'Yes' : 'No') ?></td>
                                    <td class="actions">
                                        
                                    <!-- 
                                        <?= 
                                            $this->Html->link('', [
                                                'controller' => 'Patterns', 
                                                'action' => 'view', 
                                                $patterns->id], [
                                                    'title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open'
                                                ]
                                            ) 
                                        ?>     
                                    -->
                                        
                                        <?= $this->Html->link('', [
                                            'controller' => 'Patterns', 
                                            'action' => 'edit', 
                                            $patterns->id,
                                            //get current url including page number to pass to controller
                                            'url' => $this->Paginator->generateUrl(),
                                            'employee_id' => $employee->id], [
                                                'title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']
                                            ) 
                                        ?>
                                        <!--                                        
                                        <?= 
                                            $this->Form->postLink('', [
                                                'controller' => 'Patterns', 
                                                'action' => 'delete', 
                                                $patterns->id], [
                                                    'confirm' => __('Are you sure you want to delete # {0}?', 
                                                    $patterns->id), 
                                                    'title' => __('Delete'), 
                                                    'class' => 'btn btn-default glyphicon glyphicon-trash'
                                                ]
                                            ) 
                                        ?>
                                        -->
                                    </td>
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
            
        <?php endforeach; ?>