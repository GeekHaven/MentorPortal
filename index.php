<?php
session_start(); //session start

require_once ('libraries/Google/autoload.php');

//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '746046536896-4oqbfae53alocmt486cesuqb07hhp623.apps.googleusercontent.com'; 
$client_secret = 'JSshpZaUo6kyaIfO3Q0viwTE';
$redirect_uri = 'http://localhost/MentorPortal/';

//database
$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'mentorPortal'; //Database Name

//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
  session_destroy();
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/
  
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}


//Display user info or display login url as per the info we have.
echo '<div>';
if (isset($authUrl)){ 

	include("headermentee.php");
	//include("headerl.php");
	echo '<div align="center">';
	echo '<h3>Login with Gmail to continue</h3>';
	echo '<div>Please click login button to connect to Google.</div>';
	echo '<a class="login" href="' . $authUrl . '"><img src="https://developers.google.com/+/images/branding/sign-in-buttons/Red-signin_Google_base_44dp.png" /></a>';
  echo '</div>';
  include("footerm.php");
	
} else {
	
  $user = $service->userinfo->get(); //get user info 
  
	// connect to database
  $mysqli = mysqli_connect("localhost", "root", "", "mentorPortal");
  //$mysqli = mysqli_connect("127.0.0.1", "root", "", "mentors");
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
	
	//check if user exist in database using COUNT
  //$result = $mysqli->query("SELECT * FROM google_users_mentors WHERE google_id=$user->id");
  $result = $mysqli->query("SELECT * FROM google_users WHERE google_id=$user->id");
  //$result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
	//$user_count = $result->fetch_all()->usercount; //will return 0 if user doesn't exist

$mysqli->query("
CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(60) NOT NULL,
  `selected` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


  $data = mysqli_fetch_array($result);

  if($data['google_id'])
    $user_count=1;
  else
    $user_count=0;

    $_SESSION['userid']=$user->id;
    $_SESSION['useremail']=$user->email;
    $_SESSION['username']=$user->name;
    if(isset($_SESSION['authURL'])) {
      $_SESSION['authURL']=$authUrl;
    }
  
	
	if($user_count)
    {
      include("selectmentor.php");
      //include("mentor.php");
    }
	else
	{ 
    $statement = $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES ($user->id,'$user->name','$user->email','$user->link','$user->picture')");
    //$statement = $mysqli->query("INSERT INTO google_users_mentors (google_id, google_name, google_email, google_link, google_picture_link) VALUES ($user->id,'$user->name','$user->email','$user->link','$user->picture')");
    //$statement = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?,?,?,?,?)");
		//$statement->bind_param('issss', $user->id,  $user->name, $user->email, $user->link, $user->picture);
    //$statement->execute();
    include("selectmentor.php");
    //include("mentor.php");

    }
	

/*	echo '<pre>';
	print_r($user);
	echo '</pre>';*/
}
echo '</div>';


?>

