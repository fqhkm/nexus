<?php

$conn = mysqli_connect("localhost", "root", "", "sp_db");

if(!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

if(isset($_POST['signup']))
{
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $password = $_POST['password'];

    // INSERT DATA
    $sql = "INSERT INTO users(fullname, matric, email, phone, course, password)
            VALUES('$fullname','$matric','$email','$phone','$course','$password')";

    $result = mysqli_query($conn, $sql);

    // IF SUCCESS
    if($result)
    {
        header("Location: /pages/login");
        exit();
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Sign Up</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    padding:20px;
}

.signup-box{
    width:450px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:40px;
    color:white;
    box-shadow:0 10px 40px rgba(0,0,0,0.3);
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
}

.input-group{
    margin-bottom:15px;
}

.input-group label{
    display:block;
    margin-bottom:6px;
}

.input-group input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    outline:none;
}

.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:white;
    color:#1e3a8a;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{
    transform:translateY(-3px);
}

</style>

</head>

<body>

<div class="signup-box">

    <div class="icon">📝</div>

    <h1>Student Registration</h1>

    <p>Fill in your details</p>

    <form method="POST">

        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>

        <div class="input-group">
            <label>Matric Number</label>
            <input type="text" name="matric" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Phone Number</label>
            <input type="text" name="phone" required>
        </div>

        <div class="input-group">
            <label>Course</label>
            <input type="text" name="course" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="signup" class="btn">
            Sign Up
        </button>

    </form>

</div>

</body>
</html>