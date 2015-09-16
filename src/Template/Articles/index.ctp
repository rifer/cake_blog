<?= $this->element('search') ?>
<section class="grid">
    <div class="grid-sizer"></div>
<!--     <?php foreach ($articles as $category): ?>
        <span><?= h($category->category) ?></span>
    <?php endforeach;?> -->

    <h1><cake:out value="Hello World" /></h1>
    
        <?php $featuredArticle = $articles->first(); ?>
         <article class="grid-item grid-item--width2">
            <h2><?= $this->Html->link(h($featuredArticle->title),['action' => 'view', $featuredArticle->id])  ?></h2>

            <h2><cake:link url="['action' => 'view']" value="%{featuredArticle.title}" /></h2>
            
            <p class="date"><?= __('At') ?> <?= h($featuredArticle->modified) ?> <?= __('by') ?> <?= h($featuredArticle->author) ?></p>        
            <?php if ($this->request->session()->read('Auth.User.id')) : ?>
                <span class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $featuredArticle->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $featuredArticle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $featuredArticle->id)]) ?>
                </span>
            <?php endif ?>
            <?php if(h($featuredArticle->photo)): ?>
                <figure class="featured">
                    <?= $this->Html->image('../files/articles/photo/' . $featuredArticle->get('photo_dir') . '/featured_' . $featuredArticle->get('photo'), array('alt' => h($featuredArticle->title))) ?>
                </figure>
            <?php endif ?>
            <p class="lead"><?= h($featuredArticle->lead) ?></p>
            <?php if (h($featuredArticle->category)): ?> 
                <p class="tags"><span><?= h($featuredArticle->category) ?></span></p>
            <?php endif ?>
            <p class="read-more"><?= $this->Html->link(__('Read more'), ['action' => 'view', $featuredArticle->id]) ?></p>
        </article>


    <php:foreach var="articles" value="article">
        <cake:out value="%{article.title}" />
    </php:foreach>
    

    <?php foreach ($articles as $article): ?>
        <?php if ($article != $featuredArticle): ?>
        <article class="grid-item">
            <h2><?= $this->Html->link(h($article->title),['action' => 'view', $article->id])  ?></h2>
            <p class="date"><?= __('At') ?> <?= h($article->modified) ?> <?= __('by') ?> <?= h($article->author) ?></p>        
            <?php if ($this->request->session()->read('Auth.User.id')) : ?>
                <span class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                </span>
            <?php endif ?>
            <?php if(h($article->photo)): ?>
                <figure class="general">
                    <?= $this->Html->image('../files/articles/photo/' . $article->get('photo_dir') . '/long_' . $article->get('photo'), array('alt' => h($article->title))) ?>
                </figure>
            <?php endif ?>
            <p class="lead"><?= h($article->lead) ?></p>
            <?php if (h($article->category)): ?> 
                <p class="tags"><span><?= h($article->category) ?></span></p>
            <?php endif ?>
            <p class="read-more"><?= $this->Html->link(__('Read more'), ['action' => 'view', $article->id]) ?></p>
        </article>
        <?php endif ?>
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
            <?= $this->Paginator->numbers(['first' => 2, 'last' => 2]) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
<aside class="actions columns large-3 small-12">
    <?php if ($this->request->session()->read('Auth.User.id')) : ?>
        <h3><?= __('Actions') ?></h3>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
        </ul>
    <?php endif ?>
    <h3>HI</h3>
    <p class="intro">Interestingly no JSLint loader seems to exist for Webpack yet. Fortunately, there's one for JSHint. On a legacy project setting it up with Webpack is easy. You will need to install jshint-loader to your project (npm i jshint-loader --save-dev). In addition, you will need a little bit of configuration.</p>
    <ul class="contact">
        <li><a href="#"><i class="fa fa-twitter"></i> @rifertwit</a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i> @riferface</a></li>
        <li><a href="#"><i class="fa fa-github"></i> @rifer</a></li>
    </ul>
</aside>