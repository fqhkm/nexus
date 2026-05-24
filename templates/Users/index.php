<?php
/**
 * @var \App\View\AppView $this
 * @var array $currentUser
 * @var int $totalStudents
 * @var \App\Model\Entity\User $fullUserData
 * @var array $facultyLabels
 * @var array $facultyCounts
 * @var array $semesterLabels
 * @var array $semesterCounts
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Premium Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            --purple-glow: rgba(139, 92, 246, 0.2);
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

        /* --- STICKY COMPACT NAVBAR --- */
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
        
        /* HAMBURGER TRIGGER BUTTON - Enhanced Mobile Touch Target */
        .nav-hamburger-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            color: white;
            font-size: 20px;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            touch-action: manipulation;
        }
        .nav-hamburger-btn:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: var(--primary);
            box-shadow: 0 0 15px var(--primary-glow);
        }

        /* --- 🍔 PREMIUM GLASS SLIDE-OUT MENU --- */
        .sidebar-drawer {
            position: fixed;
            top: 0;
            right: -100%; /* Keeps drawer off-screen safely across devices */
            width: 320px;
            height: 100vh;
            background: rgba(11, 15, 25, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid var(--border-color);
            z-index: 2000;
            padding: 30px;
            display: flex;
            flex-direction: column;
            transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            overflow-y: auto; /* Enables natural scrolling for small device screens */
        }
        .sidebar-drawer.active {
            right: 0; /* Slide in */
        }
        .drawer-close {
            align-self: flex-end;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 18px;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            touch-action: manipulation;
        }
        .drawer-close:hover { 
            color: var(--danger); 
            border-color: rgba(239, 68, 68, 0.3);
            background: rgba(239, 68, 68, 0.05);
        }

        /* User Profile Profile Card Inside Drawer */
        .drawer-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-bottom: 25px;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
        }
        .drawer-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid rgba(59, 130, 246, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary);
            overflow: hidden;
            margin-bottom: 12px;
            box-shadow: 0 0 15px var(--primary-glow);
        }
        .drawer-user-name { font-size: 15px; font-weight: 700; color: white; margin-bottom: 4px; }
        .drawer-user-status { font-size: 12px; color: var(--success); font-weight: 500; display: flex; align-items: center; gap: 6px; }

        /* Drawer Menu Items Links */
        .drawer-links { list-style: none; display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .drawer-item a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--text-muted);
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.25s;
            border: 1px solid transparent;
        }
        .drawer-item a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.05);
        }
        .drawer-item.active a {
            color: white;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-color: rgba(59, 130, 246, 0.3);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            font-weight: 600;
        }
        .drawer-item.active a i { color: var(--primary); }

        /* Logout button at bottom of drawer */
        .drawer-logout-container {
            margin-top: auto;
            padding-top: 20px;
            width: 100%;
        }
        .drawer-logout-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 15px;
            text-decoration: none;
            background: rgba(239, 68, 68, 0.08) !important;
            color: var(--danger) !important;
            border: 1px solid rgba(239, 68, 68, 0.15);
            justify-content: center;
            font-weight: 600;
            transition: all 0.25s;
        }
        .drawer-logout-btn:hover {
            background: var(--danger) !important;
            color: white !important;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.3);
        }

        /* Overlay Backdrop */
        .drawer-overlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1500;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .drawer-overlay.active { display: block; opacity: 1; }

        /* --- MAIN LAYOUT CONTAINER --- */
        .main-container { width: 100%; max-width: 1240px; margin: 40px auto; padding: 0 24px; flex: 1; }
        
        /* --- WELCOME BANNER CARD --- */
        .welcome-card { 
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%); 
            padding: clamp(30px, 5vw, 50px); 
            border-radius: 24px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.1); 
            position: relative;
            overflow: hidden;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .welcome-card::before {
            content: ''; position: absolute; top: -20%; right: -10%; width: 300px; height: 300px; 
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%); opacity: 0.4; pointer-events: none;
        }
        .welcome-card h1 { 
            font-size: clamp(24px, 4vw, 36px); 
            font-weight: 800; 
            margin-bottom: 12px; 
            letter-spacing: -1px; 
            background: linear-gradient(to right, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .welcome-card p { color: var(--text-muted); font-size: clamp(14px, 2vw, 16px); max-width: 650px; font-weight: 400; line-height: 1.6; }
        
        .user-badge { 
            display: inline-flex; align-items: center; gap: 10px; 
            background: rgba(59, 130, 246, 0.15); color: #93c5fd;
            padding: 8px 20px; border-radius: 100px; font-weight: 600; 
            font-size: 13px; margin-top: 24px;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        /* --- GLOWING STATS GRID --- */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 45px; }
        .stat-card { 
            background: var(--bg-surface); 
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 28px; 
            border-radius: 20px; 
            display: flex; 
            justify-content: space-between; align-items: center;
            border: 1px solid var(--border-color); 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover { 
            transform: translateY(-5px); 
            border-color: rgba(255,255,255,0.15);
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
        }
        
        .stat-card:nth-child(1):hover { box-shadow: 0 10px 30px rgba(59, 130, 246, 0.15); border-color: var(--primary); }
        .stat-card:nth-child(2):hover { box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15); border-color: var(--success); }
        .stat-card:nth-child(3):hover { box-shadow: 0 10px 30px rgba(139, 92, 246, 0.15); border-color: var(--purple); }

        .stat-info h3 { font-size: 13px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .stat-info .stat-number { font-size: 32px; font-weight: 800; color: white; margin-top: 8px; letter-spacing: -0.5px; }
        
        .stat-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }
        .icon-blue { background: rgba(59, 130, 246, 0.1); color: var(--primary); border: 1px solid rgba(59, 130, 246, 0.2); }
        .icon-green { background: rgba(16, 185, 129, 0.1); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); }
        .icon-purple { background: rgba(139, 92, 246, 0.1); color: var(--purple); border: 1px solid rgba(139, 92, 246, 0.2); }

        /* --- CHARTS GRID --- */
        .charts-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); 
            gap: 24px; 
            margin-bottom: 45px;
        }
        .chart-card { 
            background: var(--bg-surface); 
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px; 
            border: 1px solid var(--border-color);
            padding: 30px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
        }
        .chart-card h2 { 
            color: white; font-size: 16px; font-weight: 700; margin-bottom: 20px; 
            display: flex; align-items: center; gap: 10px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .chart-card h2 i { color: var(--primary); }
        .chart-container { position: relative; width: 100%; height: 300px; }

        /* --- SYSTEM SHORTCUTS SECTION --- */
        .actions-section { 
            background: var(--bg-surface); 
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: clamp(24px, 4vw, 35px); 
            border-radius: 24px; 
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .actions-section h2 { font-size: 18px; color: white; margin-bottom: 24px; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .actions-section h2 i { color: var(--primary); }
        
        .grid-links { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .action-btn { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            padding: 28px 20px; 
            background: rgba(255, 255, 255, 0.02); 
            border: 1px solid var(--border-color); 
            border-radius: 18px;
            text-decoration: none; 
            color: var(--text-muted); 
            font-weight: 600; 
            font-size: 15px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); 
            text-align: center; 
            gap: 14px;
        }
        .action-btn i { font-size: 28px; color: var(--primary); transition: transform 0.3s ease; }
        
        .action-btn:hover { 
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(255,255,255,0.02) 100%);
            color: white; 
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.1);
            transform: translateY(-3px);
        }
        .action-btn:hover i { transform: scale(1.15) translateY(-2px); color: white; }

        /* --- PREMIUM GLASS FOOTER --- */
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

        /* --- RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .navbar, .system-footer { padding: 18px 24px; }
            .main-container { margin: 25px auto; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 16px 20px; }
            .stats-grid { grid-template-columns: 1fr; gap: 18px; }
            .charts-grid { grid-template-columns: 1fr; }
            .grid-links { grid-template-columns: 1fr; gap: 14px; }
            .action-btn { flex-direction: row; justify-content: flex-start; padding: 20px 24px; gap: 18px; border-radius: 14px; }
            .action-btn i { font-size: 22px; }
            .action-btn:hover i { transform: scale(1.1) translateX(2px); }
            .footer-content { flex-direction: column; text-align: center; }
        }
        
        @media (max-width: 480px) {
            .navbar { padding: 14px 16px; }
            .welcome-card { border-radius: 18px; padding: 24px; }
            .user-badge { width: 100%; justify-content: center; font-size: 12px; }
            .stat-card { padding: 22px; }
            .sidebar-drawer { width: 100%; right: -100%; border-left: none; padding: 24px; } /* Drawer spans full width on extra small phones */
            .sidebar-drawer.active { right: 0; }
        }
    </style>
