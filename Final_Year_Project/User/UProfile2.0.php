<?php
    include("../include/connect.php");
    session_start(); // Start session to access user data
    extract($_POST);
    if(!isset($_SESSION['user_data'])) {
        // Redirect to login if user data is not set
        header("Location: ../User/ULogin.php");
        exit();
    }

    //For update--> $_SESSION['user_data']['First_Name'] = $f_name;
    // Retrieve user data from session
    $user_data = $_SESSION['user_data'];
    $id = htmlspecialchars($user_data['User_ID']); //user id
    $fname = htmlspecialchars($user_data['First_Name']);
    $lname = htmlspecialchars($user_data['Last_Name']);
    $email = htmlspecialchars($user_data['E_Maial']);
    $pass1 = htmlspecialchars($user_data['Password']);
    $mob = htmlspecialchars($user_data['Mobile_No']);

    if (isset($_POST["remove_item"])) {
        $cart_id = $_POST['remove_item'];
        $remove_query = "DELETE FROM cart WHERE Cart_ID = $cart_id AND User_ID = $id"; // Use $id instead of $user_id
        $remove_result = mysqli_query($conn, $remove_query);

        if ($remove_result) {
            echo "<script>alert('Item removed from cart');</script>";
        } else {
            echo "<script>alert('Failed to remove item');</script>";
        }
    }


    if (isset($_POST["order_now"])) {
        // Fetch cart data for the user
        $user_id = $user_data['User_ID'];
        $cart_query = "SELECT * FROM cart WHERE User_ID = $user_id";
        $cart_result = mysqli_query($conn, $cart_query);

        // Insert each cart item into the orders table
        /*while ($cart_item = mysqli_fetch_assoc($cart_result)) {
            $prod_id = $cart_item['Prod_ID'];
            $quantity = $cart_item['Quantity'];
            $order_status = 'Pending'; // Default order status

            // Insert into orders table
            $order_query = "INSERT INTO `orders` (`User_ID`,`Prod_ID`, `Quantity`, `Order_Status`) VALUES ($user_id, $prod_id, $quantity, '$order_status')";
            $order_result = mysqli_query($conn, $order_query);

            if (!$order_result) {
                echo "<script>alert('Failed to place order');</script>";
                break;
            }else{
                echo "<script>alert('Place order');</script>";
            }
        }*/

        // Clear the cart after placing the order
        $clear_cart_query = "DELETE FROM cart WHERE User_ID = $user_id";
        $clear_cart_result = mysqli_query($conn, $clear_cart_query);

        if ($clear_cart_result) {
            echo "<script>alert('Order placed successfully!');</script>";
        } else {
            echo "<script>alert('Failed to clear cart');</script>";
        }
    }

   

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
    function redirectToPayment() {
        // Redirect to the payment page
        window.location = "../Payments.php";
    }
</script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #2a2a8e;
        }

        .header button {
            background: none;
            border: none;
            color: #2a2a8e;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .container {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            color: white;
            padding-top: 20px;
        }

        .sidebar button {
            display: block;
            width: 100%;
            background: none;
            border: none;
            color: white;
            padding: 15px;
            text-decoration: none;
            margin-bottom: 10px;
            text-align: left;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #575757;
        }

        .sidebar .active {
            background-color: #007bff;
        }

        .profile-container {
            flex: 1;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px;
            max-width: 1200px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            margin: 0;
            color: #333;
        }

        .profile-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .profile-details th,
        .profile-details td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .profile-details th {
            background-color: #f9f9f9;
            color: #555;
        }

        .btn {
            height: 50px;
            width: 100px;
            font-size: 16px;
            Background-color: #2a2a8e;
            color: white;
            border-radius: 20px;
            border: none;

        }
        .btn a{
            color: white;
            text-decoration: none;
        }
        .btn a:hover{
            color: #2a2a8e;
            text-decoration: none;
        }
        .btn:hover {
            height: 50px;
            width: 100px;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
            color: #2a2a8e;
        }
        .rmv_cart{
            height: 30px;
            width: 80px;
            font-size: 16px;
            Background-color: #2a2a8e;
            color: white;
            border-radius: 20px;
            border: none;
        }
        .rmv_cart:hover{
            height: 30px;
            width: 80px;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            color: #2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
        }
        .wis_rmv{
            height: 30px;
            width: 50px;
            font-size: 16px;
            Background-color: #2a2a8e;
            color: white;
            border-radius: 20px;
            border: none;
        }
        .wis_rmv:hover{
            height: 30px;
            width: 50px;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            color: #2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
        }
        .or_can{
            height: 30px;
            width: 120px;
            font-size: 16px;
            Background-color: #2a2a8e;
            color: white;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }
        .or_can:hover{
            height: 30px;
            width: 120px;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            color: #2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
        }
        .pro {
            height: 50px;
            width: 250px;
        }   
    </style>
