<?php 
include("../include/connect.php");
session_start();

if($conn) { 
    echo "<script>console.log('Connect');</script>"; 
}

if(isset($_GET["login"])) {
    $email = $_GET['email'];
    $pass = $_GET['pass'];

    if($email == "" || $pass == "") {
        echo "<script>alert('Please enter both fields');</script>";
    } else {
        $qry = "SELECT * FROM user WHERE E_Maial = '$email'";
        $result = mysqli_query($conn, $qry);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            $decryptedPassword = base64_decode($row['Password']); // Decrypt password

            if ($pass === $decryptedPassword) { // Compare decrypted password
                $_SESSION['user_data'] = $row; // Store user data in session
                echo "<script>window.location = '../User/UProfile2.0.php';</script>";
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email');</script>";
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
        .custom-blue:hover {
            background: none;
            border: 2px solid rgb(58, 58, 148);
            color: rgb(58, 58, 148);
            font-size: 18px;
        }
        .custom-blue {
            background-color: rgb(58, 58, 148);
            color: white;
            transition: 1s;
            font-size: 18px;
        }
        .custom-link {
            color: rgb(58, 58, 148);
        }
        .custom-link:hover {
            color: rgb(81, 81, 229);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="absolute top-0 left-0 right-0">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="custom-link text-2xl font-bold text-600">NextGenLaptops | User</h1>
            <div class="absolute top-0 right-0 m-4">
                <a href="../index.php" class="text 1xl font-bold text-gray-600">Back To Portal</a>
            </div>
        </header>
    </div>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-4 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold text-center mb-6 custom-link">Login</h2>
            <form method="GET" id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Username</label>
                    <input name="email" type="text" id="username" placeholder="Enter Username..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input name="pass" type="password" id="password" placeholder="Enter Password..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
              
                <input type="submit" name="login" class="w-full custom-blue text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Login"/>
                <div class="flex items-center justify-center mt-6">
                    <span class="text-gray-500">OR</span>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <a href="../User/USignup.php" class="custom-link custom-link:hover">SIGN UP......</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
