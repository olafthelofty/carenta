<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Project'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

    
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
                    <?= $this->Html->link('', ['action' => 'view', $project->id], ['title' => __('View'), 'class' => 'btn btn-info btn-sm glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $project->id], ['title' => __('Edit'), 'class' => 'btn btn-warning btn-sm glyphicon glyphicon-pencil']) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm glyphicon glyphicon-trash']) ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!--Experimental calendar code here (via an element)-->
<div class="cal1">
    <script type="text/template" id="template-calendar">

        <?php echo $this->element('Projects/template-calendar'); ?>
         
    </script>
</div>
<!--end calendar experiment-->

<div id="products">
  <h1 class="ui-widget-header">Shifts</h1>
  <div id="catalog">
    <h2><a href="#">Days</a></h2>
    <div>
      <ul>
        <li>7.30 to 5.00</li>
        <li>7.30 to 12.00</li>
        <li>2.00 to 5.00</li>
      </ul>
    </div>
    <h2><a href="#">Evenings</a></h2>
    <div>
      <ul>
        <li>5.00 TO 21.45</li>
      </ul>
    </div>
    <h2><a href="#">Nights</a></h2>
    <div>
      <ul>
        <li>21.45 to 7.30</li>
      </ul>
    </div>
  </div>
</div>
 
<div id="cart">
  <h1 class="ui-widget-header">Shopping Cart</h1>
  <div class="ui-widget-content">
    <ol>
      <li class="placeholder">Add your items here</li>
    </ol>
  </div>
</div>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>