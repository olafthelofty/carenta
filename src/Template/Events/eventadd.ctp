<?= $this->Form->create($event); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Event']) ?></legend>
    <?php
           // echo $this->Form->input('title');
            //echo "";
            
            echo $this->Form->input('title');
           // echo $this->Form->input('start');
            //echo "";
            echo $this->Form->input('start'); 
            
           // echo $this->Form->input('end');
            //echo "";
            echo $this->Form->input('end'); 
            
           // echo $this->Form->input('all_day');
            //echo "";
            
            echo $this->Form->input('all_day');
           // echo $this->Form->input('created');
            //echo "";
            echo $this->Form->input('created'); 
            
           // echo $this->Form->input('modified');
            //echo "";
            echo $this->Form->input('modified'); 
            
            echo $this->Form->input('resource_id', ['options' => $resources]);
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>