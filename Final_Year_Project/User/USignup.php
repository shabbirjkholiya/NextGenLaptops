<?php
    include('../include/connect.php');
    $conn = mysqli_connect('localhost','root','','laptops');
    if($conn)
    {
        echo "<script>console.log('Connected');</script>";
    }
    extract($_POST);
    if(isset($_POST["signup"]))
    {   
        if($fname == "" || $lname == "" || $email == "" || $pass == "" || $mno == ""){
            echo "<script>alert('Field Required');</script>";
        }else{
            $encrypted_pass = base64_encode($pass); // Encrypting the password
            $qry = "INSERT INTO `user` (`First_Name`, `Last_Name`, `E_maial`, `Password`, `Mobile_No`) VALUES ('$fname', '$lname', '$email', '$encrypted_pass', '$mno');";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                 echo "<script>alert('Success');</script>";
             }else{
                  echo "<script>alert('Fail');</script>";
            }
        }
    }else{
        echo "<script>console.log('Not clicked');</script>";
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
        <h1 class="text-2xl font-bold text-blue-600 custom-link">NextGenLaptops | User</h1>
        <div class="absolute top-0 right-0 m-4">
        <a href="../index.php" class="text-1xl font-bold text-gray-600">Back To Portal</a>
    </div>
    </header>
    </div>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-4 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center custom-link">Sign Up</h2>
        <form  method="POST" action="" id="signupForm">
            <div class="flex mb-4">
                <div class="w-1/2 pr-2">
                    <label class="block text-gray-700">First Name</label>
                    <input name="fname" type="text" id="firstName" class="w-full px-3 py-2 border rounded" placeholder="Enter First Name">
                </div>
                <div class="w-1/2 pl-2">
                    <label class="block text-gray-700">Last Name</label>
                    <input name="lname" type="text" id="lastName" class="w-full px-3 py-2 border rounded" placeholder="Enter Last Name">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input name="email" type="email" id="email" class="w-full px-3 py-2 border rounded" placeholder="Enter Email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mobile Number</label>
                <input name="mno" type="text" id="mobileNumber" class="w-full px-3 py-2 border rounded" placeholder="Enter Mobile Number">
            </div>
            <div class="flex mb-4">
                <div class="w-1/2 pr-2">
                    <label class="block text-gray-700">Password</label>
                    <input name="pass" type="password" id="password" class="w-full px-3 py-2 border rounded" placeholder="Enter Password">
                </div>
                <div class="w-1/2 pl-2">
                    <label class="block text-gray-700">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="w-full px-3 py-2 border rounded" placeholder="Confirm Password">
                </div>
            </div>
            <button  name="signup" type="submit" class="w-full custom-blue text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Sign Up
            </button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="ULogin.php" class="text-blue-500 custom-link">Login</a></p>
    </div>

    </div>
    <script>
      /*  document.getElementById('signupForm').addEventListener('submit', function(event) {

            var firstName = document.getElementById('firstName').value;
            var lastName = document.getElementById('lastName').value;
            var email = document.getElementById('email').value;
            var mobileNumber = document.getElementById('mobileNumber').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (!firstName || !lastName || !email || !mobileNumber || !password || !confirmPassword) {
                alert('All fields are required.');
                event.preventDefault(); // Prevent form submission
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); // Prevent form submission
                return;
            }

            // You can add more client-side validation here if needed (e.g., email format, mobile number length)

        });*/
    </script>
</body>
</html>