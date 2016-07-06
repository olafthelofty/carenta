<?php

//use Cake\Routing\Router;

$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<?php //foreach ($employees as $employee): ?>

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
                            <div class="ui-widget">
                                <?php
                                        echo $this->Form->create('Employees', array(
                                            'action' => 'search'
                                            ));
                                        echo $this->Form->input(
                                            'name',
                                            array(
                                                'id' => 'Autocomplete',
                                                'placeholder' => 'Search Employees',
                                                'label' => false
                                                )); 
                                    
                                        echo $this->Form->end();
                                    ?>
                        </div>
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
                    
                    <?php
                    
                        echo $this->Html->link('Show all Events',
                            array('controller' => 'Employees', 'action' => 'viewAll', 'fred' => true),
                            array(
                                'class' => 'btn btn-success btn-sm btn-space', 
                                'id' => 'viewallevents'
                            )
                        );
                        
                    ?>
                        
                </div>
                <div class="panel-body">
                    <div id='calendar'></div>
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Panel header -->
                
                <div class="panel-heading text-right">
                    <div class="nav"><!-- clears floated buttons -->

                    <div class="btn-group pull-left">
                        <h3 class="panel-title"><?php echo 'Shift Pattern for ' . $employee->full_name; ?></h3>
                    </div>

                        <?php

                            // if (!empty($employee->patterns)){

                            //     echo $this->Html->link('Delete Shift Template',
                            //         array('controller' => 'Events', 'action' => 'deleteWeekTemplate', 'employee_id' => $employee->id),
                            //         array(
                            //             'class' => 'btn btn-danger btn-sm active btn-space'
                            //         )
                            //     ); 
                                
                            // if (!empty($employee->patterns)){$btnState = 'active';} else {$btnState = 'disabled';}

                            // echo $this->Html->link('Apply Pattern',
                            //     array('controller' => 'Events', 'action' => 'patternevent', 'employee_id' => $employee->id),
                            //     array(
                            //         'class' => 'btn btn-success btn-sm btn-space' . $btnState, 
                            //         'id' => 'patternevent',
                            //         'data-id'=> $employee->id
                            //     )
                            // ); 
                                                                    
                            // }else{ 
                        ?>
                                                        
                            <div class="form-inline pull-right">                  
                                <label for="text">Pattern Range &nbsp;</label>
                                <div class="input-group col-sm-6">                            
                                    <input type="text" title="Start date" class="form-control input-sm datepicker" id="datepickerStart_from" name="fred">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-sm btn-space" id="btnPickerStart">
                                            <span class="glyphicon glyphicon-step-backward"></span>
                                        </button>
                                    </span>
                                    
                                    <input type="text" title="End date"  class="form-control input-sm datepicker" id="datepickerEnd_until" name="jim">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-sm btn-space" id="btnPickerEnd">
                                            <span class="glyphicon glyphicon-step-forward"></span>
                                        </button>
                                    </span>
                                </div>
                                
                                <button 
                                    type="button" 
                                    class="btn btn-info btn-sm btn-space" 
                                    id="newPattern" 
                                    data-id=<?php echo $employee->id; ?>
                                    data-selecteddate = ""
                                    data-selectedstartdate = ""
                                    data-selectedenddate = ""
                                >
                                        New Pattern
                                </button>                                     

                                <!-- /input-group -->
                            </div>  
                                                
                            <?php
                           // }
                        ?> 

                    </div>
                </div>
                <div class="panel-body">
                    <?php if (!empty($employee->pattern_parents)): ?>   
                    <table id="tblindex" class="table table-hover table-bordered table-condensed table-striped table-responsive">
                        <thead>
                            <tr>
                                    <th class="col-md-1">&nbsp;</th>
                                    <th class="col-md-1"><?php echo $this->Paginator->sort('ID'); ?></th>
                                    <th class="col-md-2"><?php echo $this->Paginator->sort('Starts On'); ?></th>
                                    <th class="col-md-2"><?php echo $this->Paginator->sort('Ends On'); ?></th>
                                    <th class="col-md-2"><?php echo $this->Paginator->sort('Leave Factor'); ?></th>
                                    <th class="col-md-3 myActions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee->pattern_parents as $patternParents): ?>           

                                <tr data-toggle="collapse" data-target=<?php echo '"#collapse'.$patternParents->id.'"'; ?> class="accordion-toggle">
                                    <td style='text-align:center;vertical-align:middle'><button class="btn btn-success btn-xs"><span class="fa fa-angle-double-down fa-lg"></span></button></td>
                                    <td><?= h($patternParents->employee_id) ?></td>
                                    <td><?= h($patternParents->parent_start ? date('d M Y',strtotime($patternParents->parent_start)) : 'not set') ?></td>
                                    <td><?= h($patternParents->parent_end ? date('d M Y',strtotime($patternParents->parent_end)) : 'not set') ?></td>
                                    <td><?= h($patternParents->leave_factor) ?></td>

                                    <td class="actions myActions">
                                        

                                        
                                        <?= $this->Html->link('', [
                                            'controller' => 'PatternParents', 
                                            'action' => 'edit', 
                                            $patternParents->id,
                                            //get current url including page number to pass to controller
                                            'url' => $this->Paginator->generateUrl(),
                                            'employee_id' => $employee->id], [
                                                'title' => __('Edit'), 
                                                'class' => 'btn-space fa fa-pencil fa-lg'
                                                ]
                                            ) 
                                        ?>

                                        <?php
                                                
                                            if (!empty($employee->patterns)){$btnState = 'active';} else {$btnState = 'disabled';}

                                            if ($patternParents->patterns){
                                                echo $this->Html->link('',
                                                    array(
                                                        'controller' => 'Events', 
                                                        'action' => 'patternevent', 
                                                        'employee_id' => $employee->id, 
                                                        'patternparentid' => $patternParents->id,
                                                        'patternSun' => $patternParents->patterns[0]->id,
                                                        'patternMon' => $patternParents->patterns[1]->id,
                                                        'patternTue' => $patternParents->patterns[2]->id,
                                                        'patternWed' => $patternParents->patterns[3]->id,
                                                        'patternThu' => $patternParents->patterns[4]->id,
                                                        'patternFri' => $patternParents->patterns[5]->id,
                                                        'patternSat' => $patternParents->patterns[6]->id                                                    
                                                    ),
                                                    array(
                                                        'class' => 'iconcolor3 btn-space4x fa fa-check fa-lg', 
                                                        'title' => 'Apply',
                                                        'id' => 'patternevent',
                                                        'data-id'=> $employee->id
                                                    )
                                                ); 
                                            } else {
                                                echo $this->Html->link('', [
                                                    'controller' => 'Patterns', 
                                                    'action' => 'addWeekTemplate', 
                                                        'employee_id' => $patternParents->employee_id, 
                                                        'selectedstartdate' => date('Y-m-d',strtotime($patternParents->parent_start)), 
                                                        'selectedenddate' => date('Y-m-d',strtotime($patternParents->parent_end)),
                                                        'pattern_parent_id' => $patternParents->id
                                                    ], 
                                                    [
                                                        'title' => __('Create'), 'class' => 'iconcolor2 btn-space4x fa fa-plus-square fa-lg'
                                                    ]
                                                );
                                            }

                                            if (!empty($employee->pattern_parents)){

                                                echo $this->Html->link('',
                                                    [
                                                        'controller' => 'PatternParents', 'action' => 'delete', 'id' => $patternParents->id
                                                    ],
                                                    [
                                                        'class' => 'iconcolor4 btn-space fa fa-close fa-lg',
                                                        'title' => __('Delete'),
                                                        'confirm' => __('Are you sure you want to delete this pattern id: #{0}?',  $patternParents->id)
                                                    ]
                                                );                                            
                                                                                    
                                            }
                                        ?> 

                    <div class="btn btn-danger btn-sm pull-right">
                        Annual Leave Entitlement (days) 
                        <span 
                            class="badge al" 
                            id="annualleavesummary<?php echo $patternParents->id; ?>"
                            data-id=<?php echo $employee->id; ?>
                            data-patternparentid=<?php echo $patternParents->id; ?>>
                        </span>
                    </div>



                                    </td>               
                                </tr>
                            
                            <tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordion-body collapse" id=<?php echo '"collapse'.$patternParents->id.'"'; ?>> 
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-condensed table-striped">
                                                <tr>
                                                    <th  class="col-md-1"><?= __('Day') ?></th>
                                                    <th  class="col-md-1"><?= __('Repeat Every') ?></th>
                                                    <th  class="col-md-1"><?= __('Start On') ?></th>
                                                    <!--<th  class="col-md-1"><?= __('Start Date') ?></th>-->
                                                    <th  class="col-md-1"><?= __('Repeat After') ?></th>
                                                    <th  class="col-md-1 myAlign"><?= __('Day / Night') ?></th>
                                                    <th  class="col-md-1"><?= __('Shift') ?></th>
                                                    <th  class="col-md-1 myActions" actions"><?= __('Actions') ?></th>
                                                </tr>
                                                <?php foreach ($patternParents->patterns as $patterns): ?>   
                                                    <tr class="danger">
                                                        <td><?php echo date('l', strtotime("Saturday +{$patterns->day_of_week} days")); ?></td>
                                                        <td><?= h($patterns->week_of_year == 1 ? $patterns->week_of_year . ' week' : $patterns->week_of_year . ' weeks') ?></td>
                                                        <td><?= h('Week ' . $patterns->starting_on) ?></td>
                                                        <!--<td><?= h($patterns->start_date ? date('d M Y',strtotime($patterns->start_date)) : 'not set') ?></td>-->
                                                        <td><?= h($patterns->repeat_after == 1 ? $patterns->repeat_after . ' week' : $patterns->repeat_after . ' weeks') ?></td>
                                                        <td class="myAlign">
                                                            <?php echo $patterns->resource->night_shift ? 
                                                                '<i class="fa fa-moon-o" aria-hidden="true"></i>' : 
                                                                '<i class="fa fa-sun-o" aria-hidden="true"></i>'; 
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= 
                                                                $patterns->has('resource') ? 
                                                                $this->Html->link($patterns->resource->parent->title . ' - ' . $patterns->resource->title, 
                                                                    ['controller' => 'Resources', 'action' => 'view', $patterns->resource->id]
                                                                ) : 
                                                                '' 
                                                            ?>
                                                        </td>
                                                
                                                        <td class="actions myActions">
                                                                
                                                            <?= $this->Html->link('', [
                                                                'controller' => 'Patterns', 
                                                                'action' => 'edit', 
                                                                $patterns->id,
                                                                //get current url including page number to pass to controller
                                                                'url' => $this->Paginator->generateUrl(),
                                                                'employee_id' => $employee->id], [
                                                                    'title' => __('Edit'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-pencil']
                                                                ) 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>                         
                                            </table>   
                                                            
                                        </div>
                                    </div> 
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
    </div>
    
<?php //endforeach; ?>