<?= $this->element('search') ?>
<?php if ($this->request->session()->read('Auth.User.id')) : ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
    </ul>
</div>
<?php endif ?>

<div class="articles index large-10 medium-9 columns <?php if (!$this->request->session()->read('Auth.User.id')){echo ('large-12 medium-12');} ?>">
    <?php foreach ($articles as $article): ?>
            <h2><?= $this->Html->link(h($article->title),['action' => 'view', $article->id])  ?></h2>        
            <?php if ($this->request->session()->read('Auth.User.id')) : ?>
                <span class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                </span>
            <?php endif ?>
            <p><?= h($article->category) ?></p>
            <p><?= h($article->lead) ?></p>
            <?= $this->Html->link(__('Read more'), ['action' => 'view', $article->id]) ?>
            <p><?= __('At') ?> <?= h($article->modified) ?> <?= __('by') ?> <?= h($article->author) ?></p>
    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
