<?php
/**
 * @var \App\View\AppView $this
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb); display:flex; justify-content:center; align-items:center; overflow:hidden; }
        .container{ width:100%; max-width:1000px; padding:20px; }
        .portal-box{ background:rgba(255,255,255,0.12); backdrop-filter:blur(15px); border-radius:25px; padding:50px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 10px 40px rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.2); }
        .left{ width:50%; color:white; }
        .left h1{ font-size:55px; margin-bottom:20px; }
        .left p{ font-size:18px; line-height:1.8; }
        .emoji{ font-size:70px; margin-bottom:20px; }
        .right{ width:40%; background:white; padding:40px; border-radius:20px; text-align:center; position: relative; }
        .right h2{ color:#1e3a8a; margin-bottom:30px; font-size:32px; }
        .btn{ display:block; width:100%; padding:15px; margin:15px 0; border-radius:12px; text-decoration:none; font-size:18px; font-weight:bold; transition:0.3s; }
        .login-btn{ background:#2563eb; color:white; }
        .signup-btn{ background:#0f172a; color:white; }
        .btn:hover{ transform:translateY(-3px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .footer{ margin-top:20px; color:gray; font-size:14px; }
        .floating{ position:absolute; border-radius:50%; background:rgba(255,255,255,0.1); animation:float 6s infinite ease-in-out; }
        .circle1{ width:150px; height:150px; top:10%; left:5%; }
        .circle2{ width:220px; height:220px; bottom:-60px; right:-60px; }
        @keyframes float{ 0%{transform:translateY(0px);} 50%{transform:translateY(-20px);} 100%{transform:translateY(0px);} }
        @media(max-width:768px){ .portal-box{ flex-direction:column; text-align:center; } .left, .right{ width:100%; } .left{ margin-bottom:40px; } .left h1{ font-size:40px; } }
    </style>
</head>
<body>
    <div class="floating circle1"></div>
    <div class="floating circle2"></div>

    <div class="container">
        <div class="portal-box">
            <div class="left">
                <div class="emoji">🎓</div>
                <h1>Student Portal</h1>
                <p>Welcome to the digital campus portal. Manage your academic journey, access information, and stay connected with your university system.</p>
            </div>

            <div class="right">
                <h2>Portal Access</h2>
                
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="btn login-btn">
                    Log In
                </a>

                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="btn signup-btn">
                    Sign Up
                </a>

                <div class="footer">
                    © <?= date("Y"); ?> Student Portal System
                </div>
            </div>
        </div>
    </div>
</body>
</html>