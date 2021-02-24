<?php
include 'config.php';
session_start();
$login_error_message = '';
$userid = '';
$conn = DB();

if (!empty($_POST['btnLogin']))
{

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $pass = MD5($password);

    $stmt = $conn->prepare("SELECT * FROM usermaster WHERE username=:username AND MD5(userpass)=:userpass");
    $stmt->bindParam("username", $username, PDO::PARAM_STR);
    $stmt->bindParam("userpass", $pass, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        // echo $userid;
        
    }
    if ($userid > 0)
    {
        $today = (new DateTime())->format('Y-m-d');
        $expiry = (new DateTime($expirydate))->format('Y-m-d');
        if ($userstatus == 0)
        {
            $login_error_message = "YOU ARE NOT ACTIVATED USER";
        }
        elseif (strtotime($today) > strtotime($expiry))
        {
            $login_error_message = "YOUR USER ID IS EXPIRED";

        }
        elseif ($userstatus == 1)
        {
            $_SESSION['userid'] = $userid; // Set Session
            header("Location: dashboard.php"); // Redirect user to dashboard.php
            return $_SESSION['userid'];
        }

    }
    else
    {
        $login_error_message = 'Invalid login details! Please try again';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link rel="stylesheet" type="text/css" href="style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="login">
        <h3 class="text-center text-white pt-5">Welcome</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    	  <?php
if ($login_error_message != "")
{
    echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
}
?>
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnLogin" class="btn btn-info btn-md" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
