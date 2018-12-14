<?php 
session_start();
include('inc/API_Client.php');
$api = new API_Client();

if (isset($_SESSION['token'])) {
	$api->save_token($_SESSION['token']);
	$data = $api->go('todo2');
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
  </head>

  <body>
  <div class="container">
	
	<div class="row">
		<div class="col-md-12"><p>&nbsp;</p></div>
	</div>
	<div class="row">
		<div class="col-md-12">
  <button id="btn-logout">Logout</button>
			<table class="table table-striped" id="todo-table">
				<thead>
					<tr>
					<th>Title</th>
					<th>Date</th>
					<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($data['entry'] as $d) {?>
					<tr>
						<td><?php echo $d['title']?></td>
						<td><?php echo $d['insertDate']?></td>
						<td><button>&times;</button></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
  </div>
  
 </body>
  <script src="/js/jquery.js"></script>
</html>
