<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
	<style type="text/css">
		.main-center{
		 	margin-top: 30px;
		 	margin: 0 auto;
		 	max-width: 350px;
		    padding: 10px 40px;
		}
		.main-login{
		 	background-color: #fff;
		    /* shadows and rounded borders */
		    -moz-border-radius: 2px;
		    -webkit-border-radius: 2px;
		    border-radius: 2px;
		    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);

		}
		body, html{
		 	background-repeat: no-repeat;
		 	background-color: #d3d3d3;
		 	font-family: 'Oxygen', sans-serif;
		}
		h1.title { 
			font-size: 50px;
			font-family: 'Passion One', cursive; 
			font-weight: 600;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row ">
			<div class="panel-heading">
               <div class="panel-title text-center">
               		<h1 class="title">Login</h1>
               	</div>
            </div> 
			<div class="main-login main-center">
				<form class="form-horizontal" method="post" action="#">
					<div class="form-group">
						<label for="username" class="cols-sm-2 control-label">Username</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-circle fa-spin" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="username" maxlength="35" id="username" placeholder="Enter your Username"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock fa-spin" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="passwd1" maxlength="35" id="password" placeholder="Enter your Password"/>
							</div>
						</div>
					</div>
					<div class="form-group ">
						<button type="button" name="btn_sub" class="btn btn-primary btn-lg btn-block login-button"><i class="fa fa-user-o" aria-hidden="true"></i> Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
