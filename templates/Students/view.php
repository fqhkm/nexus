<?php
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
        body{ min-height:100vh; background:#f4f6f9; color:#333; }
        .navbar { background: #1e3a8a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .nav-brand { color: white; font-size: 20px; font-weight: bold; text-decoration: none; }
        .nav-links { display: flex; gap: 15px; list-style: none; align-items: center; }
        .nav-item a { color: rgba(255,255,255,0.75); text-decoration: none; padding: 8px 16px; border-radius: 6px; }
        .nav-item a:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-item.active a { color: white; background: #2563eb; font-weight: 600; }
        .btn-logout { background: #ef4444; color: white !important; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; }

        .dashboard-container { max-width: 1350px; margin: 40px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .header-section { margin-bottom: 25px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        h1 { color: #1e3a8a; font-size: 24px; }
        .table-responsive { overflow-x: auto; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background: #f8fafc; color: #1e3a8a; padding: 15px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        td { padding: 15px; border-bottom: 1px solid #e2e8f0; color: #4a5568; }
        tr:hover { background: #f8fafc; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="#" class="nav-brand">🎓 Student Portal</a>
        <ul class="nav-links">
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Dashboard</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>">Students</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Attendance', 'action' => 'index']) ?>">Attendance</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>">Subjects</a></li>
            <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn-logout']) ?></li>
        </ul>
    </nav>

    <div class="dashboard-container">
        <div class="header-section">
            <h1>Registered Students List</h1>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student ID</th>
                        <th>IC Number</th>
                        <th>Phone Number</th>
                        <th>Faculty</th>
                        <th>Course</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students) && count($students) > 0): ?>
                        <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td style="font-weight: bold; color: #1e3a8a;"><?= h($student->name) ?></td>
                            <td><?= h($student->email) ?></td>
                            <td><?= h($student->student_id ?? '-') ?></td>
                            <td><?= h($student->ic_number ?? '-') ?></td>
                            <td><?= h($student->phone ?? '-') ?></td>
                            <td><?= h($student->faculty ?? '-') ?></td>
                            <td><?= h($student->course ?? '-') ?></td>
                            <td>
                                <span style="background: #e0e7ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                    <?= h($student->semester ?? '-') ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 30px; color: #a0aec0;">Tiada data rekod student ditemui dalam sistem.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>