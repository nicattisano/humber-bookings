<?php
	include_once('includes/config.php');


	$_SESSION['STATUS'] = 'LOGGED_OUT';


    if(isset($_POST['login'])) {
//        if(strlen($_POST['firstname']) > 1) {
//            $firstname = $_POST['firstname'];
//            $firstname = mysqli_real_escape_string($connect, $firstname);
////            echo $email;
//        }
        
        if(strlen($_POST['lastname']) > 1) {
            $lastname = $_POST['lastname'];
            $lastname = mysqli_real_escape_string($connect, $lastname);
//            $password = md5($password);
//            echo $password;
        }
		
        if(strlen($_POST['studentnum']) > 1) {
            $studentnum = $_POST['studentnum'];
            $studentnum = mysqli_real_escape_string($connect, $studentnum);
//            $password = md5($password);
//            echo $password;
        }
        
        if ($errors < 1) {
           $query = "
                   SELECT *
                   FROM users WHERE 
                   lastname = '{$lastname}' AND num = '{$studentnum}'
                   ";
//                echo $query;
                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
//                $row = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
//                echo $row; die();
            
            if($row) {
//                echo 'User exists';
                $_SESSION['STATUS'] = 'LOGGED_IN';
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['num'] = $row['num'];
//                $_SESSION['id'] = $row['id'];
                header('Location: room.php?firstname='.$_SESSION['firstname'].'&lastname='.$_SESSION['lastname'].'&email='.$_SESSION['email'].'&num='.$_SESSION['num']);
            } else {
				$_SESSION['STATUS'] = 'LOGGED_OUT';
//                echo 'User or password is incorrect';
            }
        }
    }



	if(isset($_POST['add'])) {
		//If the string length of firstname is greater than 1, something was typed in.
		if(strlen($_POST['firstname']) > 1)
		{
			$firstname = $_POST['firstname'];
			//htmlentities will add character entities around any HTML added to your string
			$firstname = htmlentities($firstname);
			//mysqli_real_escape_string will escape any quotes added to your string
			$firstname = mysqli_real_escape_string($connect, $firstname);
		}
		//Else, nothing was typed in so throw out an error or create the error variable
		else
		{
			$error['firstname'] = 'error';	
		}
		
		$lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
		
		//echo $firstname;
		//echo $lastname;
		//echo $email;
		//echo $phone;
		//echo $city;
		
		//If there are no errors, insert the user into the database
		if($error < 1) {
			//Insert the following fields into the address_book table
			//Use the variables that we have cleaned (mysqli_real_escape_string)
			//and pass it into the insert statement
			$query = "
				INSERT INTO 
				users 
				(firstname, lastname) 
				VALUES 
				('{$firstname}', '{$lastname}')
			";	
			//echo $query;
			$result = mysqli_query($connect, $query) or die(mysqli_error($connect));
			

			if($result) {
        		header("Location: room.php");
			}

		}
	}


include_once('includes/head.php');
	
?>
	
<!--
	<div class="row">
		<img src="images/logo.png" id="logo">
	</div>
-->
<section>
<div class="row">
		<h1 class="bookRoom">Book A Room</h1>
	<div class="col-sm-8 col-sm-offset-2 getIn">
		
		<div class="log row">

				<div class="col-md-12">

					<h2>Login</h2>

					<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<fieldset>
	<legend class="hide">Admin Login</legend>
	<div class="row">
		<div class="form-group col-sm-8 col-sm-offset-2">
			<input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name">
		</div>
		</div>
		<div class="row">
		<div class="form-group col-sm-8 col-sm-offset-2">
			<input class="form-control" type="text" name="studentnum" id="studentnum" placeholder="Student Number">
		</div>
	</div>
		<div class="form-group col-sm-8 col-sm-offset-2">
			<input class="form-control btn btn-default" type="submit" id="submit" name="login" value="Login">
		</div>

</fieldset>

					</form>
					</div>

			</div>




			<div class="create row">

					<div class="col-md-12">
						<h2>Sign Up</h2>

						<form method="post" action="<?php echo $_SERVER[" PHP_SELF "]; ?>">
							<fieldset>
								<div class="row">
									<div class="form-group col-sm-8 col-sm-offset-2">
										<input class="form-control" type="text" name="firstname" placeholder="First Name">
									</div>
									<div class="form-group col-sm-8 col-sm-offset-2">
										<input class="form-control" type="text" name="lastname" placeholder="Last Name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-8 col-sm-offset-2">
										<input class="form-control" type="text" name="email" placeholder="Email Address">
									</div>
									<div class="form-group col-sm-8 col-sm-offset-2">
										<input class="form-control" type="text" name="studentnum" placeholder="Student/Staff Number">
									</div>
								</div>
								<div class="form-group col-sm-6 col-sm-offset-3">
									<input class="form-control btn btn-default" type="submit" name="add" value="Create Account" class="button">
								</div>
							</fieldset>
						</form>
					</div>
			</div>
		
		</div>
	</div>
<div class="switcher switcherCreate">
	<p>Already have an Account?</p>
	<a href="#" id="login">Log In Here</a>
</div>

<div class="switcher switcherLogin">
	<a href="#" id="create">Back to Sign Up</a>
</div>
</section>
		
		
		<img src="images/we-are-humber.png" id="weAreHumber">
		
		</body>
		<?php
	include_once('includes/scripts.php');
?>