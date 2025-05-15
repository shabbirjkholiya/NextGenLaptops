<?php
    include('include/connect.php');
    extract($_POST);
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Hachi+Maru+Pop&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200&family=Playfair+Display&family=Poppins:ital,wght@0,100;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Home Page</title>

    <style>
        input[name="id"] {
            display: none;
        }

        
        footer {
     /* Dark background for contrast */
    color: white; /* Light text color */
    padding: 40px 0; /* Increased padding for better spacing */
    text-align: center; /* Center-align text */
    margin-top: 50px; /* Add some space above the footer */
    margin-right:260px;
}

.footer-container {
    display: flex;
    justify-content: center; /* Center the footer content */
    max-width: 1200px; /* Limit the width for better readability */
    margin: 0 auto; /* Center the container */
    gap: 40px; /* Space between sections */
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
  
}

.footer-section {
    flex: 1;
    min-width: 250px; /* Ensure sections don't get too narrow */
    padding: 20px;
    text-align: left; /* Align text to the left within sections */
}

.footer-title {
    font-size: 24px;
    margin-bottom: 15px;
    color:rgb(58, 58, 148); ; /* Accent color for the title */
    font-weight: bold;
}

.footer-subtitle {
    font-size: 18px;
    margin-bottom: 15px;
    color:rgb(58, 58, 148); ; /* Accent color for subtitles */
    font-weight: bold;
}

.footer-section p {
    font-size: 16px;
    color:black; /* Light gray for better readability */
    margin: 8px 0;
}

.footer-section p span {
    font-weight: bold;
    color: black; /* White for highlighted text */
}

.footer-section i {
    color:rgb(58, 58, 148); ; /* Accent color for icons */
    margin-right: 8px;
    font-size: 18px;
}
     
    </style>

</head>

