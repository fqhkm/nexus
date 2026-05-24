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
    <title>Student Log In Portal</title>
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; display:flex; justify-content:center; align-items:center; background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb); padding:20px; }
        .login-box{ width:420px; background:rgba(255,255,255,0.12); backdrop-filter:blur(15px); border-radius:25px; padding:40px; box-shadow:0 10px 40px rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.2); color:white; }
        .icon{ text-align:center; font-size:60px; margin-bottom:10px; }
        h1{ text-align:center; margin-bottom:10px; }
        p{ text-align:center; margin-bottom:25px; opacity:0.8; }
        .input-group{ margin-bottom:20px; }
        .input-group label{ display:block; margin-bottom:8px; }
        .input-group input{ width:100%; padding:14px; border:none; border-radius:12px; outline:none; color: #333; font-size: 16px; }
        .btn{ width:100%; padding:15px; border:none; border-radius:12px; background:white; color:#1e3a8a; font-size:18px; font-weight:bold; cursor:pointer; transition:0.3s; }
        .btn:hover{ transform:translateY(-3px); }
        .signup-link{ text-align:center; margin-top:20px; font-size:14px; }
        .signup-link a{ color:white; text-decoration:none; font-weight:bold; }
        .message { padding: 10px; border-radius: 10px; margin-bottom: 15px; text-align: center; font-weight: bold; font-size: 14px; }
        .success { background: #22c55e; color: white; }
        .error { background: #ef4444; color: white; }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="icon">🔒</div>
        <h1>Welcome Back</h1>
        <p>Log In to Your Student Portal</p>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create(null) ?>

            <div class="input-group">
                <label>Email Address</label>
                <?= $this->Form->control('email', ['type' => 'email', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>

            <div class="input-group">
                <label>Password</label>
                <?= $this->Form->control('password', ['type' => 'password', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>

            <button type="submit" class="btn">Log In Portal</button>

        <?= $this->Form->end() ?>

        <div class="signup-link">
            Don't have an account yet? 
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>">Sign Up Now</a>
        </div>
    </div>

</body>
</html>