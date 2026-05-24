<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pelajar: <?= $this->fetch('title') ?></title>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span>Sistem</span>Pelajar</a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link('Attendance', ['controller' => 'Attendance', 'action' => 'index']) ?>
            
            <?= $this->Html->link('Profile', ['controller' => 'Students', 'action' => 'profile']) ?>
            
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
</body>
</html>