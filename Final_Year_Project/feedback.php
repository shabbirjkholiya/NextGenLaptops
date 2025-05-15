<?php
    include('include/connect.php');
    extract($_POST);
    if(isset($_POST["submit"]))
    {   
       // echo "<script>console.log('hiii');</script>";
       
        if($nm == "" || $email == ""||$rating== ""||$msg==""){
            echo "<script>alert('All Fileds Are required');</script>";
        }
        else
        {
            $qry = "INSERT INTO `feedback` (`Name`, `E_Mail`, `Rating`, `Message`) VALUES ('$nm', '$email', '$rating', '$msg');";
            $result = mysqli_query($conn,$qry);
            if($result){
                echo "<script>alert('Feedback are send');</script>";
            }else{
                echo "<script>alert('Feedback not send');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
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
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            padding: 10px; /* Adjusted Padding */
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ccc;
            font-size: 2rem;
            padding: 0 0.1rem;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }
        .star-rating input[type="radio"]:checked ~ label {
            color: #f5b301;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5b301;
        }
        .warning{
            color: red;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-700 custom-link">NextGenLaptops</h1>
        <a href="./index.php" class="text-gray-700">Back To Portal</a>
    </header>

    <!-- Feedback Form -->
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-12 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-4 custom-link">Feedback</h2>
            <form method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="nm" id="name" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Enter your name">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700">Message</label>
                    <textarea id="message" class="w-full p-2 border border-gray-300 rounded mt-1" rows="4" name="msg" placeholder="Enter your feedback"></textarea>
                    <p class="warning">Please write your message in below 50 word</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Rating</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                    </div>
                </div>
                <input type="submit" class="w-full custom-blue text-white p-2 rounded" value="Submit" name="submit"/>
            </form>
        </div>
    </div>
</body>
</html>
