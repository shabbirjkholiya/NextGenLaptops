<?php
    include("../include/connect.php");
    session_start();
    extract($_POST);
    if($conn) { 
        echo "<script>console.log('Connect')</script>"; 
    }
   
    if(isset($_POST["admin"]))
    {
        echo "<script>console.log('Clicked')</script>"; 
        if($username == "" || $pass == "") {
            echo "<script>alert('Both field Required');</script>";
            echo "<script>console.log('Required')</script>"; 
        }else{
            echo "<script>console.log('hii');</script>";
            $qry = "SELECT * FROM `admin` WHERE E_Mail = '$username' and Password = '$pass';";
            $result = mysqli_query($conn,$qry);
            if(mysqli_num_rows($result) > 0){
                echo "<script>console.log('Number');</script>";
                $row = mysqli_fetch_array($result);
                $_SESSION['admin_data'] = $row;
                echo "<script>window.location = '../Admin/AdminDashbord.php';</script>";
            }else{
                echo "<script>alert('Email or Password invalid');</script>";
            }
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-blue {
            background-color: rgb(58, 58, 148);
        }
        .custom-blue:hover {
            background-color: rgb(81, 81, 229);
        }
        .custom-link {
            color: rgb(58, 58, 148);
        }
        .custom-link:hover {
            color: rgb(81, 81, 229);
        }
        .adm_lgn{
            background-color: rgb(58, 58, 148);
        }
        .adm_lgn:hover{
           background: none;
           border: 1px solid rgb(58, 58, 148);
           color: rgb(58, 58, 148);
           transition: 0.5s;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="absolute top-0 left-0 right-0">
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600 custom-link">NextGenLaptops | Admin</h1>
        <a href="../index.php" class="text-gray-700">Back To Portal</a>
        </header>
    </div>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-4 rounded-lg shadow-lg w-96">
        <div class="flex items-center justify-center mb-6">
        </div>
        <h2 class="text-2xl font-bold text-center mb-6 custom-link" >Login</h2>
        <form method="POST" id="loginForm">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input name="username" type="text" id="username" placeholder="Enter Username..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input name="pass" type="password" id="password" placeholder="Enter Password..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
           
            <input name="admin" type="submit" class="w-full custom-blue text-white py-2 rounded-lg adm_lgn" value="Login"/>
               
        </form>
    </div>
    </div>
   

    <!--<script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (!username || !password) {
                alert('Both fields are required.');
                return;
            }

            alert('Login successful!');
        });
    </script>-->
</body>
</html>
