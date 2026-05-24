<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Edit Profile</title>
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
            --danger: #ef4444;
            --input-bg: rgba(11, 15, 25, 0.6);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        body { 
            min-height: 100vh; 
            background: radial-gradient(circle at 50% 0%, #1e2640 0%, var(--bg-main) 70%);
            color: var(--text-main); 
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
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
        .main-container { width: 100%; max-width: 850px; margin: 40px auto; padding: 0 24px; flex: 1; }
        
        /* --- GLASS PROFILE CARD --- */
        .profile-card { 
            background: var(--bg-surface); 
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px; 
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        /* Premium Gradient Header */
        .profile-header { 
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%); 
            padding: 40px 30px; 
            text-align: center; 
            color: white; 
            border-bottom: 1px solid var(--border-color);
            position: relative;
        }
        .profile-avatar { 
            width: 90px; 
            height: 90px; 
            background: rgba(59, 130, 246, 0.15); 
            color: var(--primary);
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 32px; 
            margin: 0 auto 16px; 
            border: 2px solid rgba(59, 130, 246, 0.4); 
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
            overflow: hidden;
        }
        .profile-header h1 { font-size: 24px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 6px; }
        .profile-header p { color: var(--text-muted); font-size: 14px; font-weight: 400; }

        .profile-body { padding: clamp(20px, 5vw, 40px); }
        
        /* Form Section Title */
        .section-title { 
            font-size: 14px; 
            color: var(--primary); 
            font-weight: 700; 
            margin-bottom: 24px; 
            padding-bottom: 8px; 
            border-bottom: 1px solid var(--border-color); 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* --- DARK SYSTEM FORM INPUTS --- */
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 35px; }
        
        .input-group { display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-size: 13px; color: var(--text-muted); font-weight: 600; }
        
        /* Customizing CakePHP generated inputs */
        .input-group input, .input-group select { 
            width: 100%;
            padding: 12px 16px; 
            border: 1px solid var(--border-color); 
            border-radius: 12px; 
            font-size: 14px; 
            color: white; 
            background: var(--input-bg); 
            transition: all 0.2s ease; 
        }
        .input-group input:focus, .input-group select:focus { 
            outline: none; 
            border-color: var(--primary); 
            box-shadow: 0 0 15px var(--primary-glow);
            background: rgba(20, 27, 45, 0.9);
        }

        /* --- ACTION CONTROLLER BUTTONS --- */
        .btn-container { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-top: 10px; 
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn-back { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            text-decoration: none; 
            background: rgba(255, 255, 255, 0.04); 
            color: var(--text-muted); 
            padding: 12px 24px; 
            border-radius: 14px; 
            font-weight: 600; 
            font-size: 14px; 
            border: 1px solid var(--border-color);
            transition: all 0.2s; 
        }
        .btn-back:hover { background: rgba(255, 255, 255, 0.08); color: white; border-color: rgba(255,255,255,0.2); }
        
        .btn-submit { 
            background: var(--success); 
            color: white; 
            border: none; 
            padding: 12px 28px; 
            border-radius: 14px; 
            font-weight: 700; 
            font-size: 14px; 
            cursor: pointer; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .btn-submit:hover { 
            background: #059669; 
            transform: translateY(-2px);
            box-shadow: 0 0 20px var(--success-glow);
        }

        /* --- PREMIUM GLASS FOOTER CSS --- */
        .main-footer {
            width: 100%;
            background: rgba(11, 15, 25, 0.4);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-top: 1px solid var(--border-color);
            padding: 24px 0;
            position: relative;
            margin-top: 40px;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-left p { font-size: 13px; color: var(--text-muted); font-weight: 400; }
        .footer-left .brand-text {
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .footer-center .system-status {
            font-size: 12px;
            font-weight: 600;
            color: var(--success);
            background: rgba(16, 185, 129, 0.08);
            padding: 6px 14px;
            border-radius: 30px;
            border: 1px solid rgba(16, 185, 129, 0.15);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.05);
        }
        .footer-right .footer-links { display: flex; gap: 20px; }
        .footer-right .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }
        .footer-right .footer-links a:hover { color: var(--primary); }

        /* --- 📱 RESPONSIVE CONTROLS --- */
        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 20px; padding: 20px; }
            .nav-links { justify-content: center; width: 100%; gap: 6px; flex-wrap: wrap; }
            .nav-item a, .btn-logout { padding: 10px 14px; font-size: 13px; text-align: center; display: block; width: 100%; }
            .form-grid { grid-template-columns: 1fr; gap: 18px; }
            .btn-container { flex-direction: column-reverse; width: 100%; }
            .btn-back, .btn-submit { width: 100%; justify-content: center; padding: 14px; }
            
            /* Responsive Footer */
            .main-footer { padding: 30px 0; }
            .footer-content { flex-direction: column; text-align: center; gap: 20px; padding: 0 24px; }
            .footer-right .footer-links { flex-direction: column; gap: 12px; align-items: center; }
        }
        
        @media (max-width: 480px) {
            .navbar { padding: 15px 12px; }
            .nav-links { display: grid; grid-template-columns: repeat(2, 1fr); gap: 6px; }
            .nav-item.logout-list { grid-column: span 2; margin-top: 4px; }
            .profile-card { border-radius: 18px; }
            .profile-header { padding: 30px 20px; }
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
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>">Subjects</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>"><i class="fa-solid fa-user"></i> Profile</a></li>
            <li class="nav-item logout-list">
                <?= $this->Html->link('<i class="fa-solid fa-right-from-bracket"></i> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn-logout']) ?>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php if (!empty($user->profile_image)): ?>
                        <img src="<?= $this->Url->webroot('img/profiles/' . $user->profile_image) ?>" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    <?php else: ?>
                        <i class="fa-solid fa-user-gear"></i>
                    <?php endif; ?>
                </div>
                <h1>Update Profile Information</h1>
                <p>Keep your account settings and academic profile credentials up to date.</p>
            </div>
            
            <div class="profile-body">
                <?= $this->Form->create($user, ['type' => 'file']) ?>
                
                <div class="section-title"><i class="fa-solid fa-image"></i> Profile Display Picture</div>
                <div class="form-grid">
                    <div class="input-group" style="grid-column: span 2;">
                        <label>Upload New Photo (JPEG/PNG)</label>
                        <?= $this->Form->control('upload_image', ['label' => false, 'type' => 'file', 'accept' => 'image/*']) ?>
                    </div>
                </div>

                <div class="section-title"><i class="fa-solid fa-address-book"></i> Account & Contact Information</div>
                <div class="form-grid">
                    <div class="input-group">
                        <label>Full Name</label>
                        <?= $this->Form->control('name', ['label' => false, 'required' => true]) ?>
                    </div>
                    <div class="input-group">
                        <label>Email Address</label>
                        <?= $this->Form->control('email', ['label' => false, 'required' => true]) ?>
                    </div>
                    <div class="input-group">
                        <label>Phone Number</label>
                        <?= $this->Form->control('phone', ['label' => false]) ?>
                    </div>
                    <div class="input-group">
                        <label>Identity Card Number</label>
                        <?= $this->Form->control('ic_number', ['label' => false]) ?>
                    </div>
                </div>

                <div class="section-title"><i class="fa-solid fa-graduation-cap"></i> Academic / Organization Information</div>
                <div class="form-grid">
                    <div class="input-group">
                        <label>Faculty</label>
                        <?= $this->Form->control('faculty', ['label' => false]) ?>
                    </div>
                    <div class="input-group">
                        <label>Course / Program</label>
                        <?= $this->Form->control('course', ['label' => false]) ?>
                    </div>
                    <div class="input-group">
                        <label>Semester</label>
                        <?= $this->Form->control('semester', ['label' => false, 'type' => 'number']) ?>
                    </div>
                    <div class="input-group">
                        <label>Student ID / Matric Number</label>
                        <?= $this->Form->control('student_id', ['label' => false, 'type' => 'text']) ?>
                    </div>
                </div>

                <div class="btn-container">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i> Save Changes
                    </button>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-left">
                <p>&copy; <?= date('Y') ?> <span class="brand-text">Nexus Portal</span>. All rights reserved.</p>
            </div>
            <div class="footer-center">
                <span class="system-status"><i class="fa-solid fa-circle-check"></i> System Operational</span>
            </div>
            <div class="footer-right">
                <div class="footer-links">
                    <a href="#"><i class="fa-solid fa-shield-halved"></i> Privacy Policy</a>
                    <a href="#"><i class="fa-solid fa-circle-info"></i> Support Helpdesk</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>