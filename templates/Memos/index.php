<?php

use Cake\I18n\FrozenDate;

$time = FrozenDate::now()->addDays(2);
?>   
    
<h1>Memos</h1>
<?php if($logged) : ?>
    <?=$this->Html->link("Logout", ['action' => 'logout', 'controller' => 'Users']); ?>
<?php else: ?>
    <?=$this->Html->link("Login", ['action' => 'login', 'controller' => 'users']); ?>
<?php endif; ?>
<table>
    <tr>
        <th>Title</th>
        <th>Expiration Date</th>
        <?php if($logged) : ?>
        <th>Action</th>
        <?php endif; ?>
    </tr>


    <?php foreach ($memos as $memo):


        if($memo->expiration_date < $time)       
            echo '<tr style="background-color: red; color: white">';
        else
            echo '<tr>';
        ?>    
            <td>
                <?= $this->Html->link($memo->title, ['action' => 'view', $memo->slug]);                   
                    if($memo->prioritary == 1)
                        echo "*";
                ?>
            </td>
            
            <td>
                <?= $memo->expiration_date->format(DATE_RFC850) ?>
            </td>

            <?php if($logged) : ?>
            <td>
                <?= $this->Html->link('Edit', ['action' => 'edit', $memo->slug]); ?>
                <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $memo->slug],
                        ['confirm' => 'Are you sure?']); ?>             
            </td>
            <?php endif; ?>        
        <?php echo '</tr>' ?> 
    <?php endforeach; ?>
</table>

<?= $this->Html->link('Add Memo', ['action' => 'add']) ?>