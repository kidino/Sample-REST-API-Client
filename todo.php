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

  <body>
  <div class="container">
  <button id="btn-logout">Logout</button>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped" id="todo-table">
				<thead>
					<tr>
					<th>Title</th>
					<th>Date</th>
					<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="3">Loading</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
  </div>
  
 </body>
  <script src="/js/jquery.js"></script>
  <script>
  $(document).ready(function(){

 $('#btn-logout').on('click', function(){
	 localStorage.removeItem('token');
	 window.location.href = '/';
 });

		 $.ajax({
		  url: "http://api.mylocal.test/todo2",
		  type: 'GET',
		  headers: {"Authorization": 'Bearer '+localStorage.getItem('token')}
		}).done(function(data){
			console.log(data);
			build_table(data);
		}).fail(function(){
			window.location.href = '/';
		});
	  
  });
  
  
function build_table(data){
	if (data.entry.length) {
		
		$('#todo-table tbody').html('');
		for(var x in data.entry) {
			$('#todo-table tbody').append('<tr>');
			$('#todo-table tbody').append('<td>'+data.entry[x].title+'</td>');
			$('#todo-table tbody').append('<td>'+data.entry[x].insertDate+'</td>');
			$('#todo-table tbody').append('<td><button class="btn" data-id="'+data.entry[x].id+'">&times;</button></td>');
			$('#todo-table tbody').append('</tr>');
		}
	}
}
  </script>
</html>
