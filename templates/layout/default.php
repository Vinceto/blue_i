<?php
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
        <?php if ($this->request->getSession()->read('Auth.username') 
                && $this->request->getSession()->read('Auth.role_name') !== null
                && $this->request->getSession()->read('Auth.status_name') !== null): ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Users</a>
                <a href="<?= $this->Url->build(['controller' => 'Roles', 'action' => 'index']) ?>">Roles</a>
                <a href="<?= $this->Url->build(['controller' => 'Statuses', 'action' => 'index']) ?>">Statuses</a>
                <a target="_blank" rel="noopener" href="https://book.cakephp.org/5/">Documentation</a>
                <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
                <span>Welcome, <?= $this->request->getSession()->read('Auth.username'); ?></span>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Logout</a>
            <?php else: ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">Register</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <!-- <?php debug($this->request->getSession()->read('Auth')); ?>
            <?php debug($this->request->getSession()->read('Auth.username')); ?>
            <?php debug($this->request->getSession()->read('Auth.role_name'));?>
            <?php debug($this->request->getSession()->read('Auth.status_name'));?> -->
            
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>