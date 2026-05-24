<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $subjects
 * @var array $currentUser
 */
$this->disableAutoLayout();

// Mengira statistik subjek & kredit secara dinamik
$totalSubjects = 0;
$totalCredits = 0;

if (!empty($subjects)) {
    foreach ($subjects as $row) {
        $totalSubjects++;
        $credit = (int)($row->credit_hour ?? $row->credit_hours ?? 0);
        $totalCredits += $credit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Core Subjects</title>
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
            --success-glow: rgba(16, 185, 129, 0.3);
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
        
        /* User Profile Sync di Navbar */
        .nav-user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-right: 8px;
        }
        .nav-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 700;
        }
        .nav-username {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

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
        .main-container { width: 100%; max-width: 1240px; margin: 40px auto; padding: 0 24px; flex: 1; }
        
        /* 📊 KAD STATISTIK & CARTA MINI */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: var(--bg-surface);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 22px;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 12px;
        }
        .stat-header-flex { display: flex; align-items: center; gap: 14px; }
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 0 15px var(--primary-glow);
        }
        .stat-icon.purple-type {
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple);
            box-shadow: 0 0 15px var(--purple-glow);
        }
        .stat-info h4 { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info p { font-size: 24px; font-weight: 800; color: white; margin-top: 1px; }
        
        /* Mini Visual Representation Chart */
        .mini-chart-container { width: 100%; margin-top: 5px; }
        .mini-chart-bar { width: 100%; height: 6px; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden; }
        .mini-chart-fill { height: 100%; background: linear-gradient(90deg, var(--primary), var(--purple)); border-radius: 10px; width: 0%; transition: width 1s ease-out; }

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
        
        /* Card Header Section */
        .card-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            border-bottom: 1px solid var(--border-color); 
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        h2 { 
            color: white; 
            font-size: clamp(20px, 3vw, 26px); 
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        h2 i { color: var(--primary); }
        
        /* Glowing Register Button */
        .btn-register { 
            background: var(--success); 
            color: white; 
            text-decoration: none; 
            padding: 12px 24px; 
            border-radius: 14px; 
            font-weight: 700; 
            font-size: 14px; 
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); 
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px var(--success-glow);
        }
        .btn-register:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
            background: #059669;
        }

        /* --- PREMIUM RESPONSIVE TABLE --- */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: rgba(11, 15, 25, 0.4);
        }
        table { width: 100%; border-collapse: collapse; font-size: 15px; text-align: left; }
        
        th { 
            background: rgba(20, 27, 45, 0.9); 
            color: white; 
            padding: 18px; 
            font-weight: 700; 
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--border-color); 
        }
        
        td { padding: 18px; border-bottom: 1px solid var(--border-color); color: var(--text-main); font-weight: 500; white-space: nowrap; }
        tr:last-child td { border-bottom: none; }
        
        tr:hover td { 
            background: rgba(255, 255, 255, 0.02); 
            color: white;
            transition: background 0.2s ease;
        }
        
        /* Modernized Code Badge */
        .badge-code { 
            background: rgba(59, 130, 246, 0.1); 
            color: #93c5fd; 
            padding: 6px 14px; 
            border-radius: 8px; 
            font-weight: 700; 
            font-size: 13px; 
            border: 1px solid rgba(59, 130, 246, 0.25);
            display: inline-block;
            letter-spacing: 0.5px;
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
            max-width: 1240px;
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

        /* --- 📱 RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .navbar, .system-footer { padding: 18px 24px; }
            .main-container { margin: 25px auto; }
        }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 20px; padding: 20px; }
            .nav-links { justify-content: center; width: 100%; gap: 6px; flex-wrap: wrap; }
            .nav-item a, .btn-logout { padding: 10px 14px; font-size: 13px; text-align: center; display: block; width: 100%; }
            .nav-user-profile { display: none; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .btn-register { width: 100%; justify-content: center; padding: 14px; }
            .footer-content { flex-direction: column; text-align: center; }
        }
        
        @media (max-width: 480px) {
            .navbar { padding: 15px 12px; }
            .nav-links { display: grid; grid-template-columns: repeat(2, 1fr); gap: 6px; }
            .nav-item.logout-list { grid-column: span 2; margin-top: 4px; }
            .dashboard-card { border-radius: 18px; padding: 18px; }
            th, td { padding: 14px 10px; font-size: 14px; }
            .badge-code { font-size: 12px; padding: 4px 10px; }
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
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>">Students</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>">Subjects</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>"><i class="fa-solid fa-user"></i> Profile</a></li>
            
            <?php if (!empty($currentUser)): ?>
                <li class="nav-user-profile">
                    <div class="nav-avatar">
                        <?= strtoupper(substr(h($currentUser['name'] ?? 'U'), 0, 1)) ?>
                    </div>
                    <span class="nav-username"><?= h($currentUser['name'] ?? 'User') ?></span>
                </li>
            <?php endif; ?>

            <li class="nav-item logout-list">
                <?= $this->Html->link('<i class="fa-solid fa-right-from-bracket"></i> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn-logout']) ?>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-header-flex">
                    <div class="stat-icon">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Listed Subjects</h4>
                        <p><?= $totalSubjects ?></p>
                    </div>
                </div>
                <div class="mini-chart-container">
                    <div class="mini-chart-bar">
                        <div class="mini-chart-fill" style="width: <?= min(($totalSubjects * 10), 100) ?>%;"></div>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header-flex">
                    <div class="stat-icon purple-type">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Accumulated Credit Hours</h4>
                        <p><?= $totalCredits ?> <span style="font-size: 13px; font-weight: 500; color: var(--text-muted);">Hrs</span></p>
                    </div>
                </div>
                <div class="mini-chart-container">
                    <div class="mini-chart-bar">
                        <div class="mini-chart-fill" style="width: <?= min(($totalCredits * 4), 100) ?>%; background: linear-gradient(90deg, var(--purple), var(--danger));"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h2><i class="fa-solid fa-book-bookmark"></i> Course Curriculum & Registration</h2>
                <a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'add']) ?>" class="btn-register">
                    <i class="fa-solid fa-plus-circle"></i> Register New Subject
                </a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Subject ID</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Credit Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subjects)): ?>
                            <?php foreach ($subjects as $row): ?>
                            <tr>
                                <td style="color: var(--text-muted); font-size: 14px;">#<?= h($row->id ?? $row->subject_id) ?></td>
                                <td><span class="badge-code"><?= h($row->subject_code ?? $row->code ?? '-') ?></span></td>
                                <td style="font-weight: 700; color: white;"><?= h($row->subject_name ?? $row->name ?? '-') ?></td>
                                <td style="color: #60a5fa; font-weight: 600;"><i class="fa-regular fa-clock" style="margin-right: 5px;"></i> <?= h($row->credit_hour ?? $row->credit_hours ?? '-') ?> Credits</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 50px; color: var(--text-muted); font-weight: 400;">
                                    <i class="fa-solid fa-box-open" style="font-size: 30px; display: block; margin-bottom: 10px; color: rgba(255,255,255,0.1);"></i>
                                    No subject course records found in the database.
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