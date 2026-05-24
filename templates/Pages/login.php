<?php
session_start();

$error = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == "student@gmail.com" && $password == "12345")
    {
        $_SESSION['student'] = $email;
        header("Location: dashboard.php");
    }
    else
    {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
            overflow:hidden;
        }

        .login-box{
            width:400px;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(15px);
            border-radius:25px;
            padding:40px;
            box-shadow:0 10px 40px rgba(0,0,0,0.3);
            border:1px solid rgba(255,255,255,0.2);
            color:white;
        }

        .icon{
            text-align:center;
            font-size:60px;
            margin-bottom:10px;
        }

        h1{
            text-align:center;
            margin-bottom:10px;
        }

        p{
            text-align:center;
            margin-bottom:25px;
            opacity:0.8;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            display:block;
            margin-bottom:8px;
        }

        .input-group input{
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            outline:none;
        }

        .btn{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:white;
            color:#1e3a8a;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-3px);
        }

        .error{
            background:#ef4444;
            padding:10px;
            border-radius:10px;
            margin-bottom:15px;
            text-align:center;
        }

        .signup{
            text-align:center;
            margin-top:20px;
        }

        .signup a{
            color:white;
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>

<body>

    <div class="login-box">

        <div class="icon">🎓</div>

        <h1>Student Login</h1>

        <p>Welcome back to your portal</p>

        <?php
        if($error != "")
        {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="POST">

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login" class="btn">
                Log In
            </button>

        </form>

        

    </div>

</body>
</html>