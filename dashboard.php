<?php
session_start();
include 'config.php';
$conn = DB();
if(!isset($_SESSION['userid'])){
           header("Location:index.php");                     
                                }

  else{
       $userid = $_SESSION['userid'];
       $stmt = $conn->prepare("SELECT * FROM usermaster WHERE userid=:userid");
    $stmt->bindParam("userid", $userid, PDO::PARAM_STR);
    $stmt->execute();
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        // echo $username;
        
    } 
    }                           
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <?php if($utype == 0) { ?>
 <a href="#" class="list-group-item list-group-item-action">
    My Account
  </a>
  <a href="#" class="list-group-item list-group-item-action">MIS</a>
                                     <?php } elseif($utype == 1) {?>

<a href="#" class="list-group-item list-group-item-action">
    User Management
  </a>
  <a href="#" class="list-group-item list-group-item-action">Recharges</a>
  <a href="#" class="list-group-item list-group-item-action">Mis</a>
                                                                  <?php } else {?>
  <a href="#" class="list-group-item list-group-item-action">
    User Management
  </a>
  <a href="#" class="list-group-item list-group-item-action">Admin Management</a>
  <a href="#" class="list-group-item list-group-item-action">Recharges</a>
  <a href="#" class="list-group-item list-group-item-action">Mis</a>
 <?php } ?>
</div>
        </div>
        <div class="col-md-8">
            <div class="jumbotron bg-white card card-block">
                <h2>
               Hi <?php echo $firstname ?>
                </h2>
            </div>
        </div>
    </div>
</div>
</body>
</html>