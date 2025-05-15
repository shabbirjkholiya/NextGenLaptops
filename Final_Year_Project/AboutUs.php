<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AzzipTech</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgba(243, 244, 246);
            ;
            color: #0a0f1e;
        }

        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            font-size: 20px;
            color: #1e2a78;
            margin: 0;
        }

        .header a {
            text-decoration: none;
            color: #1e2a78;
            font-size: 14px;
        }

        .container {
            display: flex;
            max-width: 1400px;
            margin: auto;
            align-items: center;
            padding: 20px;
            margin-top: 40px;
        }

        .text-content {
            flex: 1;
            padding: 20px;
        }

        .text-content h1 {
            font-size: 28px;
            color: #0a0f1e;
        }

        .text-content h1 span {
            color: #3b82f6;
        }

        .text-content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .image-content {
            flex: 1;
            display: flex;
            justify-content: center;
            order: -1;
        }

        .image-content img {
            max-width: 100%;
            border-radius: 10px;
        }

        .services {
            display: flex;
            max-width: 1400px;
            margin: auto;
            padding: 20px;
            gap: 20px;
        }

        .service-box {
            flex: 1;
            background-color: #131a2a;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .service-box img {
            width: 50%;
            border-radius: 10px;
        }

        .service-box h2 {
            font-size: 22px;
            color: white;
        }

        .service-box h2 span {
            color: #3b82f6;
        }

        .service-box p {
            font-size: 14px;
            color: #ccc;
        }

        .service-box a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
        }

        .custom-development {
            max-width: 1400px;
            margin: auto;
            text-align: center;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            margin-top: 40px;
        }

        .custom-development h2 {
            font-size: 28px;
        }

        .custom-development span {
            color: #3b82f6;
        }

        .custom-development p {
            font-size: 16px;
        }

        .custom-development a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        input[name="id"] {
            display: none;
        }


        footer {
            /* Dark background for contrast */
            color: white;
            /* Light text color */
            padding: 40px 0;
            /* Increased padding for better spacing */
            text-align: center;
            /* Center-align text */
            margin-top: 50px;
            /* Add some space above the footer */
            margin-right: 260px;
            margin-left: 150px;
        }

        .footer-container {
            display: flex;
            justify-content: center;
            /* Center the footer content */
            max-width: 1200px;
            /* Limit the width for better readability */
            margin: 0 auto;
            /* Center the container */
            gap: 40px;
            /* Space between sections */
            flex-wrap: wrap;
            /* Allow wrapping on smaller screens */

        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            /* Ensure sections don't get too narrow */
            padding: 20px;
            text-align: left;
            /* Align text to the left within sections */
        }

        .footer-title {
            font-size: 24px;
            margin-bottom: 15px;
            color: rgb(58, 58, 148);
            ;
            /* Accent color for the title */
            font-weight: bold;
        }

        .footer-subtitle {
            font-size: 18px;
            margin-bottom: 15px;
            color: rgb(58, 58, 148);
            ;
            /* Accent color for subtitles */
            font-weight: bold;
        }

        .footer-section p {
            font-size: 16px;
            color: black;
            /* Light gray for better readability */
            margin: 8px 0;
        }

        .footer-section p span {
            font-weight: bold;
            color: black;
            /* White for highlighted text */
        }

        .footer-section i {
            color: rgb(58, 58, 148);
            ;
            /* Accent color for icons */
            margin-right: 8px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>NextGenLaptops</h1>
        <a href="index.php">Back To Portal</a>
    </div>
    <div class="container">
        <div class="image-content">
            <img src="Assest/Abou Us/laptopsale.jpg" alt="Web Development Illustration">
        </div>
        <div class="text-content">
            <h1>Your One-Stop Laptop Shop <span>NextGenLaptops</span></h1>
            <h3>EXPERIENCE THE FUTURE OF LAPTOP SHOPPING</h3>
            <p>Welcome to NextGenLaptops! Where innovation meets convenience, and customer satisfaction drives success!
                At NextGenLaptops, we are committed to providing a seamless and hassle-free shopping experience. With a
                wide variety of laptops from all major brands, we ensure that you find the perfect laptop that meets
                your needs.</p>
            <p>Our platform offers comprehensive selection, informed decision-making, time efficiency, regret-free
                purchases, and a seamless experience. Whether you're a student, professional, or gamer, we've got you
                covered. Explore our website and discover the future of laptop shopping!</p>
        </div>






    </div>
    <div class="services">
        <div class="service-box">
            <img src="Assest/Abou Us/one.jpg" alt="Web Development">
            <h2>Shabbir.J.Kholiya <span>Co-founder and CEO</span></h2>
            <p>We Help Identify The Best Way To Improve Your Business</p>
            <a href="#">Learn More</a>
        </div>
        <div class="service-box">
            <img src="Assest/Abou Us/two.jpg" alt="App Development">
            <h2>Nihal.M.Kureshi <span>Co-founder and CTO</span></h2>
            <p>We Help Identify The Best Way To Improve Your Business</p>
            <a href="#">Learn More</a>
        </div>
    </div>
    <div class="custom-development">
        <h2>Do You Need A Good <span>Laptop? </span></h2>
        <p>EXPERIENCE THE FUTURE OF LAPTOP SHOPPING</p>
        <p>Call Us <span>+917016115489</span> Or You Can Mail To Reach Us</p>
        <a href="#">WhatsApp Us!</a>
    </div>
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
</body>

</html>