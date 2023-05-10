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

$first_name = $last_name = $email = $phone = $collateral = $amount = $town = $date = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $town_err = $collateral_err = $amount_err = $date_err = "";
$next_of_kin_first_name = $next_of_kin_last_name = $next_of_kin_email = $next_of_kin_phone = "";
$next_of_kin_first_name_err = $next_of_kin_last_name_err = $next_of_kin_email_err = $next_of_kin_phone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["first_name"]))) {
    $first_name_err = "Please enter your First Name.";
  } else {
    $first_name = mysqli_real_escape_string($link, $_POST['first_name']);
  }

  if (empty(trim($_POST["last_name"]))) {
    $last_name_err = "Please enter your Last Name.";
  } else {
    $last_name = mysqli_real_escape_string($link, $_POST['last_name']);
  }

  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter email.";
  } else {
    $email = mysqli_real_escape_string($link, $_POST['email']);
  }

  if (empty(trim($_POST["phone"]))) {
    $phone_err = "Please enter your phone number.";
  } else {
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
  }

  if (empty(trim($_POST["town"]))) {
    $town_err = "Please enter your town.";
  } else {
    $town = mysqli_real_escape_string($link, $_POST['town']);
  }

  if (empty(trim($_POST["amount"]))) {
    $amount_err = "Please enter the amount.";
  } else {
    $amount = mysqli_real_escape_string($link, $_POST['amount']);
  }

  if (empty(trim($_POST["collateral"]))) {
    $collateral_err = "Please enter the collateral.";
  } else {
    $collateral = mysqli_real_escape_string($link, $_POST['collateral']);
  }

  if (empty(trim($_POST["date"]))) {
    $date_err = "Please select a due date.";
  } else {
    $date = mysqli_real_escape_string($link, $_POST['date']);
  }

  if (empty(trim($_POST["next_of_kin_first_name"]))) {
      $next_of_kin_first_name_err = "Please enter the first name of your next of kin.";
    } else {
      $next_of_kin_first_name = mysqli_real_escape_string($link, $_POST['next_of_kin_first_name']);
    }

    if (empty(trim($_POST["next_of_kin_last_name"]))) {
      $next_of_kin_last_name_err = "Please enter the last name of your next of kin.";
    } else {
      $next_of_kin_last_name = mysqli_real_escape_string($link, $_POST['next_of_kin_last_name']);
    }

    if (empty(trim($_POST["next_of_kin_email"]))) {
      $next_of_kin_email_err = "Please enter the email of your next of kin.";
    } else {
      $next_of_kin_email = mysqli_real_escape_string($link, $_POST['next_of_kin_email']);
    }

    if (empty(trim($_POST["next_of_kin_phone"]))) {
      $next_of_kin_phone_err = "Please enter the phone number of your next of kin.";
    } else {
      $next_of_kin_phone = mysqli_real_escape_string($link, $_POST['next_of_kin_phone']);
    }

    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_err) && empty($town_err) && empty($amount_err) && empty($date_err) && empty($next_of_kin_first_name_err) && empty($next_of_kin_last_name_err) && empty($next_of_kin_email_err) && empty($next_of_kin_phone_err) && empty($collateral_err)) {
      $user_data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'town' => $town,
        'amount' => $amount,
        'date' => $date,
        'next_of_kin_first_name' => $next_of_kin_first_name,
        'next_of_kin_last_name' => $next_of_kin_last_name,
        'next_of_kin_email' => $next_of_kin_email,
        'next_of_kin_phone' => $next_of_kin_phone,
        'collateral' => $collateral
      ];
      $_SESSION['user_data'] = $user_data;
      header("location: confirm.php");
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
        <div class="container contact-form-container">
          <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
              <div class="col-md-6">
                <h2>Enter Your Information Below</h2>
                <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                  <label class=" form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $first_name; ?>">
                    <span class="help-block"><?php echo $first_name_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                  <label class="form-label">Last Name</label>
                  <div class="col-sm-10">
                      <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                      <span class="help-block"><?php echo $last_name_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                  <label class="form-label">Email</label><br>
                  <div class="col-sm-10">
                      <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                      <span class="help-block"><?php echo $email_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($town_err)) ? 'has-error' : ''; ?>">
                  <label class=" form-label">Town</label>
                  <div class="col-sm-10">
                      <input type="text" name="town" class="form-control" placeholder="Town" value="<?php echo $town; ?>">
                      <span class="help-block"><?php echo $town_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                  <label class="form-label">Phone Number</label>
                  <div class="col-sm-10">
                      <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>">
                      <span class="help-block"><?php echo $phone_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($collateral_err)) ? 'has-error' : ''; ?>">
                  <label class="form-label">Collateral</label>
                  <div class="col-sm-10">
                      <input type="text" name="collateral" class="form-control" placeholder="Phone Number" value="<?php echo $collateral; ?>">
                      <span class="help-block"><?php echo $collateral_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                    <label class="form-label">Amount (ZMW)</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" class="form-control" placeholder="Amount" value="<?php echo $amount; ?>">
                        <span class="help-block"><?php echo $amount_err; ?></span>
                    </div>
                </div>
                <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                  <label class="form-label">Due Date</label>
                  <div class="col-sm-10">
                      <select name="date" id="">
                        <option value="">select the due date</option>
                        <option value="1week">1 Week 20%</option>
                        <option value="2week">2 Weeks 27%</option>
                        <option value="3week">3 Weeks 35%</option>
                        <option value="1month">1 Month 40%</option>
                      </select>
                      <span class="help-block"><?php echo $date_err; ?></span>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-20">
                <h2>Enter Information of Next of Kin</h2>
                <div class="form-group <?php echo (!empty($next_of_kin_first_name_err)) ? 'has-error' : ''; ?>">
                    <label class=" form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="next_of_kin_first_name" class="form-control" placeholder="First Name" value="<?php echo $next_of_kin_first_name; ?>">
                      <span class="help-block"><?php echo $next_of_kin_first_name_err; ?></span>
                    </div>
                </div>
                <br>
                <div class="form-group <?php echo (!empty($next_of_kin_last_name_err)) ? 'has-error' : ''; ?>">
                    <label class="form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="next_of_kin_last_name" class="form-control" placeholder="Last Name">
                        <span class="help-block"><?php echo $next_of_kin_last_name_err; ?></span>
                    </div>
                </div>
                <div class="form-group <?php echo (!empty($next_of_kin_email_err)) ? 'has-error' : ''; ?>">
                  <br><label class="form-label">Email</label>
                  <div class="col-sm-10">
                      <input type="text" name="next_of_kin_email" class="form-control" placeholder="Email" value="<?php echo $next_of_kin_email; ?>">
                      <span class="help-block"><?php echo $next_of_kin_email_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($next_of_kin_phone_err)) ? 'has-error' : ''; ?>">
                    <label class="form-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" name="next_of_kin_phone" class="form-control" placeholder="Phone Number" value="<?php echo $next_of_kin_phone; ?>">
                        <span class="help-block"><?php echo $next_of_kin_phone_err; ?></span>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="send_message" class="btn btn-primary" value="Next">
                  </div>
                </div>
                <h2>Contact Us</h2>
                <div class="contact-info">
                    <p>Email: contact@mofyaloans.com</p>
                    <p>Phone: +26 0969909077 or +26 0969909077</p>
                </div>
              </div>
              
            </form>
          </div>
        </div>

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