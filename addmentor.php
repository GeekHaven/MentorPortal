<?php
session_start();
  if (isset($_SESSION['access_token'])) {  
    
    //session_start();
    $userid=$_SESSION['userid'];
if (isset($_POST['field'])){ 
$field = $_POST['field'];}
if (isset($_POST['name'])){
    $name = $_POST['name'];}
if (isset($_POST['email'])){
    $email = $_POST['email'];}
if (isset($_POST['maxcount'])){
    $maxcount = $_POST['maxcount'];}

    $connect = mysqli_connect("localhost", "root", "", "mentorPortal");
    
    if ($maxcount>=3 && $maxcount<=6 && $field!="") {
        $ret = mysqli_query($connect, "UPDATE `google_users_mentors` SET `max_count`=$maxcount WHERE google_id=$userid");
        $re = mysqli_query($connect, "UPDATE `google_users_mentors` SET `field`='$field' WHERE google_id=$userid");
   
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mentors- Geekhaven</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Custom fonts for this template -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
        <!-- Custom styles for this template -->
        <link href="css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#">GeekHaven Mentor Registration</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <?php $redirect_uri='http://localhost/MentorPortal/'; echo "<a class='nav-link' href='".$redirect_uri."?logout'>Log Out</a>" ?>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Page Header -->
    <header class="masthead"  style="background-image: url('img/Background.jpg'); background-size:1300px 800px; background-position:right bottom" >
      <div class="overlay" style="opacity:0.75;"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-8 mx-auto">
            <div class="page-heading">
              <h1>Geekhaven Mentor</h1>
              <span class="subheading">Portal will open soon for mentees.</span>
            </div>
          </div>
	<div class="col-lg-4 col-md-2 mx-auto"></div>
        </div>
      </div>
    </header>

<?php 

   $connect = mysqli_connect("localhost", "root", "", "mentorPortal");

  $ret = mysqli_query($connect, "SELECT * FROM `google_users_mentors` WHERE google_id=$userid");

  $data = mysqli_fetch_array($ret);
  echo "<center>Your current mentee count is ".$data['max_count'].".</center>";
  echo "<center>Your field is ".$data['field'].".</center>";

?>


    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">

              <li class="list-inline-item">
                <a href="https://www.facebook.com/geekhaveniiita/">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://github.com/GeekHaven">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; GeekHaven 2019</p>
            <p class="copyright text-muted">For queries contact <a href="https://www.fb.com/siddhant.srivastav.3">Siddhant Srivastav</a></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>
<?php
 } else {
        include("header.php");
        echo "<center>Please enter mentee count and field correctly :p</center>";
        include("footerm.php");
    }

    } else {
      session_start();
      $authUrl=$_SESSION['authURL'];
      include("headerl.php");
      echo '<div align="center">';
      echo '<h3>Login with Gmail to continue</h3>';
      echo '<div>Please click login button to connect to Google.</div>';
      echo '<a class="login" href="' . $authUrl . '"><img src="https://developers.google.com/+/images/branding/sign-in-buttons/Red-signin_Google_base_44dp.png" /></a>';
      echo '</div>';
      include("footerm.php");
    }
?>
