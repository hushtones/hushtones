<?php
	session_start();

	function db_connect(){ //database connection
		if(isset($_SERVER['APP_NAME'])) {
			return new PDO('mysql://host=' . $_SERVER['DB1_HOST'] . ';port=' . $_SERVER['DB1_PORT'] . ';dbname=' . $_SERVER['DB1_NAME'],
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
		$email = $_POST['email'];

		if(empty($email)){
			echo"<script>alert('Fill up email.');</script>";
		} else {
			registration($name, $email);
			echo"<script>alert('Successfully registered!');</script>";
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
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand"><img src="images/ht.png" height="20px"></a>
				</div>
			</div>
		</div>

		<div class="container" style="margin-top:100px">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-md-3">
						<center>
							<img class="style img-responsive" src="images/schedule.png" alt="250x250"  title="Schedule">
							<h4>Schedule</h4>
						</center>
						<blockquote>
							<p>Provides an interface to schedule when a user wants to activate the saved settings.
								</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive" src="images/location.png" alt="250x250" title="Location">
							<h4>Location</h4>
						</center>	
						<blockquote>
							<p>Provides a map that allows the user to choose a location to setup phone's ringer and changes the tones 
							setting when the user arrive at the location's premises.</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive" src="images/activity.png" alt="250x250" title="Activity">
							<h4>Activity</h4>
						</center>
						<blockquote>
							<p>Provide users the means to set ringer settings corresponding to different activities.</p>
						</blockquote>
					</div>
					<div class="col-md-3">
						<center>
							<img class="style img-responsive" src="images/background.png" alt="250x250" title="Background">
							<h4>Background</h4>
						</center>
						<blockquote>
							<p>Automatically adjusts tone settings according to the user's background noise.</p>
						</blockquote>
					</div>	
				</div>
			</div>
		</div>

		<div class="container" align="center">
			<div class="row">
				<button class="btn btn-lg btn-hushtones"  data-toggle="modal" data-target="#myModal">Sign up</button>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form method="POST">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Sign up</h4>
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