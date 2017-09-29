<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$human = intval($_POST['human']);

$from = $_POST['email'];
$to = 'spikeup_08@yahoo.com';
$subject = 'Message from Contact Demo ';

$body = "From: $name\n E-Mail: $email\n Message:\n $message";


if(!empty($_POST['submitted'])) {
	$foundError = false;
	$errName = '';
	$errEmail = '';
	$errMessage = '';
	$errHuman = '';
	$successMessage = '';

	if (!$_POST['name']) {
		$errName = 'Please enter a name';
		$foundError = true;
	}

	if (!preg_match("/^[a-zA-Z ]*$/",$name)){
		$errName = 'Only letters and spaces are allowed';
		$foundError = true;
	}
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
		$foundError = true;
	}
	if (!$_POST['message']){
		$errMessage = 'Please enter a message';
		$foundError = true;
	}else if (!filter_var($_POST['message'], FILTER_SANITIZE_STRING)) {
		$errMessage = 'You no can hack me';
		$foundError = true;
	}
	if ($human !== 5) {
		$errHuman = 'Do you even math?';
		$foundError = true;
	}
	if(!$foundError)
	{
		mail($to, $subject, $body);
		$successMessage = 'Your message has been sent. Casey will contact you shortly!';
	}
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <nav>
        <h3><a href="home.html">Home</a></h3>
        <h3><a href="about.html">About</a></h3>
        <h3><a href="contact.php">Contact</a></h3>
      </nav>
      <form class="form-horizontal" role="form" method="post" action="?">
      	<div class="form-group">
      		<label for="name" class="col-sm-2 control-label">Name</label>
      		<div class="col-sm-10">
      			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlentities ($name) ?>">
						<div class="errorDiv">
							<span class="error"><?php echo $errName ?></span>
						</div>
      		</div>
      	</div>

      	<div class="form-group">
      		<label for="email" class="col-sm-2 control-label">Email</label>
      		<div class="col-sm-10">
      			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlentities ($email) ?>">
						<div class="errorDiv">
							<span class="error"><?php echo $errEmail ?></span>
						</div>
      		</div>
      	</div>

      	<div class="form-group">
      		<label for="message" class="col-sm-2 control-label">Message</label>
      		<div class="col-sm-10">
      			<textarea class="form-control" rows="4" name="message" value="<?php echo htmlentities ($message) ?>"></textarea>
						<div class="errorDiv">
							<span class="error"><?php echo $errMessage ?></span>
						</div>
      		</div>
      	</div>

      	<div class="form-group">
      		<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
      		<div class="col-sm-10">
      			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
						<div class="errorDiv">
							<span class="error"><?php echo $errHuman ?></span>
						</div>
      		</div>
      	</div>

      	<div class="form-group">
      		<div class="col-sm-10 col-sm-offset-2">
      			<input id="submit" name="submitted" type="submit" value="Send" class="btn btn-primary">
						<div class="successDiv">
							<span class="success"><?php echo $successMessage ?></span>
						</div>
      		</div>
      	</div>

      	<div class="form-group">
      		<div class="col-sm-10 col-sm-offset-2">
      			<! Will be used to display an alert to the user>
      		</div>
      	</div>
      </form>
</div>
  </body>
</html>
