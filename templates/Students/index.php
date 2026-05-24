<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $students
 * @var array $currentUser
 */
$this->disableAutoLayout();

// Mengira jumlah student secara dinamik untuk paparan statistik ringkas
$totalStudents = 0;
if (!empty($students)) {
    if (is_array($students)) {
        $totalStudents = count($students);
    } else {
        $totalStudents = iterator_count($students);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Registered Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- PREMIUM DARK MODE VARIABLES --- */
        :root {
            --bg-main: #0b0f19;
            --bg-surface: rgba(20, 27, 45, 0.7);
            --border-color: rgba(255, 255, 255, 0.06);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            
            --primary: #3b82f6;
            --primary-glow: rgba(59, 130, 246, 0.3);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.2);
            --purple: #8b5cf6;
            --purple-glow: rgba(139, 92, 246, 0.25);
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        body { 
            min-height: 100vh; 
            background: radial-gradient(circle at 50% 0%, #1e2640 0%, var(--bg-main) 70%);
            color: var(--text-main); 
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* --- STICKY GLASS NAVBAR --- */
        .navbar { 
            background: rgba(11, 15, 25, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 18px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            border-bottom: 1px solid var(--border-color);
        }
        .nav-brand { 
            color: white; 
            font-size: 22px; 
            font-weight: 800; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #fff 0%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-brand i { -webkit-text-fill-color: var(--primary); }
        
        .nav-links { display: flex; gap: 12px; list-style: none; align-items: center; }
        .nav-item a { 
            color: var(--text-muted); 
            text-decoration: none; 
            padding: 10px 20px; 
            border-radius: 12px; 
            font-size: 14px; 
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .nav-item a:hover { color: white; background: rgba(255, 255, 255, 0.05); }
        .nav-item.active a { color: white; background: var(--primary); box-shadow: 0 0 20px var(--primary-glow); font-weight: 600; }

        .btn-logout { 
            background: rgba(239, 68, 68, 0.1); 
            color: var(--danger) !important; 
            padding: 10px 20px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 14px;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.2s; 
        }
        .btn-logout:hover { background: var(--danger) !important; color: white !important; box-shadow: 0 0 15px rgba(239, 68, 68, 0.4); }

        /* --- MAIN LAYOUT CONTAINER --- */
        .main-container { width: 100%; max-width: 1280px; margin: 40px auto; padding: 0 24px; flex: 1; }
        
        /* 📊 KAD STATISTIK ATAS JADUAL */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: var(--bg-surface);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 0 15px var(--primary-glow);
        }
        .stat-icon.success-type {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            box-shadow: 0 0 15px var(--success-glow);
        }
        .stat-info h4 { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info p { font-size: 22px; font-weight: 800; color: white; margin-top: 2px; }

        /* --- CORE GLASS DASHBOARD CARD --- */
        .dashboard-card { 
            background: var(--bg-surface); 
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: clamp(20px, 4vw, 40px); 
            border-radius: 24px; 
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        /* HEADER KAD JADUAL */
        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color); 
            padding-bottom: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card-header-flex h2 { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }

        /* --- PREMIUM RESPONSIVE TABLE --- */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: rgba(11, 15, 25, 0.4);
        }
        table { width: 100%; border-collapse: collapse; font-size: 14px; text-align: left; }
        
        th { 
            background: rgba(20, 27, 45, 0.9); 
            color: white; 
            padding: 18px; 
            font-weight: 700; 
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--border-color); 
            white-space: nowrap;
        }
        
        td { padding: 16px 18px; border-bottom: 1px solid var(--border-color); color: var(--text-main); font-weight: 500; white-space: nowrap; }
        tr:last-child td { border-bottom: none; }
        
        tr:hover td { 
            background: rgba(255, 255, 255, 0.02); 
            color: white;
            transition: background 0.2s ease;
        }
        
        .badge-sem { 
            background: rgba(139, 92, 246, 0.15); 
            color: #c084fc; 
            padding: 5px 12px; 
            border-radius: 8px; 
            font-weight: 700; 
            font-size: 12px; 
            border: 1px solid rgba(139, 92, 246, 0.3);
            display: inline-block;
            box-shadow: 0 0 10px var(--purple-glow);
        }

        /* --- 🌟 PREMIUM GLASS FOOTER --- */
        .system-footer {
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            padding: 20px 40px;
            margin-top: 60px;
        }
        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 15px;
        }
        .footer-left { display: flex; align-items: center; gap: 8px; }
        .footer-left i { color: var(--primary); }
        .footer-links { display: flex; gap: 20px; list-style: none; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: white; }

        /* --- 📱 ULTRA RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .navbar, .system-footer { padding: 18px 24px; }
            .main-container { margin: 25px auto; }
        }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 20px; padding: 20px; }
            .nav-links { justify-content: center; width: 100%; gap: 6px; flex-wrap: wrap; }
            .nav-item a, .btn-logout { padding: 10px 14px; font-size: 13px; text-align: center; display: block; width: 100%; }
            .card-header-flex { flex-direction: column; align-items: flex-start; gap: 10px; }
            .footer-content { flex-direction: column; text-align: center; }
        }
        
        @media (max-width: 480px) {
            .navbar { padding: 15px 12px; }
            .nav-links { display: grid; grid-template-columns: repeat(2, 1fr); gap: 6px; }
            .nav-item.logout-list { grid-column: span 2; margin-top: 4px; }
            .dashboard-card { border-radius: 18px; padding: 18px; }
            th, td { padding: 14px 12px; font-size: 13px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-brand">
            <i class="fa-solid fa-graduation-cap"></i> NEXUS PORTAL
        </a>
        <ul class="nav-links">
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Dashboard</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>">Students</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>">Subjects</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>"><i class="fa-solid fa-user"></i> Profile</a></li>

            <li class="nav-item logout-list">
                <?= $this->Html->link('<i class="fa-solid fa-right-from-bracket"></i> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn-logout']) ?>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-info">
                    <h4>Total Students</h4>
                    <p><?= $totalStudents ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon success-type">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-info">
                    <h4>System Status</h4>
                    <p style="color: var(--success); font-size: 16px; font-weight: 700; text-transform: uppercase; margin-top: 6px;">Active</p>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header-flex">
                <h2><i class="fa-solid fa-user-graduate"></i> Registered Students List</h2>
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
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $row): ?>
                            <tr>
                                <td style="color: var(--text-muted); font-size: 13px;">#<?= h($row->id) ?></td>
                                <td style="font-weight: 700; color: white;"><?= h($row->name) ?></td>
                                <td style="color: var(--text-muted);"><?= h($row->email) ?></td>
                                <td style="font-weight: 600; color: #60a5fa;"><?= h($row->student_id ?? '-') ?></td>
                                <td style="color: var(--text-main); letter-spacing: 0.3px;"><?= h($row->ic_number ?? '-') ?></td>
                                <td><?= h($row->phone_number ?? $row->phone ?? '-') ?></td>
                                <td><?= h($row->faculty ?? '-') ?></td>
                                <td style="color: var(--text-muted); max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?= h($row->course ?? '-') ?>">
                                    <?= h($row->course ?? '-') ?>
                                </td>
                                <td>
                                    <?php if (!empty($row->semester)): ?>
                                        <span class="badge-sem">Sem <?= h($row->semester) ?></span>
                                    <?php else: ?>
                                        <span style="color: var(--text-muted);">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 50px; color: var(--text-muted); font-weight: 400;">
                                    <i class="fa-solid fa-folder-open" style="font-size: 30px; display: block; margin-bottom: 10px; color: rgba(255,255,255,0.1);"></i>
                                    No student records found in the system.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="system-footer">
        <div class="footer-content">
            <div class="footer-left">
                <i class="fa-solid fa-shield-halved"></i>
                <span>&copy; <?= date('Y') ?> <strong>Nexus Student Portal</strong>. All Rights Reserved.</span>
            </div>
            <div>
                <ul class="footer-links">
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Dashboard</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>