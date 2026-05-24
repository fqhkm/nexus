<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $students
 * @var array $currentUser
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Registered Students</title>
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; background:#f4f6f9; color:#333; padding-bottom: 40px; }
        .navbar { background: #1e3a8a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .nav-brand { color: white; font-size: 20px; font-weight: bold; text-decoration: none; }
        .nav-links { display: flex; gap: 15px; list-style: none; align-items: center; }
        .nav-item a { color: rgba(255,255,255,0.75); text-decoration: none; padding: 8px 16px; border-radius: 6px; font-size: 15px; }
        .nav-item a:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-item.active a { color: white; background: #2563eb; font-weight: 600; }
        .btn-logout { background: #ef4444; color: white !important; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .main-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .history-card { background: white; padding: 35px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        h2 { color: #1e3a8a; font-size: 24px; margin-bottom: 25px; border-bottom: 2px solid #f0fdf4; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; text-align: left; }
        th { background: #f8fafc; color: #1e3a8a; padding: 15px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        td { padding: 15px; border-bottom: 1px solid #e2e8f0; color: #475569; }
        tr:hover { background: #f8fafc; }
        .badge-user { background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 6px; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="#" class="nav-brand">🎓 Student Portal</a>
        <ul class="nav-links">
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Dashboard</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'students']) ?>">Students</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Attandance', 'action' => 'index']) ?>">Attendance</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'StudentSubjects', 'action' => 'index']) ?>">Course Registration</a></li>
            <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn-logout']) ?></li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="history-card">
            <h2>Registered Students List (From Users Table)</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No / User ID</th>
                            <th>Student Name</th>
                            <th>Email Address</th>
                            <th>Status Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $row): ?>
                            <tr>
                                <td><?= h($row->id) ?></td>
                                <td style="font-weight: bold; color: #1e3a8a;"><?= h($row->name) ?></td>
                                <td><?= h($row->email) ?></td>
                                <td><span class="badge-user">Active Student</span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8; font-weight: 500;">
                                    Tiada data akaun user ditemui dalam sistem.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>