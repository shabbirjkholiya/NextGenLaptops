<?php

    include("include/connect.php");
    extract($_POST);
    if(isset($_POST["submit"])){
    if($nam == "" || $email==""||$ms==""){
        echo "<script>alert('All Fileds Are required');</script>";
    }else{
        $qry = "INSERT INTO `contact` (`Name`, `E_Mail`, `Message`) VALUES ('$nam', '$email', '$ms');";
        $result = mysqli_query($conn,$qry);
        if($result){
            echo "<script>alert('Resonse sent we will contect you in 24HR');</script>";
        }else{
            echo "<script>alert('Response not send');</script>";
        }
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        .warning{
            color: red;
        }s
    </style>
</head>
<body class="bg-gray-100">
    <div class="absolute top-0 left-0 right-0">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="custom-link text-2xl font-bold text-600">NextGenLaptops | User</h1>
            <div class="absolute top-0 right-0 m-4">
                <a href="index.php" class="text 1xl font-bold text-gray-600">Back To Portal</a>
            </div>
        </header>
    </div>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-4 rounded-lg shadow-lg w-96">
            <div class="flex items-center justify-center mb-6">
            </div>
            <h2 class="text-2xl font-bold text-center mb-6 custom-link">Contact Us</h2>
            <form method="POST" id="contactForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="nam" id="name" placeholder="Enter Your Name..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Message</label>
                    <textarea id="message" name="ms" placeholder="Enter Your Message..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea> <!-- Adjusted rows -->
                    <p class="warning">Please write your message below 50 words</p>
                </div>
                <input type="submit" name="submit" class="w-full custom-blue text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </form>
        </div>
    </div>

</body>
</html>
