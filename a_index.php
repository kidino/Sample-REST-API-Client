<?php 
session_start();
if ($_POST) { 

	include('inc/API_Client.php');
	
	$api = new API_Client();
	if ($api->login($_POST['username'], $_POST['password'])) {
		$_SESSION['token'] = $api->get_token();
		header('Location: /a_todo.php');
	} else {
		header('Location: /a_index.php?error=1');
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="a_index.php">
	
	<?php if (isset($_GET['error'])) { ?>
	<p class="alert alert-danger">Invalid username or password</p>
	<?php } ?>
	
      <img class="mb-4" src="/img/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" name="username" id="username-input" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="password-input" class="form-control" placeholder="Password" required>
      <button id="login-btn" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
  <script src="/js/jquery.js"></script>
</html>
