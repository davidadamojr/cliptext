<?php
require_once('config.php');
require('vendor/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();
if (isset($_POST['image_hash']) && isset($_POST['tweet_text'])){
	$_SESSION['image_hash'] = $_POST['image_hash'];
	$_SESSION['tweet_text'] = trim($_POST['tweet_text']);
} else if (isset($_GET['image_hash']) && isset($_GET['tweet_text'])){
	$_SESSION['image_hash'] = $_GET['image_hash'];
	$_SESSION['tweet_text'] = trim(urldecode($_GET['tweet_text']));
} else { 
	header('Location: ' . HOME);
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// redirect to auth website
$auth_url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
header('Location: ' . $auth_url);
?>