<body>
    <header>
        <div class="menubar">
            <div class="genrel">
                <p><i class="fa-regular fa-circle-user"></i></p>
                <a href="User/UProfile2.0.php" id="myacc">My Account</a>
            </div>
            <div class="line"></div>
           
          
            <div class="genrel">
                <p><i class="fa-solid fa-arrow-right-to-bracket"></i></p>
                <p id="login"><a class="adminlog" href="Admin/ALogin.php">Admin Login</a></p>
            </div>

        </div>

        <div class="logo-search">
            <!--<img src="Assest/logo.jpg" alt="Logo" class="logo">-->
            <h1 class="name">NextGenLaptops</h1>
            <form action="" method="POST" class="search">
                <input type="text" name="search1" id="search-input" placeholder="Search here..">
                <button id="search-btn" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <?php
                session_start();
                extract($_POST);
                error_reporting(0);
                $user_data = $_SESSION['user_data'];
                $fname = htmlspecialchars($user_data['First_Name']);
                if(isset($_SESSION['user_data'])){
                    echo "<div class='username'>";
                        echo "<p>$fname</p>";
                        echo "<p><i class='fa-regular fa-circle-user'></i></p>";
                    echo "</div>";
                }else{
                    echo "<div class='login-btn'>";
                        echo "<button type='submit' name='login'><a href='User/ULogin.php'>Login</a></button>";
                    echo "</div>";
                }
            ?>
            <!--<div class="login-btn">
                <button type="submit" name="login"><a href="User/ULogin.php">Login</a></button>
            </div>-->
        </div>
        <?php
           /* extract($_POST);
            if(isset($_POST["search"]))
            {
                
                //echo "<script>console.log('hii')</script>";
                echo "<div class='products-grid'>"; 
                //echo $search1;
                $qry = "SELECT * FROM product WHERE Discription LIKE '%$search1%';";
                $result = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($result))
                    {
                    
                     echo "<div class='product-detail'>";
                     echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                     echo "<div class='comp-name'><b>$row[1]</b></div>";
                     echo "<div class='product-discription'>$row[5]</div>";
                     echo "<div class='pri'><div class='product-price'>RS: $row[4]</div>";
                     echo "<div class='product-price'><strike>RS: $row[3]</strike></div></div>";
                     echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Add to cart</button></div>";
                     echo "<p class='msg'></p>";
                     echo "</div>";
                    }

                echo "</div>";
            }*/
        ?>
        <div class="navigation">
            <div class="links">
                <p><a href="index.php">Home</a></p>
            </div>
            <div class="links">
                <p><a href="feedback.php">Feedback</a></p>
            </div>
            <div class="links">
                <p><a href="AboutUs.php">About</a></p>
            </div>
            <div class="links">
                <p><a href="contect.php">Contect Us</a></p>
            </div>
            <!--<div class="links">
                <p><a href="User/ULogin.php">Login</a></p>
            </div>-->
        </div>
    </header>
    <main>
        <!--<div class="slider">
            <div class="left-btn" >
                <button type="submit" class="slid" id="lbtn"><p><</p></button>
            </div>

            <div class="photos">
                <img src="Assest/sliders/1.jpg" alt="Imageis" class="img" id="slider"/>
            </div>

            <div class="right-btn">
                <button type="submit" class="slid" id="rbtn"><p>></p></button>
            </div>
        </div>-->
        <div class="slider">
            <div class="slides">
                <div class="slide"><img src="Assest/sliders/1.jpg" alt="Image 1"></div>
                <div class="slide"><img src="Assest/sliders/2.jpg" alt="Image 2"></div>
                <div class="slide"><img src="Assest/sliders/3.jpg" alt="Image 3"></div>
                <div class="slide"><img src="Assest/sliders/4.jpg" alt="Image 4"></div>
                <div class="slide"><img src="Assest/sliders/5.jpg" alt="Image 5"></div>
            </div>
        </div>


        <div class="catgory-company">
            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="hp" class="img-btn"><img src="Assest/Logos/h.png" alt="HP Logo"
                            height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="dell" class="img-btn"><img src="Assest/Logos/dell_Logo.png"
                            alt="HP Logo" height="50px" width="80px" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="asus" class="img-btn"><img src="Assest/Logos/asus_logo.png"
                            alt="HP Logo" height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="lanovo" class="img-btn"><img src="Assest/Logos/lonovo_logo.png"
                            alt="HP Logo" height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="acer" class="img-btn"><img src="Assest/Logos/ace.png" alt="HP Logo"
                            height="50px" width="80px" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/mac_logo.jfif" alt="HP Logo"
                            height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="microsoft" class="img-btn"><img src="Assest/Logos/microsoft1.png"
                            alt="HP Logo" height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="samsung" class="img-btn"><img src="Assest/Logos/sam.png" alt="HP Logo"
                            height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="msi" class="img-btn"><img src="Assest/Logos/MSI_logo.png" alt="HP Logo"
                            height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>

            <div class="com-logos">
                <form action="" method="POST">
                    <Button type="submit" name="fujitsu" class="img-btn"><img src="Assest/Logos/fuji.png" alt="HP Logo"
                            height="50px" width="80px" name="hp" /></Button>
                </form>
            </div>
        </div>



        <?php
       /* <div class="catgory-company">
           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="hp" class="img-btn"><img src="Assest/Logos/HP-Logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="dell" class="img-btn"><img src="Assest/Logos/dell_Logo.png" alt="HP Logo" height="50px" width="80px" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="asus" class="img-btn"><img src="Assest/Logos/asus_logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="lanovo" class="img-btn"><img src="Assest/Logos/lonovo_logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/mac_logo.jfif" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/honor_logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/samsung_logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/MSI_logo.png" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>

           <div class="com-logos">
                <form action="" method="POST">
                <Button type="submit" name="mac" class="img-btn"><img src="Assest/Logos/infinix_logo.jpg" alt="HP Logo" height="50px" width="80px" name="hp" /></Button></form>
           </div>
        </div>*/
        ?>
        <?php 
                
              /* if(isset($_POST["hp"]) || isset($_POST["dell"]) || isset($_POST["lanovo"]) || isset($_POST["mac"]) || isset($_POST["victus"]) || isset($_POST["asus"]))
                {
                    echo "<div class='products'>";   
                }*/
            ?>

        <?php
            extract($_POST);
            if(isset($_POST["search"]))
            {
                echo"<h2>SEARCHED LAPTOP</h2>";
                //echo "<script>console.log('hii')</script>";
                echo "<div class='products-grid'>"; 
                //echo $search1;
                $qry = "SELECT * FROM product WHERE Description LIKE '%$search1%';";
                $result = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($result))
                    {
                    
                     echo "<form method='GET' action='detail.php' class='product-detail'>";
                     echo "<input type='text' name='id' value='$row[0]' />";
                     echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                     echo "<div class='comp-name'><b>$row[1]</b></div>";
                     echo "<div class='product-discription'>$row[7]</div>";
                     echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                     echo "<div class='product-price'><strike>RS: $row[3]</strike></div></div>";
                     echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                     echo "<p class='msg'></p>";
                     echo "</form>";
                    }

                echo "</div>";
            }
        


               else if(isset($_POST["hp"]))
                 {
                    
                    // echo "helloo";
                    echo"<h2>HP LAPTOP</h2>";
                    echo "<div class='products-grid'>"; 
                    $qry = "select * from product where Com_Name = 'HP'";
                    $result = mysqli_query($conn,$qry);
                    while($row = mysqli_fetch_array($result))
                    {
                    
                     echo "<form method='GET' action='detail.php' class='product-detail'>";
                     echo "<input type='text' name='id' value='$row[0]' />";
                     echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                     echo "<div class='comp-name'><b>$row[1]</b></div>";
                     echo "<div class='product-discription'>$row[7]</div>";
                     echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                     echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                     echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                     echo "<p class='msg'></p>";
                     echo "</form>";
                    }
                    echo "</div>";
                 }

                else if(isset($_POST["dell"]))
                {
                   // echo "helloo";
                   echo"<h2>DELL LAPTOP</h2>";
                   echo "<div class='products-grid'>"; 
                   $qry = "select * from product where Com_Name = 'DELL'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }
                else if(isset($_POST["asus"]))
                {
                   // echo "helloo";
                   echo"<h2>ASUS LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'ASUS'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["lanovo"]))
                {
                   // echo "helloo";
                   echo"<h2>LANOVOLAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'Lanovo'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["acer"]))
                {
                   // echo "helloo";
                   echo"<h2>ACER LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'ACER'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["mac"]))
                {
                   // echo "helloo";
                   echo"<h2>APPLE LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'MAC'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["microsoft"]))
                {
                   // echo "helloo";
                   echo"<h2>MICROSOFT LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'MICROSOFT'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["samsung"]))
                {
                   // echo "helloo";
                   echo"<h2>SAMSUNG LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'SAMSUNG'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

               else if(isset($_POST["msi"]))
                {
                   // echo "helloo";
                   echo"<h2>MSI LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'MSI'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";
                }

                else if(isset($_POST["fujitsu"]))
                {
                   // echo "helloo";
                   echo"<h2>FUJITSU LAPTOP</h2>";
                   echo "<div class='products-grid'>";
                   $qry = "select * from product where Com_Name = 'FUJITSU'";
                   $result = mysqli_query($conn,$qry);
                   while($row = mysqli_fetch_array($result))
                   {
                    echo "<form method='GET' action='detail.php' class='product-detail'>";
                    echo "<input type='text' name='id' value='$row[0]' />";
                    echo "<div class='product-photo'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                    echo "<div class='comp-name'><b>$row[1]</b></div>";
                    echo "<div class='product-discription'>$row[7]</div>";
                    echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                    echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                    echo "<div class='add-to-cart'><button type='submit' class='addtocart'>Show Product</button></div>";
                    echo "<p class='msg'></p>";
                    echo "</form>";
                   }
                   echo "</div>";

                }
                else
        {
            
                 /*if(isset($_POST["hp"]) || isset($_POST["dell"]) || isset($_POST["lanovo"]) || isset($_POST["mac"]) || isset($_POST["victus"]) || isset($_POST["asus"]))
                 {
                     echo "</div>";   
                 }*/
        
       
        

       
        echo"<h2>All Product</h2>";
       
      // echo" <div class='products' id='pro1'>";
       echo "<div class='products-grid'>";
                
                $qry = 'select * from product';
                //echo $qry;
                $result = mysqli_query($conn,$qry);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<form method='GET' action='detail.php' class='product-detail' name='product-detail'>";
                        echo "<input type='text' name='id' value='$row[0]' class='id_class' />";
                        echo "<div class='product-photo' name='img'><img src='Assest/Product_Image/$row[6]' alt='Product Image' class='pro-image' /></div>";
                        echo "<div class='comp-name'><b>$row[1]</b></div>";
                        echo "<div class='product-discription'>$row[7]</div>";
                        echo "<div class='pri'><div class='product-price'>RS: $row[5]</div>";
                        echo "<div class='product-price'><strike>RS: $row[4]</strike></div></div>";
                        echo "<div class='add-to-cart'><button type='submit' class='addtocart' name='cart'>Show Product</button></div>";
                        echo "<p class='msg'></p>";
                    echo "</form>";
                } echo "</div>";
                }
                    ?>

        </div>
        <div class="big-line"></div>
    </main>
    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h2 class="footer-title">SHOP ADDRESS</h2>
            <p>Shop Address are Sardarnagar, Near Gurukul Campus, Bhavnagar</p>
        </div>
        <div class="footer-section">
            <h3 class="footer-subtitle">OPENING TIME</h3>
            <p>Monday-Friday: <span>08.00 To 18.00</span></p>
            <p>Saturday: <span>09.00 To 20.00</span></p>
            <p>Sunday: <span>10.00 To 20.00</span></p>
        </div>
        <div class="footer-section">
            <h3 class="footer-subtitle">INFORMATION</h3>
            <p><i class="fas fa-map-marker-alt"></i>Bhavnagar</p>
            <p><i class="fas fa-phone"></i>+91 9727545427</p>
            <p><i class="fas fa-phone"></i>+91 8000963447</p>
            <p><i class="fas fa-envelope"></i>NextGenLaptop@gmail.com</p>
        </div>
    </div>
</footer>
    <!--<script src="js/index.js"></script>-->
</body>

</html>