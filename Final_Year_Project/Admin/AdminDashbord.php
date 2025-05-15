<?php
    include("../include/connect.php");
    session_start(); // Start session to access user data
    extract($_POST);

   
    if(!isset($_SESSION['admin_data'])) {
        // Redirect to login if user data is not set
        header("Location: ../Admin/AdminDashbord.php");
        exit();
    }else{
        unset($_SESSION['user_data']);
    }
    if(isset($_POST["logout"])){
        session_destroy();
        echo "<script>window.location = '../index.php'</script>";
    }

    // Handle Delete Product
    if(isset($_POST["delete_product"])) {
        $product_id = $_POST["product_id"];
        $delete_qry = "DELETE FROM product WHERE Prod_ID = '$product_id'";

        $del_or = "DELETE FROM payment WHERE Prod_ID = '$product_id'";
        $del_pay_qry = mysqli_query($conn,$del_or);

        $del_or1 = "DELETE FROM orders WHERE Prod_ID = '$product_id'";
        $del_pay_qry1 = mysqli_query($conn,$del_or1);

        if(mysqli_query($conn, $delete_qry)) {
            echo "<script>alert('Product deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting product!');</script>";
        }
    }
 


    $admin_data = $_SESSION['admin_data'];
    $pass1 = htmlspecialchars($admin_data['Password']);
    $id = htmlspecialchars($admin_data['Admin_ID']);

    // Handle Change Password
    if(isset($_POST["Change_pass"])) {
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $con_pass = $_POST['con_pass'];

        if($pass1 != $old_pass || $new_pass == "" || $con_pass == "") {
            echo "<script>alert('Password not correct or fields are empty');</script>";
        } elseif ($new_pass != $con_pass) {
            echo "<script>alert('New password and confirm password do not match');</script>";
        } else {
            // Update password in plain text (not recommended for security)
            $qry = "UPDATE `admin` SET `Password` = '$new_pass' WHERE `Admin_ID` = $id";
            $result = mysqli_query($conn, $qry);
            if($result) {
                echo "<script>alert('Password Changed');</script>";
                // Update the session password
                $_SESSION['admin_data']['Password'] = $new_pass;
            } else {
                echo "<script>alert('Password not Changed');</script>";
            }
        }
    }

    // Handle Update Product
   /* if(isset($_POST["update_product"])) {
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $company_name = $_POST["company_name"];
        $shipping_charge = $_POST["shipping_charge"];
        $price = $_POST["price"];
        $total_price = $_POST["total_price"];
        $description = $_POST["description"];

        $update_qry = "UPDATE `product` SET 
            `Prod_Name` = '$product_name',
            `Com_Name` = '$company_name',
            `Shipping_Charge` = '$shipping_charge',
            `Price` = '$price',
            `Net_Price` = '$total_price',
            `Description` = '$description'
            WHERE `Prod_ID` = '$product_id'";

        if(mysqli_query($conn, $update_qry)) {
            echo "<script>alert('Product updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating product!');</script>";
        }
    }*/


    if(isset($_POST["update_product"])) {
        $product_id = $_POST["product_id"];
        // Fetch product details from the database
        $fetch_qry = "SELECT * FROM `product` WHERE `Prod_ID` = '$product_id'";
        $result = mysqli_query($conn, $fetch_qry);
        if($row = mysqli_fetch_assoc($result)) {
            // Store product details in session for pre-filling the form
            $_SESSION['update_product_data'] = $row;
        }
    }

     // Handle Delete User
     if(isset($_POST["delete_user"])) {
        $user_id = $_POST["user_id"];
        $delete_qry = "DELETE FROM `user` WHERE `User_ID` = '$user_id'";
        if(mysqli_query($conn, $delete_qry)) {
            echo "<script>alert('User deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting user!');</script>";
        }
    }

    $con_id = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AdminDashbord.css">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
        .action_btn:hover {
            height: 30px;
            width: 80px;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            color: #2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
}
    </style>
