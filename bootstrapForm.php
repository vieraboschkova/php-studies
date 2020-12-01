<?php
    $errName = '';
    $errEmail = '';
    $errPassword = '';
    $errPasswordRepeat = '';
    $result = '';

	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordRepeat = $_POST['passwordRepeat'];

		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your username';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if password has been entered
		if (!$_POST['password']) {
			$errMessage = 'Please enter a valid password';
        }
        
        //Check if password has been entered
		if (!$_POST['passwordRepeat']) {
			$errMessage = 'Passwords do not match';
		}

        // VALIDATE INPUTS
        // check if the username is registered
        // check if the email is registered
        // check if passwords are the same
        // check if password is : at least one BIG letter, one small letter, and numbers, min 8 characters

        
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errPassword && !$errPasswordRepeat) {
    // handle the form
    echo "sent!";
	// if (mail ($to, $subject, $body, $from)) {
	// 	$result='<div class="alert alert-success">Thank You! I will be in touch</div>';
	// } else {
	// 	$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	// }
}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Contact Form With PHP\</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center">Registration Form</h1>
				<form class="form-horizontal" role="form" method="post" action="index.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input 
                                type="text" 
                                class="form-control" 
                                id="name" name="name" 
                                placeholder="Enter Username" 
                                value="<?php empty($_POST['name'])? "": htmlspecialchars($_POST['name']); ?>"
                            >
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                placeholder="example@domain.com" 
                                value="<?php echo empty($_POST['email'])? "": htmlspecialchars($_POST['email']); ?>"
                                >
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>

                    <div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input 
                                type="text" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                placeholder="at least one BIG letter, one small letter, and numbers" 
                                value="<?php echo empty($_POST['password'])? "": htmlspecialchars($_POST['password']); ?>"
                                >
							<?php echo "<p class='text-danger'>$errPassword</p>";?>
						</div>
					</div>

                    <div class="form-group">
						<label for="passwordRepeat" class="col-sm-2 control-label">Repeat Password</label>
						<div class="col-sm-10">
							<input 
                                type="text" 
                                class="form-control" 
                                id="passwordRepeat" 
                                name="passwordRepeat" 
                                placeholder="Enter your password again" 
                                value="<?php echo empty($_POST['passwordRepeat'])? "": htmlspecialchars($_POST['passwordRepeat']); ?>"
                                >
							<?php echo "<p class='text-danger'>$errPasswordRepeat</p>";?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>