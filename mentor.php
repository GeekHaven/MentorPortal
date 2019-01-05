<?php 
  //session_start();
  if (isset($_SESSION['access_token'])) {  
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
    	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
          <div class="col-lg-8 col-md-8 mx-auto">
            <div class="page-heading">
              <h1>Geekhaven Mentor</h1>
             <!--<span class="subheading">Portal is closed and will open soon for mentees.</span>-->
            </div>
          </div>
	 <div class="col-lg-2 col-md-2 mx-auto"></div>
        </div>
      </div>
    </header>

<?php 

   $connect = mysqli_connect("localhost", "root", "", "mentorPortal");

  $ret = mysqli_query($connect, "SELECT * FROM `google_users_mentors` WHERE google_id=$user->id");

  $data = mysqli_fetch_array($ret);
	if($data['max_count']!=0){
  echo "<center>Your current mentee count is ".$data['max_count'].".</center>";
}

?>

	<div class="container">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="addmentor.php" method="POST" >
				<span class="contact100-form-title">
					Fill Details
				</span>

				<label class="label-input100" for="first-name">Tell us your name </label>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Type first name">
					<input id="first-name" class="input100" type="text" name="first-name" placeholder="First name">
					<span class="focus-input100"></span>
				</div>
				<br>
				<div class="wrap-input100 rs2-wrap-input100 validate-input" data-validate="Type last name">
					<input class="input100" type="text" name="last-name" placeholder="Last name">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="email">Enter your email </label>
				<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
					<input id="email" class="input100" type="text" name="email" placeholder="Eg. example@iiita.ac.in">
					<span class="focus-input100"></span>
				</div>
				<br>
				<label class="label-input100" for="count">Mentee Count</label>
				<div class="wrap-input100">
				<input type="number" class="input100" id="number" placeholder="No. of mentees (3-6)" min="3" name="maxcount" max="6">
					<span class="focus-input100"></span>
				</div>
				<br>
				<label class="label-input100" for="Field">Field</label>
				<div class="wrap-input100 validate-input form-control" data-validate="Field is required">
					<input id="Field" list="fields" class="input100" name="field" placeholder="Select your Field">
					<datalist id="fields">
    						<option value="AppDev">
    						<option value="Competitive">
    						<option value="ML & AI">
    						<option value="Blockchain">
    						<option value="SoftDev">
    						<option value="Cyber Security">
    						<option value="WebDev">
  					</datalist>	
					<span class="focus-input100"></span>
				</div>
				<br>
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
<?php 

  $connect = mysqli_connect("localhost", "root", "", "mentorPortal");
  $ret = mysqli_query($connect, "SELECT * FROM `google_users_mentors` WHERE google_id=$user->id");
  $data = mysqli_fetch_array($ret);
	if($data['max_count']!=0){
  		echo "Update";
	}else{
		echo"Submit";
	}
?>
						
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/back.jpg');width:25%;">
			 <div class="logo flex-col-c-m" style="background-image: url('images/logo.jpg'); background-size:150px 150px;">
			 </div>
			</div>

		</div>
	</div>
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
