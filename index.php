
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
    <form class="form-signin">
      <img class="mb-4" src="/img/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="username-input" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password-input" class="form-control" placeholder="Password" required>
      <button id="login-btn" class="btn btn-lg btn-primary btn-block" type="button">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
  <script src="/js/jquery.js"></script>
  <script>
  $(document).ready(function(){
	  $('#login-btn').on('click', function(){
		  
		  var username = $('#username-input').val();
		  var password = $('#password-input').val();
		  
		  $.ajax({
			type: "POST",
			url: 'http://api.mylocal.test/consumer/login',
			dataType: 'json',
			async: false,
			contentType: 'application/json',		
			data: JSON.stringify({ "username": username, "password" : password }),
			}).done(function(data){
				if (data.token.length) {
					localStorage.setItem("token", data.token);
					alert('Login successful');
					window.location.href = '/todo.php';
				}
			}).fail(function(){
				alert('Login failed');
			});
	
	  });
	  
  });
  </script>
</html>
