<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="articles form large-10 medium-9 columns">
    <?= $this->Form->create($article, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('category');
            echo $this->Form->input('lead',
                array('label' => 'Resume' )
            );
            echo $this->Form->input('body');
            echo $this->Form->input('photo', ['type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
