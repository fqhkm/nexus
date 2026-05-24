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
    <title>Student Portal - Sign Up</title>
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; display:flex; justify-content:center; align-items:center; background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb); padding:40px 20px; }
        .signup-box{ width:500px; background:rgba(255,255,255,0.12); backdrop-filter:blur(15px); border-radius:25px; padding:40px; box-shadow:0 10px 40px rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.2); color:white; }
        .icon{ text-align:center; font-size:50px; margin-bottom:5px; }
        h1{ text-align:center; margin-bottom:5px; font-size:28px; }
        p{ text-align:center; margin-bottom:20px; opacity:0.8; }
        .input-group{ margin-bottom:15px; }
        .input-group label{ display:block; margin-bottom:5px; font-size:14px; }
        .input-group input{ width:100%; padding:12px; border:none; border-radius:10px; outline:none; color: #333; font-size: 15px; }
        .btn{ width:100%; padding:15px; border:none; border-radius:12px; background:white; color:#1e3a8a; font-size:18px; font-weight:bold; cursor:pointer; transition:0.3s; margin-top:10px; }
        .btn:hover{ transform:translateY(-3px); }
        .login-link{ text-align:center; margin-top:20px; font-size:14px; }
        .login-link a{ color:white; text-decoration:none; font-weight:bold; }
    </style>
</head>
<body>

    <div class="signup-box">
        <div class="icon">📝</div>
        <h1>Student Sign Up</h1>
        <p>Register Your Profile into Student Database</p>

        <?= $this->Flash->render() ?>
        <?= $this->Form->create($user) ?>

            <div class="input-group">
                <label>Full Name</label>
                <?= $this->Form->control('name', ['label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Student ID / No Matrik</label>
                <?= $this->Form->control('student_id', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Email Address</label>
                <?= $this->Form->control('email', ['type' => 'email', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>IC Number</label>
                <?= $this->Form->control('ic_number', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Phone Number</label>
                <?= $this->Form->control('phone', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Faculty</label>
                <?= $this->Form->control('faculty', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Course</label>
                <?= $this->Form->control('course', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Semester</label>
                <?= $this->Form->control('semester', ['type' => 'text', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>
            <div class="input-group">
                <label>Password</label>
                <?= $this->Form->control('password', ['type' => 'password', 'label' => false, 'required' => true, 'templates' => ['inputContainer' => '{{content}}']]) ?>
            </div>

            <button type="submit" class="btn">Register Student</button>
        <?= $this->Form->end() ?>

        <div class="login-link">
            Already have an account? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Log In</a>
        </div>
    </div>

</body>
</html>