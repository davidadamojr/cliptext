<?php
require_once('config.php');
require('vendor/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();
$request_token = array();
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']){
	// Abort! Something is wrong - call 911
	header('Location: ' . HOME);
}

$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
$access_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_REQUEST['oauth_verifier']));


// user connection
$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$image_hash = $_SESSION['image_hash'];
$tweet_text = $_SESSION['tweet_text'];
$media = $connection->upload('media/upload', array('media' => './clips/' . $image_hash . '.png'));
$parameters = array(
	'status' => $tweet_text,
	'media_ids' => $media->media_id_string
);
$result = $connection->post('statuses/update', $parameters);
$error_state = false;
if ($connection->lastHttpCode() == 200){
	$message = "Your tweet and image have been posted successfully. Thank you for using Cliptext!";
	
	// delete the image file
	unlink('./clips/' . $image_hash . '.png');
} else {
	$message = "There was an error posting your tweet. Please try again.";
	$error_state = true;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cliptext</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/skeleton.css" />
  <link rel="stylesheet" href="css/app.css" />
   <link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
</head>
<body>
  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <div class="container main">
	 <h1>Cliptext</h1>
	 <a class="button" href="<?php if ($_SESSION['mobile']) echo "index-android.php"; else echo HOME; ?>">&larr; Home</a>
	 <div class="alert">
	   <p><?php echo $message; ?></p>
	 </div><br/>
	 <?php if ($error_state): ?>
	 <a class="button button-primary" href="auth.php?image_hash=<?php echo $image_hash; ?>&tweet_text=<?php echo urlencode($tweet_text); ?>">Try Again</a>
	 <?php endif; ?>
	 <?php include('footer.php'); ?>
  </div>
</body>
</html>