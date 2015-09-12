<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>


<!-- <?= $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') ?>
     <?= $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css') ?> -->
     <?= $this->Html->css('blog_theme.css') ?>   


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header class="home">
        <div class="row">
            <div class="header-title">
                <span><?= $this->fetch('title') ?></span>
            </div>
            <div class="header-help">
    <?php if ($this->request->session()->read('Auth.User.username')) : ?>
        <span> You are Logged in As .<?= $this->request->session()->read('Auth.User.username') ?> </span>
        <span><?= $this->Html->link(__('Log out'), ['controller' => 'Users', 'action' => 'logout']) ?></span>
    <?php endif ?>
    <?php if (!$this->request->session()->read('Auth.User.username')) : ?>
        <span><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></span>
    <?php endif ?>

            </div>
        </div>
    </header>
    <main id="container">
        <div id="content">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </main>
    <footer>
            <?= $this->element('footer') ?>
    </footer>
    <?= $this->Html->script('fonts.js') ?>
    <?= $this->Html->script('//code.jquery.com/jquery-git2.min.js') ?>    
</body>
</html>
