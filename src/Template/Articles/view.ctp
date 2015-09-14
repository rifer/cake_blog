<div class="actions columns large-2 medium-3 <?php if (!$this->request->session()->read('Auth.User.id')){echo ('hide');} ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="articles view large-10 medium-9 columns <?php if (!$this->request->session()->read('Auth.User.id')){echo ('large-12 medium-12');} ?>">
    <h2><?= h($article->title) ?></h2>
    <p class="align-right"><?= __('By') ?>  <?= h($article->author) ?> || <i><?= __('Created') ?> <?= h($article->created) ?></i></p>
    <div class="row">
        <div class="large-8 columns <?php if (!$this->request->session()->read('Auth.User.id')){echo ('large-10');} ?>">
            <p><?= h($article->lead) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9 <?php if (!$this->request->session()->read('Auth.User.id')){echo ('large-10');} ?>">
            <?= $this->Text->autoParagraph(h($article->body)) ?>
        </div>
    </div>
    <div class="row share">
        <?php
           $services = [
            'facebook' => __('Share on Facebook'),
            'gplus' => __('Share on Google+'),
            'linkedin' => __('Share on LinkedIn'),
            'twitter' => __('Share on Twitter'),
            'whatsapp' => __('Share on Whatsapp'),
            'pocket' => __('Save on Pocket')
        ];
            echo '<ul>';
            foreach ($services as $service => $linkText) {
                echo '<li>' . $this->SocialShare->fa(
                    $service,
                    $linkText
                ) . '</li>';
            }
            echo '</ul>';
        ?>
    </div>
</div>