</head>
<body>
    <div class="header">
        <h1>NextGenLaptops | Admin</h1>
        <a href="../index.php">Back To Portal</a>
    </div>

    <div class="content">
        <form method="POST" class="sidebar">
            <button type="submit" name="mo"><i class="fa-solid fa-dolly"></i>   Manage Order</button>
            <button type="submit" name="mu"><i class="fa-solid fa-user-pen"></i>  Manage User</button>
            <button type="submit" name="all_pro"><i class="fa-solid fa-table-cells-large"></i>  All Product</button>
            <button type="submit" name="ip"><i class="fa-solid fa-file-import"></i>  Insert Product</button>
            <button type="submit" name="update"><i class="fa-solid fa-pen-to-square"></i>  Update Product</button>
            <button type="submit" name="con"><i class="fa-solid fa-phone"></i>  Contact Us Request</button>
            <button type="submit" name="feed"><i class="fa-solid fa-reply"></i>  Feedback</button>
            <button type="submit" name="change"><i class="fa-solid fa-key"></i>   Change Password</button>
            <button type="submit" name="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>  Log Out</button>
        </form>

        <?php
            extract($_POST);
            if(isset($_POST["all_pro"])) {
                echo "<div class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<div class='tables'>";
                            echo "<table>";
                                echo "<tr>";
                                    echo "<th>ID</th>";
                                    echo "<th>Product Name</th>";
                                    echo "<th>Company Name</th>";
                                    echo "<th>Shipping Charge</th>";
                                    echo "<th>Price</th>";
                                    echo "<th>Total Price</th>";
                                    echo "<th>Product Image</th>";
                                    echo "<th>Description</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";

                                $qry = "SELECT * FROM `product`";
                                $result = mysqli_query($conn, $qry);
                                while($row = mysqli_fetch_array($result)) {
                                    echo "<tr align='center'>";
                                        echo "<td class='bor_pro'>$row[0]</td>";
                                        echo "<td class='bor_pro'>$row[1]</td>";
                                        echo "<td class='bor_pro'>$row[2]</td>";
                                        echo "<td class='bor_pro'>$row[3]</td>";
                                        echo "<td class='bor_pro'>$row[4]</td>";
                                        echo "<td class='bor_pro'>$row[5]</td>";
                                        echo "<td class='bor_pro'><img class='admin_pro_img' src='../Assest/Product_Image/$row[6]'/></td>";
                                        echo "<td class='bor_pro'>$row[7]</td>";
                                        echo "<td class='bor_pro'>";
                                            echo "<form method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='product_id' value='$row[0]'/>";
                                                echo "<button type='submit' name='delete_product' class='action_btn'>Delete</button>";
                                            echo "</form>";
                                            echo "<form method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='product_id' value='$row[0]'/>";
                                                echo "<button type='submit' name='update_product' class='action_btn'>Update</button>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";   
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            if(isset($_POST["mo"])) {
                error_reporting(0);
                echo "<div class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<div class='tables'>";
                                       
                            echo "<table>";
                                echo "<tr>";
                                    echo "<th>Order ID</th>";
                                    echo "<th>User Name</th>";
                                    echo "<th>Product Name</th>";
                                    echo "<th>Order Date</th>";
                                    echo "<th>Status</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
            
                                // Fetch orders from the database
                                $qry = "SELECT o.Order_ID, u.First_Name, u.Last_Name, p.Prod_Name, o.Order_Date, o.Order_Status 
                                        FROM `orders` o 
                                        JOIN `user` u ON o.User_ID = u.User_ID 
                                        JOIN `product` p ON o.Prod_ID = p.Prod_ID";
                                $result = mysqli_query($conn, $qry);
                                while($row = mysqli_fetch_array($result)) {
                                         echo "<tr align='center'>";
                                        echo "<td>$row[0]</td>"; // Order ID
                                        echo "<td>$row[1] $row[2]</td>"; // User Name
                                        echo "<td>$row[3]</td>"; // Product Name
                                        echo "<td>$row[4]</td>"; // Order Date
                                        echo "<td>$row[5]</td>"; // Status
                                        echo "<td>";
                                            echo "<form method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='order_id' value='$row[0]'/>";
                                                echo "<button type='submit' name='approve_order' class='action_btn'>Approve</button>";
                                            echo "</form>";
                                            echo "<form method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='order_id' value='$row[0]'/>";
                                                echo "<button type='submit' name='reject_order' class='action_btn'>Reject</button>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            
            // Handle Approve Order
            if(isset($_POST["approve_order"])) {
                $order_id = $_POST['order_id'];
                $update_qry = "UPDATE `orders` SET `Order_Status` = 'Approved' WHERE `Order_ID` = '$order_id'";
                if(mysqli_query($conn, $update_qry)) {
                    echo "<script>alert('Order approved successfully!');</script>";
                } else {
                    echo "<script>alert('Error approving order!');</script>";
                }
            }
            
            // Handle Reject Order
            if(isset($_POST["reject_order"])) {
                $order_id = $_POST['order_id'];
                $delete_qry = "DELETE FROM `orders` WHERE `Order_ID` = '$order_id'";
                if(mysqli_query($conn, $delete_qry)) {
                    echo "<script>alert('Order rejected successfully!');</script>";
                } else {
                    echo "<script>alert('Error rejecting order!');</script>";
                }
            }

            if(isset($_POST["mu"]))
            {
                echo "<div  class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<div class='tables'>";
                            
                            echo "<table>";
                                echo "<tr>";
                                     echo "<th>User_ID</th>";
                                     echo "<th>First_Name</th>";
                                     echo "<th>Last_Name</th>";
                                     echo "<th>Email</th>";
                                     echo "<th>Mobile_No</th>";
                                     echo "<th>Action</th>";
                                echo "</tr>";

                                $qry = "SELECT * FROM `user`";
                                $result = mysqli_query($conn, $qry);
                                while($row = mysqli_fetch_array($result)) {

                                echo "<tr align='center'>";
                                    echo "<td>$row[0]</td>";
                                    echo "<td>$row[1]</td>";
                                    echo "<td>$row[2]</td>";
                                    echo "<td>$row[3]</td>";
                                    echo "<td>$row[5]</td>";
                                    echo "<td>";
                                            echo "<form method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='user_id' value='$row[0]'/>";
                                                echo "<button type='submit' name='delete_user' class='action_btn'>Delete</button>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";  
            }
            

            if(isset($_POST["ip"]))
            {
                echo "<div  class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' enctype='multipart/form-data' class='tables'>";
                            echo "<table>";
                                echo "<tr align='left'>";
                                    echo "<th colspan='2'>Insert Product</th>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Product Name</td>";
                                    echo "<td><input type='text' name='pro_name' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Copany Name</td>";
                                     echo "<td><input type='text' name='com_name' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Shippign Charge</td>";
                                    echo "<td><input type='text' name='ship_crg' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Price</td>";
                                    echo "<td><input type='text' name='pri' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Image</td>";
                                    echo "<td><input type='file' name='img'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Description</td>";
                                    echo "<td><input type='text' name='dis' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td colspan='2'><input type='submit' name='ins' class='action_btn' value='Insert'/></td>";
                                echo "</tr>";

                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
            extract($_POST);
            if(isset($_POST["ins"])){
                $name = $_FILES['img']['name'];
                $add = "../Assest/Product_Image/$name";
                $total = $pri+$ship_crg;
                if(move_uploaded_file($_FILES['img']['tmp_name'],$add)){
                    echo "<script>console.log('file uploaded');</script>";
                }else{
                    echo "<script>console.log('file not uploaded');</script>";
                }
                if($pro_name==""||$com_name==""||$ship_crg==""||$pri==""||$dis==""){
                    echo "<script>alert('Fiels Required');</script>";
                }else{

                    $qry = "INSERT INTO `product` (`Prod_Name`, `Com_Name`, `Shipping_Charge`, `Price`, `Net_Price`, `Prod_Img`, `Description`) VALUES ('$pro_name', '$com_name', '$ship_crg', '$pri', '$total', '$name', '$dis');";
                    $result = mysqli_query($conn,$qry);
                    if($result){
                        echo "<script>alert('Inserted');</script>";
                    }else{
                        echo "<script>alert('not Inserted');</script>";
                    }
                }
            }
            if(isset($_POST["update_product"]) || isset($_POST["update"])) {
                $product_data = isset($_SESSION['update_product_data']) ? $_SESSION['update_product_data'] : null;
                echo "<div class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' enctype='multipart/form-data' class='tables'>";
                            echo "<table>";
                                echo "<tr align='left'>";
                                    echo "<th colspan='2'>Update Product</th>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Product ID</td>";
                                    echo "<td><input type='text' name='id' class='input' value='" . ($product_data ? $product_data['Prod_ID'] : '') . "' readonly/></td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Product Name</td>";
                                    echo "<td><input type='text' name='pro_name' class='input' value='" . ($product_data ? $product_data['Prod_Name'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Company Name</td>";
                                    echo "<td><input type='text' name='com_name' class='input' value='" . ($product_data ? $product_data['Com_Name'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Shipping Charge</td>";
                                    echo "<td><input type='text' name='ship_crg' class='input' value='" . ($product_data ? $product_data['Shipping_Charge'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Price</td>";
                                    echo "<td><input type='text' name='pri' class='input' value='" . ($product_data ? $product_data['Price'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Image</td>";
                                    echo "<td><input type='file' name='img'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Image Name</td>";
                                    echo "<td><input type='text' name='img_name' class='input' value='" . ($product_data ? $product_data['Prod_Img'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Description</td>";
                                    echo "<td><input type='text' name='dis' class='input' value='" . ($product_data ? $product_data['Description'] : '') . "'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td colspan='2'><input type='submit' name='upd' class='action_btn' value='Update'/></td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
            //Updated Product
            if(isset($_POST["upd"])){
                //echo $dis;
                $name = $_FILES['img']['name'];
                $add = "../Assest/Product_Image/$name";
                $total = $ship_crg+$pri;
                if(move_uploaded_file($_FILES['img']['tmp_name'],$add)){
                    echo "<script>console.log('file uploaded');</script>";
                }else{
                    echo "<script>console.log('file not uploaded');</script>";
                }
                $total = $pri+$ship_crg;
                $qry = "UPDATE `product` SET `Prod_Name` = '$pro_name', `Com_Name` = '$com_name', `Shipping_Charge` = '$ship_crg', `Price` = '$pri', `Net_Price` = '$total', `Prod_Img` = '$img_name', `Description` = '$dis' WHERE `product`.`Prod_ID` = $id;";
                $result = mysqli_query($conn,$qry);
                if($result){
                    echo "<script>alert('Updated');</script>";
                }else{
                    echo "<script>alert('Not Updated');</script>";
                }
            }
            if(isset($_POST["delete_pro"]))
            {
                echo "<div  class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' class='tables'>";
                            echo "<table>";
                                echo "<tr align='left'>";
                                    echo "<th colspan='2'>Delete Product</th>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Product ID</td>";
                                    echo "<td><input type='text' nama='id_del' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                     echo "<td colspan='2'><input type='submit' nama='del' class='action_btn' value='Delete'/></td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</form>";    
                    echo "</div>";
                echo "</div>"; 
            }

            if(isset($_POST["con"]))
            {
                echo "<div  class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' class='tables'>";
                            echo "<table>";
                                echo "<tr align='center'>";
                                    echo "<th colspan='5'>Contect Detail</th>";
                                echo "</tr>";

                                echo "<tr align='center'>";
                                    echo "<th>ID</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Message</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                                $qry = "SELECT * from contact";
                                $result = mysqli_query($conn,$qry);
                                
                                while($row = mysqli_fetch_array($result)){
                                    $con_id = $row[0];
                                    echo "<tr align='center'>";
                                    echo "<td>$row[0]</td>";
                                    echo "<td>$row[1]</td>";
                                    echo "<td>$row[2]</td>";
                                    echo "<td>$row[3]</td>";
                                    echo "<form method='POST' >";
                                    echo "<input type='hidden' name='contact_id' value='$row[0]'/>"; // Hidden input for Contact ID
                                    echo "<td><button type='submit' name='con_del' class='action_btn'>Delete</button></td>";
                                echo "</form>";
                                echo "</tr>";
                                }
                                
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";

            }
            if(isset($_POST["con_del"])) {
                $contact_id = $_POST['contact_id']; // Get the Contact ID from the form
                $qry = "DELETE FROM contact WHERE Contact_ID = '$contact_id'";
                $result = mysqli_query($conn, $qry);
            
                if($result) {
                    echo "<script>alert('Contact deleted successfully!');</script>";
                } else {
                    echo "<script>alert('Error deleting contact!');</script>";
                }
            }
            if(isset($_POST["feed"]))
            {
                echo "<div  class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' class='tables'>";
                            echo "<table>";
                                echo "<tr align='center'>";
                                    echo "<th colspan='6'>Feedbacks</th>";
                                echo "</tr>";

                                echo "<tr align='center'>";
                                    echo "<th>ID</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Rating</th>";
                                    echo "<th>Message</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                                $qry = "SELECT * from feedback";
                                $result = mysqli_query($conn,$qry);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr align='center'>";
                                    echo "<td>$row[0]</td>";
                                    echo "<td>$row[1]</td>";
                                    echo "<td>$row[2]</td>";
                                    echo "<td>$row[3]</td>";
                                    echo "<td>$row[4]</td>";
                                    echo "<form method='POST'>";
                                    echo "<input type='hidden' name='feedback_id' value='$row[0]'/>"; // Hidden input for Feedback ID
                                    echo "<td><button type='submit' name='feed_del' class='action_btn'>Delete</button></td>";
                                echo "</form>";
                                echo "</tr>";
                                }
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
            if(isset($_POST["feed_del"])) {
                $feedback_id = $_POST['feedback_id']; // Get the Feedback ID from the form
                $qry = "DELETE FROM feedback WHERE Feedback_ID = '$feedback_id'";
                $result = mysqli_query($conn, $qry);
            
                if($result) {
                    echo "<script>alert('Feedback deleted successfully!');</script>";
                } else {
                    echo "<script>alert('Error deleting feedback!');</script>";
                }
            }
         
            if(isset($_POST["change"])) {
                echo "<div class='main-content'>";
                    echo "<div class='info-boxes'>";
                        echo "<form method='POST' class='tables'>";
                            echo "<table>";
                                echo "<tr align='center'>";
                                    echo "<th colspan='2'>Change Password</th>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Enter Old Password</td>";
                                    echo "<td><input type='password' name='old_pass' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Enter New Password</td>";
                                    echo "<td><input type='password' name='new_pass' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>Enter Confirm Password</td>";
                                    echo "<td><input type='password' name='con_pass' class='input'/></td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td colspan='2'><input type='submit' name='Change_pass' class='action_btn' value='Change'/></td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
      
       <!-- <div class="main-content">
            <div class="info-boxes">
                <div class="info-box requests">
                    <h3>Requests Received</h3>
                    <p>64</p>
                    <a href="#">View</a>
                </div>
                <div class="info-box assigned">
                    <h3>Total Products</h3>
                    <p>62</p>
                    <a href="#">View</a>
                </div>
                <div class="info-box technicians">
                    <h3>Feedbacks</h3>
                    <p>4</p>
                    <a href="#">View</a>
                </div>
                
            </div>
        </div>-->
    </div>
</body>
</html>