</head>

<body>
    <div class="header">
        <h1>NextGenLaptops | User-Profile</h1>
        <a href="../index.php">Back To Portal</a>
    </div>
    <div class="container">
        <form method="POST" class="sidebar">
            <button type="submit" name="dash" <?php if(isset($_POST["dash"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-house"></i>  Dashboard</button>

            <button type="submit" name="editprofile" <?php if(isset($_POST["editprofile"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-pen-to-square"></i>   Edit Profile</button>

            <button type="submit" name="editpass" <?php if(isset($_POST["editpass"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-key"></i>   Edit Password</button>

            <button type="submit" name="order" <?php if(isset($_POST["order"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-cart-shopping"></i>   My Orders</button>

            <button type="submit" name="cart" <?php if(isset($_POST["cart"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-cart-flatbed"></i>   My Cart</button>

            <button type="submit" name="wislist" <?php if(isset($_POST["wislist"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-regular fa-heart"></i>  My Wishlist</button>

            <button type="submit" name="help" <?php if(isset($_POST["help"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-handshake"></i>  Help Center</button>

            <button type="submit" name="logout" <?php if(isset($_POST["logout"])){ echo "class='active'" ;
                }else{echo "class=''" ;}?>><i class="fa-solid fa-arrow-right-from-bracket"></i> User Logout</button>
        </form>
        <?php

          extract($_POST);
          /*if(isset($_POST["cart"]))
          {
                //echo "<script>console.log('hii')</script>";
                echo "<div class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>My Cart</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            echo "<th>Remove</th>";
                            echo "<th>Image</th>";
                            echo "<th>Product_Name</th>";
                            echo "<th>Price</th>";
                            echo "<th>Shipping Charge</th>";
                            echo "<th>Net_Price</th>";
                        echo "</tr>";

                        r
                    echo "</table>";
                echo "</div>";
          }*/
            
          if (isset($_POST["cart"])) {
            // Fetch cart data from the database for the logged-in user
            $user_id = $user_data['User_ID']; // Assuming User_ID is the primary key for the user
            $cart_query = "SELECT * FROM cart WHERE User_ID = $user_id";
            $cart_result = mysqli_query($conn, $cart_query);
            $total_rup = 0;
            echo "<div class='profile-container'>";
            echo "<div class='profile-header'>";
            echo "<h1>My Cart</h1>";
            echo "</div>";
        
            echo "<table class='profile-details'>";
            echo "<tr>";
            echo "<th>Remove</th>";
            echo "<th>Image</th>";
            echo "<th>Product Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Price</th>";
            echo "<th>Shipping Charge</th>";
            echo "<th>Net Price</th>";
            echo "</tr>";
            $n1 = mysqli_num_rows($cart_result);
           
            // Loop through the cart items and display them
            while ($cart_item = mysqli_fetch_assoc($cart_result)) {
                echo "<tr>";
                echo "<form method='POST'>";
                echo "<td><button type='submit' class='rmv_cart' name='remove_item' value='".$cart_item['Cart_ID']."'>Remove</button></td>";
                
                echo "<td><img src='../Assest/Product_Image/".htmlspecialchars($cart_item['Prod_Img'])."' alt='Product Image' width='50'></td>";
                echo "<td>".htmlspecialchars($cart_item['Prod_Name'])."</td>";
                echo "<td>".htmlspecialchars($cart_item['Quantity'])."</td>";
                echo "<td>".htmlspecialchars($cart_item['Price'])."</td>";
                //$total_rup += $cart_item['Net_Price'];
                echo "<td>".htmlspecialchars($cart_item['Shipping_Charge'])."</td>";
                //echo "<td>".htmlspecialchars($cart_item['Net_Price'])."</td>";
                $quan = htmlspecialchars($cart_item['Quantity']);
                    $net = (htmlspecialchars($cart_item['Price'])+htmlspecialchars    ($cart_item['Shipping_Charge']))*$quan;
               echo "<td>$net</td>";

                    
                    
                echo "</tr>";
                $total_rup += $net;
            }
            if($n1 <= 0){
                echo "<tr>";
                    echo "<td colspan='7'>Empty</td>";
                echo "</tr>";
            }else{
                echo "<tr>";
                echo "<td >Total: </td>";
                echo "<td colspan='6'>$total_rup</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            echo "<div style='text-align: center; margin-top: 20px;'>";
            echo "<form method='POST' action='Payments.php'>"; // Redirect to payment.php
            if($n1 > 0 ){
                echo "<button type='submit' name='order_now' class='btn'><a href='Payments.php'>Order Now</a></button>";
            }
            
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }

          else if(isset($_POST["wislist"]))
          {
                //echo "<script>console.log('hii')</script>";
                echo "<div class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>My Wishes</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            echo "<td>Images</td>";
                            echo "<td>Product info</td>";
                            echo "<td>Remove</td>";
                        echo "</tr>";
                        $user_id = $user_data['User_ID']; // Assuming User_ID is the primary key for the user
                       
                        $wish_query = "SELECT * FROM wishlist WHERE User_ID = $user_id";
                        $cart_result = mysqli_query($conn, $wish_query);

                        while($pro = mysqli_fetch_array($cart_result)){
                            $prod_id = $pro[2];
                            $s_qry = "SELECT * FROM product where Prod_ID = $prod_id";
                            $res = mysqli_query($conn,$s_qry);
                            while($row = mysqli_fetch_array($res)){
                                echo "<tr>";
                                echo "<td><img src='../Assest/Product_Image/$row[6]' height='50px' width='50px' /></td>";
                                echo "<td>$row[7]</td>";
                                echo "<form method='POST'>";
                                echo "<td><input type='submit' class='wis_rmv' name='delete' value='X' /></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        }
                       
                    echo "</table>";
                echo "</div>";
          }
          if(isset($_POST["delete"])){
            $user_id = $user_data['User_ID']; // Assuming User_ID is the primary key for the user
                       
            $wish_query = "SELECT * FROM wishlist WHERE User_ID = $user_id";
            $cart_result = mysqli_query($conn, $wish_query);

            while($pro = mysqli_fetch_array($cart_result)){
                $prod_id = $pro[2];
                $s_qry = "SELECT * FROM product where Prod_ID = $prod_id";
                $res = mysqli_query($conn,$s_qry);
            }
            echo "<script>console.log('Clikcxed');</script>";
            $clear_wish_query = "DELETE FROM wishlist WHERE Prod_ID=$prod_id";
            $clear_wish_result = mysqli_query($conn, $clear_wish_query);
            if($clear_wish_result){
                echo "<script>alert('Removed');</script>";
            }else{
                echo "<script>alert('Not Removed');</script>";
            }
    
        }
        if (isset($_POST["editpass"])) {
            echo "<form method='POST' class='profile-container'>";
                echo "<div class='profile-header'>";
                    echo "<h1>Change Password</h1>";
                echo "</div>";
        
                echo "<table class='profile-details'>";
                    echo "<tr>";
                        echo "<th>Enter Old Password</th>";
                        echo "<td><input type='text' name='oldpass'/></td>";
                    echo "</tr>";
        
                    echo "<tr>";
                        echo "<th>Enter New Password</th>";
                        echo "<td><input type='text' name='newpass'/></td>";
                    echo "</tr>";
        
                    echo "<tr>";
                        echo "<th>Enter Confirm Password</th>";
                        echo "<td><input type='text' name='conpass'/></td>";
                    echo "</tr>";
        
                    echo "<tr>";
                        echo "<td colspan='2'><input type='submit' value='Submit' name='confirm_btn' class='btn'/></td>";
                    echo "</tr>";
                echo "</table>";
            echo "</form>";
        }
        
        if (isset($_POST["confirm_btn"])) {
            error_reporting(0);
            $oldpass = $_POST['oldpass'];
            $newpass = $_POST['newpass'];
            $conpass = $_POST['conpass'];
            $id = $_SESSION['user_data']['User_ID']; // Assuming User_ID is stored in session
        
            // Decrypt the old password from database
            $qry = "SELECT `Password` FROM `user` WHERE `User_ID` = $id;";
            $result = mysqli_query($conn, $qry);
            $row = mysqli_fetch_assoc($result);
            $decrypted_oldpass = base64_decode($row['Password']);
        
            if ($oldpass != $decrypted_oldpass || $newpass == "" || $conpass == "" || $newpass != $conpass) {
                echo "<script>alert('Password not correct or fields are empty');</script>";
            } else {
                // Encrypt the new password before saving
                $encrypted_newpass = base64_encode($newpass);
                $qry = "UPDATE `user` SET `Password` = '$encrypted_newpass' WHERE `User_ID` = $id;";
                $result = mysqli_query($conn, $qry);
                if ($result) {
                    echo "<script>alert('Password Changed');</script>";
                } else {
                    echo "<script>alert('Password not Changed');</script>";
                }
            }
        }
        
          else if(isset($_POST["dash"]))
          {
                //echo "<script>console.log('hii')</script>";
                echo "<div class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>My Profile</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                           
                            echo "<th>First Name</th>";
                            echo "<td>".htmlspecialchars($user_data['First_Name'])."</td>";
                            //echo "<td>Nihal</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Last Name</th>"; 
                            echo "<td>".htmlspecialchars($user_data['Last_Name'])."</td>";
                            
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<td>".htmlspecialchars($user_data['E_Maial'])."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Mobile No</th>";
                            echo "<td>".htmlspecialchars($user_data['Mobile_No'])."</td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</div>";
          }
          else if(isset($_POST["editprofile"]))
          {
                //echo "<script>console.log('hii')</script>";
                echo "<form method='POST' class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>Edit Profile</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            echo "<th>Enter First Name</th>";
                            echo "<td><input type='text' name='f_name'/></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Last Name</th>";
                            echo "<td><input type='text' name='l_name'/></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<td><input type='text' name='e_mail'/></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Mobile No</th>";
                            echo "<td><input type='text' name='m_no'/></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td colspan='2'><input type='submit' value='Submit' name='confirm_btn' class='btn'/></td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</form>";
          }

          if(isset($_POST["confirm_btn"])){
            extract($_POST);
            if($f_name == "" || $l_name == "" || $e_mail == "" || $m_no == "" ){
                echo "<script>alert('Field requied')</script>";
            }else{
                $qry = "UPDATE user set First_Name = '$f_name' , Last_Name = '$l_name' , E_Maial = '$e_mail' , Mobile_No = '$m_no' WHERE User_ID = $id;";
                $result = mysqli_query($conn,$qry);
                if($result){
                    // Update session data
                    $_SESSION['user_data']['First_Name'] = $f_name;
                    $_SESSION['user_data']['Last_Name'] = $l_name;
                    $_SESSION['user_data']['E_Maial'] = $e_mail;
                    $_SESSION['user_data']['Mobile_No'] = $m_no;
                    echo "<script>alert('Profile updated')</script>";
                }else{
                    echo "<script>alert('Profile Not Updated')</script>";
                }
            }
          }
          /*<button type="submit" name="order" <?php if(isset($_POST["order"])){ echo "class='active'" ;
          }else{echo "class=''" ;}?>>My Orders</button>*/
          else if(isset($_POST["order"]))
          {
                
                //echo "<script>console.log('hii')</script>";
                $qry = "SELECT * from orders where User_ID = $id";
                
                $result = mysqli_query($conn,$qry);
                echo "<div class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>My Order</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            
                            echo "<th>Image</th>";
                            
                            echo "<th>Quantity</th>";
                            echo "<th>Price</th>";
                            echo "<th>Shipping Charge</th>";
                            echo "<th>Grand Total</th>";
                            echo "<th>Payment_Method</th>";
                            echo "<th>Order_Date</th>";
                            echo "<th>Status</th>";
                            echo "<th>Cancel?</th>";
                        echo "</tr>";
                       
                        while($row = mysqli_fetch_array($result))
                        {
                            $prod_id = $row[2];
                           $qry2 = "SELECT * from product where Prod_ID =  $prod_id ";
                            $result1 = mysqli_query($conn,$qry2);
                            while($row1 = mysqli_fetch_array($result1)){
                               
                                echo "<tr>";
                                echo "<td><img src='../Assest/Product_Image/$row1[6]' height='50px' width='50px' /></td>";
                                echo "<td>$row[3]</td>";
                                echo "<td>$row1[4]</td>";
                                echo "<td>$row1[3]</td>";
                                echo "<td align='center'>$row1[5]</td>";
                                $pay_qry = "SELECT Method from payment where User_ID = $id";
                                $res = mysqli_query($conn,$pay_qry);

                                while($met =  mysqli_fetch_array($res)){
                                    echo "<td>$met[0]</td>";
                                    break;
                                }
                                
                                echo "<td>$row[4]</td>";
                                echo "<td>$row[5]</td>";
                                echo "<form method='POST'>";
                                    echo "<td><input type='submit' value='Cancel Order' class='or_can' name='order_cancel'></td>";
                                echo "</form>"; 
                                echo "</tr>";
                            }
                        }
  
                    echo "</table>";
                echo "</div>";
          }
         else if(isset($_POST["order_cancel"])){
            $user_id = $user_data['User_ID']; // Assuming User_ID is the primary key for the user
                       
            $wish_query = "SELECT * FROM orders WHERE User_ID = $user_id";
            $cart_result = mysqli_query($conn, $wish_query);

            while($pro = mysqli_fetch_array($cart_result)){
                $prod_id = $pro[2];
                $s_qry = "SELECT * FROM product where Prod_ID = $prod_id";
                $res = mysqli_query($conn,$s_qry);
            }
            echo "<script>console.log('Clikcxed');</script>";
            $clear_wish_query = "DELETE FROM orders WHERE Prod_ID=$prod_id";
            $clear_wish_result = mysqli_query($conn, $clear_wish_query);
            if($clear_wish_result){
                echo "<script>alert('Removed');</script>";
            }else{
                echo "<script>alert('Not Removed');</script>";
            }
         }
         
          else if(isset($_POST["help"]))
          {
                
                echo "<form method='POST' class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>Help Center</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            echo "<td>Enter Problem</td>";
                            echo "<td><input type='text' class='pro' name='pro'/></td>";
                            
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td colspan='2'> <button type='submit' name='help' class='btn'>Help</button></td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</form>";
                
          }
         
          if(isset($_POST["help"])){
            error_reporting(0);
            echo "<script>preventDefault();</script>";
                extract($_POST);
                if($pro == ""){
                    
                    echo "<script>alert('Field Requied')</script>";
                }else{
                    $qry = "insert into contact(`Name`,`E_Mail`,`Message`) VALUES('$fname','$email','$pro');"; 
                    $result = mysqli_query($conn,$qry);
                    if($result)
                    {
                        echo "<script>alert('Message sent');</script>";
                    }
                    else
                    {
                        echo "<script>alert('Message sent fail');</script>";
                    }
                }
          }
          else if(isset($_POST["logout"]))
          {
                //echo "<script>console.log('hii')</script>";
                echo "<form method='POST' class='profile-container'>";
                    echo "<div class='profile-header'>";
                        echo "<h1>Log Out</h1>";
                    echo "</div>";

                    echo "<table class='profile-details'>";
                        echo "<tr>";
                            echo "<th>First Name</th>";
                            echo "<td>".htmlspecialchars($user_data['First_Name'])."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Last Name</th>";
                            echo "<td>".htmlspecialchars($user_data['Last_Name'])."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<td>".htmlspecialchars($user_data['E_Maial'])."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<th>Mobile No</th>";
                            echo "<td>".htmlspecialchars($user_data['Mobile_No'])."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td colspan='2'><input type='submit' name='log_out' value='Log Out' class='btn'/></td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</form>";
          }
          if(isset($_POST["log_out"]))
          {
            session_destroy();
            echo "<script>window.location = '../index.php'</script>";
          }
        ?>

    </div>
</body>

</html>