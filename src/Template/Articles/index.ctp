<?= $this->element('search') ?>
<?php if ($this->request->session()->read('Auth.User.id')) : ?>
    <aside class="actions columns large-3 small-12">
        <h3><?= __('Actions') ?></h3>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
        </ul>
    </aside>
<?php endif ?>
<section class="grid">
    <div class="grid-sizer"></div>
<!--     <?php foreach ($articles as $category): ?>
        <span><?= h($category->category) ?></span>
    <?php endforeach;?> -->
    <?php foreach ($articles as $article): ?>
        <article class="grid-item">
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
        </article>
    <?php endforeach; ?>
</section>
<script type="text/javascript">
    $(document).ready( function() {

      $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
      });
      
    });
</script>
<div class="articles index large-8 medium-7 columns">
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
