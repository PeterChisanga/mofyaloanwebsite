<?php

    $timeout = 10;
    session_start();
    // if (isset($_SESSION['last_activity'])) {
    //     $inactive_time = time() - $_SESSION['last_activity'];
    //     if ($inactive_time > $timeout) {
    //         session_destroy();
    //     }
    // }
    // $_SESSION['last_activity'] = time();

    require "config.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    function send_email($first_name,$last_name,$email,$phone,$town,$amount){
        $mail = new PHPMailer;
        $mail->isSMTP();          
        $mail->Host       = 'smtp.gmail.com';     
        $mail->SMTPAuth   = true;                   
        $mail->Username   = 'peterchisangamwamba@gmail.com';                   
        $mail->Password   = 'urvpwfotsisnsceh';                             

        $mail->SMTPSecure = "ssl";        
        $mail->Port = 465;  

        if(!isset($email)){
        $email = "peterchisangamwamba@gmail.com";
        }

        $mail->setFrom($email);
        $mail->addAddress('peterchisangamwamba@gmail.com');     

        $mail->isHTML(true);                        
        $mail->Subject = "Message From Client on the Website";

        $email_template = "
        <h2>$first_name</h2>
        <h2>$last_name</h2>
        <h3>$email</h3>
        <p>$phone</p>
        <p>$town</p>
        <p>$amount</p>
        ";

        $mail->Body = $email_template;
        if($mail->send()){
            $_SESSION["status"] = "Success";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['confirm'])) {
            $first_name = $_SESSION['user_data']['first_name'];
            $last_name = $_SESSION['user_data']['last_name'];
            $email = $_SESSION['user_data']['email'];
            $phone = $_SESSION['user_data']['phone'];
            $town = $_SESSION['user_data']['town'];
            $amount = $_SESSION['user_data']['amount'];

            if (!empty($first_name) && !empty($last_name) && !empty($phone) && !empty($town) && !empty($amount)) {
                send_email($first_name, $last_name, $email, $phone, $town, $amount);
            }
        } elseif (isset($_POST['edit'])) {
            header("Location: contact.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles/all.min.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <!-- <link
      href="https://img.icons8.com/pastel-glyph/64/000000/laptop-settings--v2.png"
      rel="icon"
    /> -->
    <title>mofya loans</title>
  </head>

    <body>
        <div class="custom-header">
            <header>
                <a href="/mofyaloans/index.html" class="logo">
                <img src="images/logo1.png" />
                <h3 class="brand-name">Great MO's soft loans</h3>
                </a>
                <i class="bx bx-menu" id="menu-icon"></i>
                <ul class="navbar">
                <li><a href="/mofyaloans/index.html">Home</a></li>
                <li><a href="/mofyaloans/contact.php">Get A Loan Now</a></li>
                <li><a href="/mofyaloans/about.html">About Us</a></li>
                </ul>
            </header>
        </div>

        <?php
        if (isset($_SESSION['user_data'])) {
            $user_data = $_SESSION['user_data'];
        ?>
        <div class="container confirm-container">
            <form action="confirm.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h2> Your Information</h2>
                        <div class="form-group">
                            <label><span>First Name : </span><?php echo $user_data['first_name']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Last Name : </span><?php echo $user_data['last_name']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Email :</span> <?php echo $user_data['email']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Phone :</span> <?php echo $user_data['phone']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Town :</span> <?php echo $user_data['town']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Collateral :</span> <?php echo $user_data['collateral']; ?></label>
                        </div>

                        <?php
                        if ($user_data['date'] == "1week"){
                            $amount = ($user_data['amount'] * .2) + $user_data['amount'];
                            $date = "3 weeks at 20%";
                        }
                        if ($user_data['date'] == "2week"){
                            $amount = ($user_data['amount'] * .27) + $user_data['amount'];
                            $date = "3 weeks at 27%";
                        }
                        if ($user_data['date'] == "3week"){
                            $amount = ($user_data['amount'] * .35) + $user_data['amount'];
                            $date = "3 weeks at 35%";
                        }
                        if ($user_data['date'] == "1month"){
                            $amount = ($user_data['amount'] * .4) + $user_data['amount'];
                            $date = "3 weeks at 40%";
                        }
                        ?>
                        <div class="form-group">
                            <label><span>Due Date :</span> <?php echo $date; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Amount : </span>K <?php echo $user_data['amount'] ; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Total Amount To Pay Back : </span>K <?php echo $amount; ?></label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2>Next of Kin Information</h2>
                        <div class="form-group">
                            <label><span>First Name : </span><?php echo $user_data['next_of_kin_first_name']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Last Name : </span><?php echo $user_data['next_of_kin_last_name']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Email :</span> <?php echo $user_data['next_of_kin_email']; ?></label>
                        </div>
                        <div class="form-group">
                            <label><span>Phone :</span> <?php echo $user_data['next_of_kin_phone']; ?></label>
                        </div>
                    </div>
                </div><br>
                <input type="submit" name="confirm" value="Confirm" class="btn btn-primary">
                <input type="submit" name="edit" value="Edit" class="btn btn-secondary">
            </form>
        </div>
        <?php
        }
        ?>

        <div class="footer">
            <div class="container">
                <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h3>About Us</h3>
                    <p>
                    We are a company that provide low interest loans . We are based in
                    Lusaka ,Zambia.
                    </p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h3>Contact Us</h3>
                    <p>
                    <br />Phone : +26 0969909077 or +26 0969909077 <br />Email :
                    contact@mofyaloans.com <br />
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Follow Us</h3>
                    <ul class="list-inline">
                    <li>
                        <a href="https://www.facebook.com/profile.php?id=100008526245168"><i class="fa-brands fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="bottom-bar">
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <p>&copy; 2023 mofyaloans. All rights reserved.</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <script src="js/nav.js"></script>
    </body>
</html>