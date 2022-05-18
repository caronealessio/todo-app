<h1>Edit Memo</h1>
<?php
    echo $this->Form->create($memo);

    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->control('expiration_date', ['type' => 'datetime']); 
    echo $this->Form->control('prioritary', ['type' => 'checkbox', 'hiddenField' => 'false']);
    echo $this->Form->control('public', ['type' => 'checkbox', 'hiddenField' => 'false']);
    echo $this->Form->button(__('Save Memo'));   
    echo $this->Form->end();
    echo $this->Html->link("Back", ['action' => 'index', 'controller' => 'Memos']);
?>
