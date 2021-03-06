<?php
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?= Configure::read('App.title') ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right visible-xs">
                    <?= $this->fetch('tb_actions') ?>
                </ul>
                
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Projects"),array('controller'=>'projects','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Day Parts"),array('controller'=>'dayParts','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Shifts"),array('controller'=>'shifts','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Roles"),array('controller'=>'roles','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Counties"),array('controller'=>'counties','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Ethnicities"),array('controller'=>'ethnicities','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Exit Destinations"),array('controller'=>'exitDestinations','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Exit Reasons"),array('controller'=>'exitReasons','action'=>'index'), array('escape' => false))?></li>  
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Nationalities"),array('controller'=>'nationalities','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Role Groups"),array('controller'=>'roleGroups','action'=>'index'), array('escape' => false))?></li>
                            <li><?php echo $this->Html->link(__("<i class='fa fa-plus-square fa-fw'></i> Users"),array('controller'=>'users','action'=>'index'), array('escape' => false))?></li>                               
                            <li>
                                <a 
                                    href="http://carenta.somervillehouse.co.uk/docs/_build/html/index.html" 
                                    target="_blank" 
                                    alt="Docs"
                                >
                                    <i class="fa fa-external-link fa-fw"></i> 
                                    Docs
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-divider"></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="http://carenta.somervillehouse.co.uk/docs/_build/html/index.html">Help</a></li>
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
                
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
<!--
            <div class="col-sm-3 col-md-2 sidebar">
                <?= $this->fetch('tb_sidebar') ?>
            </div>
-->
            <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
<?php
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash))
        echo $this->Flash->render();
    $this->end();
}
$this->end();

$this->start('tb_body_end');
echo '</body>';
$this->end();

$this->append('content', '</div></div></div>');
echo $this->fetch('content');
