<?php
//use Cake\Routing\Router;
$this->extend('../Layout/TwitterBootstrap/calendarpublic');
?>

<?php foreach ($employees as $employee): ?>

    <div class="row"> 
        <div class="col-sm-12">
        
            <div class="panel panel-default">
                <div class="panel-heading">  
                    <button type="button" class="btn btn-success btn-sm" id="patternRefresh">Refresh Calendar</button> 
                    <!--<button type="button" class="btn btn-success btn-sm" id="viewfiteredevents">Filter Events</button> -->
                    
                    <?php
                    
                        echo $this->Html->link('Show Filtered Events',
                            array('controller' => 'Employees', 'action' => 'view', 22),
                            array(
                                'class' => 'btn btn-success btn-sm btn-space', 
                                'id' => 'viewfilteredevents'
                            )
                        );
                        
                    ?>
                                                                         
                </div>
                <div class="panel-body">
                    <div id='patternevent', data-id='showAll'></div>
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>
            
<?php endforeach; ?>