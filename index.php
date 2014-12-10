<?php
	session_start();

	$err = "";

	function db_connect(){ //database connection
		if(isset($_SERVER['APP_NAME'])) {
			return new PDO('mysql:host=' . $_SERVER['DB1_HOST'] . ';port=' . $_SERVER['DB1_PORT'] . ';dbname=' . $_SERVER['DB1_NAME'],
				$_SERVER['DB1_USER'], $_SERVER['DB1_PASS']);
		}
		return new PDO('mysql://host=localhost;dbname=hushtones_db','root','');
	}

	function registration($name, $email){//inserting a data to table author
		$sql = "INSERT INTO registration(name, email)
				VALUES(?,?)";
		$db = db_connect();
		$stmt = $db->prepare($sql);
		$stmt->execute(array($name, $email));
		$db = null;
	}

	if (isset($_POST['submit'])) {
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		
		if(!empty($name) && !empty($email) && preg_match('/^\pL+$/u', $name) && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email)){
			registration($name, $email);
			echo "<script>alert('Successfully registered!');</script>";
		}else{
			echo "<script>alert('Please double check inputs and try again.');</script>";
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="icon/favicon.ico" type="image/x-icon">
<link rel="icon" href="icon/favicon.ico" type="image/x-icon">
		<title>hushtones</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/akoa.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
				
					<a class="navbar-brand"><img src="images/ht.png" height="20px"></a>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row title text-center">
				<img src="http://hushtones.gopagoda.com/images/title.png"/>
			</div>
			<div class="row tagline text-center">
				"The right tone settings at the right place and at the right time."
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="col-md-3">
						<center>
							<img class="style img-responsive img-features" src="images/scheduleO.png" alt="250x250"  title="Schedule">
							<h3>Schedule</h3>
						</center>
						<blockquote>
							<p>Provides an interface to schedule when a user wants to activate the saved settings.
								</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive img-features" src="images/locationO.png" alt="250x250" title="Location">
							<h3>Location</h3>
						</center>	
						<blockquote>
							<p>Allows users to set up the phone's ringer according to location.</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive img-features" src="images/activityO.png" alt="250x250" title="Activity">
							<h3>Activity</h3>
						</center>
						<blockquote>
							<p>Provide users the means to set ringer settings corresponding to different activities.</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive img-features" src="images/backgroundO.png" alt="250x250" title="Background">
							<h3>Background</h3>
						</center>
						<blockquote>
							<p>Automatically adjusts tone settings according to the user's background noise.</p>
						</blockquote>
					</div>	
				</div>
			</div>
		</div>
		<div class=" text-center">
		<div class="content-details text-center">
			<button class="btn btn-lg btn-hushtones btn-color-override btn-success"  data-toggle="modal" data-target="#myModal">Sign up</button> now for free early access.
		</div>
		<span class="playstore"><img class="img-playstore" src="images/playstore.png"/></span>
		</div>
		<div class="container" align="center">
			<div class="row">
				
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form method="POST">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="myModalLabel">Sign up</h3>
						</div>
						<div class="modal-body">
								<input class="form-control" type="text" name="name" placeholder="Name" required autofocus>
								<br>
								<input class="form-control" type="email" name="email" placeholder="Email" required>
						</div>
						<div class="modal-footer">
							<div class="btn btn-default" data-dismiss="modal">Close</div>
							<button type="submit" class="btn btn-hushtones" name="submit">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-1.11.0.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>