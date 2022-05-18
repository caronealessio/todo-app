<h1><?= h($memo->title) ?></h1>
<p><?= h($memo->body) ?></p>
<p>Expiration Date: <?= $memo->expiration_date->format(DATE_RFC850) ?></P> 
<p><small>Created: <?= $memo->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $memo->slug]) ?></p>