</head>
<body>

    <div class="drawer-overlay" id="drawerOverlay"></div>

    <nav class="navbar">
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-brand">
            <i class="fa-solid fa-graduation-cap"></i> NEXUS PORTAL
        </a>
        <button class="nav-hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <div class="sidebar-drawer" id="sidebarDrawer">
        <button class="drawer-close" id="closeBtn" aria-label="Close Navigation Menu"><i class="fa-solid fa-xmark"></i></button>
        
        <div class="drawer-profile">
            <div class="drawer-avatar">
                <?php if (!empty($currentUser['profile_image'])): ?>
                    <img src="<?= $this->Url->webroot('img/profiles/' . $currentUser['profile_image']) ?>" alt="User Img" style="width:100%; height:100%; object-fit:cover;">
                <?php else: ?>
                    <i class="fa-solid fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="drawer-user-name"><?= h($currentUser['name'] ?? 'Active User') ?></div>
            <div class="drawer-user-status"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> System Operator</div>
        </div>

        <ul class="drawer-links">
            <li class="drawer-item active">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            </li>
            <li class="drawer-item">
                <a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>"><i class="fa-solid fa-user-graduate"></i> Students List</a>
            </li>
            <li class="drawer-item">
                <a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>"><i class="fa-solid fa-book"></i> Core Subjects</a>
            </li>
            <li class="drawer-item">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>"><i class="fa-solid fa-id-card"></i> Account Profile</a>
            </li>
        </ul>
        
        <div class="drawer-logout-container">
            <?= $this->Html->link('<i class="fa-solid fa-right-from-bracket"></i> Log Out Account', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'drawer-logout-btn']) ?>
        </div>
    </div>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="welcome-card">
            <h1>Welcome to Student Portal</h1>
            <p>Monitor student progress, core curriculum subjects, and real-time class data seamlessly with an enhanced ultra-responsive user experience.</p>
            <div class="user-badge">
                <i class="fa-solid fa-circle-check"></i> Operator Status: <?= h($currentUser['name'] ?? ($fullUserData->name ?? 'Administrator')) ?>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total Enrolled</h3>
                    <div class="stat-number"><?= isset($totalStudents) ? h($totalStudents) : '8' ?></div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>System Analytics</h3>
                    <div class="stat-number">Active</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Active Courses</h3>
                    <div class="stat-number">12</div>
                </div>
                <div class="stat-icon icon-purple">
                    <i class="fa-solid fa-book-open"></i>
                </div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <h2><i class="fa-solid fa-chart-bar"></i> Total Students by Faculty</h2>
                <div class="chart-container">
                    <canvas id="facultyChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h2><i class="fa-solid fa-chart-pie"></i> Student Distribution by Semester</h2>
                <div class="chart-container">
                    <canvas id="semesterChart"></canvas>
                </div>
            </div>
        </div>

        <div class="actions-section">
            <h2><i class="fa-solid fa-bolt"></i> Core Operations Hub</h2>
            <div class="grid-links">
                <a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>" class="action-btn">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Manage Students</span>
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>" class="action-btn">
                    <i class="fa-solid fa-book"></i>
                    <span>Course Subjects</span>
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" class="action-btn">
                    <i class="fa-solid fa-id-card"></i>
                    <span>My Profile</span>
                </a>
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

    <script>
        // --- SIDEBAR DRAWER TOGGLE LOGIC ---
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebarDrawer = document.getElementById('sidebarDrawer');
        const closeBtn = document.getElementById('closeBtn');
        const drawerOverlay = document.getElementById('drawerOverlay');

        function openDrawer() {
            sidebarDrawer.classList.add('active');
            drawerOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevents background layout scroll when open
        }

        function closeDrawer() {
            sidebarDrawer.classList.remove('active');
            drawerOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Restores background scrolling
        }

        hamburgerBtn.addEventListener('click', openDrawer);
        closeBtn.addEventListener('click', closeDrawer);
        drawerOverlay.addEventListener('click', closeDrawer);

        // --- CHART JS INJECTIONS ---
        const facultyLabels = <?= json_encode($facultyLabels ?? []) ?>;
        const facultyCounts = <?= json_encode($facultyCounts ?? []) ?>;
        const semesterLabels = <?= json_encode($semesterLabels ?? []) ?>;
        const semesterCounts = <?= json_encode($semesterCounts ?? []) ?>;

        // 1. Graf Bar (Faculty)
        const ctxFaculty = document.getElementById('facultyChart').getContext('2d');
        new Chart(ctxFaculty, {
            type: 'bar',
            data: {
                labels: facultyLabels.length ? facultyLabels : ['No Data'],
                datasets: [{
                    label: 'Students',
                    data: facultyCounts.length ? facultyCounts : [0],
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
                    y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8', stepSize: 1 } }
                }
            }
        });

        // 2. Graf Pai (Semester)
        const ctxSemester = document.getElementById('semesterChart').getContext('2d');
        new Chart(ctxSemester, {
            type: 'pie',
            data: {
                labels: semesterLabels.length ? semesterLabels : ['No Data'],
                datasets: [{
                    data: semesterCounts.length ? semesterCounts : [0],
                    backgroundColor: [
                        'rgba(139, 92, 246, 0.5)', 
                        'rgba(16, 185, 129, 0.5)', 
                        'rgba(245, 158, 11, 0.5)', 
                        'rgba(239, 68, 68, 0.5)',  
                        'rgba(6, 182, 212, 0.5)'
                    ],
                    borderColor: ['#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#f1f5f9', padding: 15, font: { family: 'Plus Jakarta Sans', size: 11 } }
                    }
                }
            }
        });
    </script>
</body>
</html>