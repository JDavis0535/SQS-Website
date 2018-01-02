<?php
/**
This file is where users can create accounts.
Accounts created on this page are automically given a ranking of "3", which is simply an account without administrative privileges (further distinctions between account rankings may be given in the future).
Only the name, email, and password information must be created to create an account.
Errors will not be introduced to this page any time soon because specific errors can currently only be associated with users who are logged in.
*/
include 'config/header.php'; //connects to database
require_once('../sql_connector.php');?>

<?php
//Start of code for user registration page 1 in SQL
if(isset($_POST['submit'])) {		//waits for buttons press
    $EmailError = False;
    $passwordError = False;
    $passwordsMatch = False;
    $NameError = False;

	$url= 'user_register2.php';
	
	//makes sure that pasword and email aren't sql queries
    if (preg_match('%[A-Za-z0-9\.\-\$\@\$\!\%\*\#\?\&]%', stripslashes(trim($_POST['password'])))) {
        if($_POST['password'] == $_POST['confirmpassword'])
	{
		$passwordsMatch = True;
	}
	$password = $mysqli->real_escape_string(trim($_POST['password']));
        $password  = hash("sha256", $password);
    }
    else {
        $passwordError = True;
    }
    if (preg_match('%[A-Za-z0-9]+@+[A-Za-z0-9]+\.+[A-Za-z0-9]%', stripslashes(trim($_POST['email'])))) {
        $email = $mysqli->real_escape_string(trim($_POST['email']));
    }
    else {
        $EmailError = True;
    }

    if (preg_match('%^[a-zA-Z ]+$%', stripslashes(trim($_POST['name'])))) {
        $name = $mysqli->real_escape_string(trim($_POST['name']));
    }
    else {
        $NameError = True;
    }

	//updates info
    if($passwordsMatch == False) {
		echo "<div class='container' id='error'>Error: You did not type the same password twice.</div>";
	}
    else if ($passwordError == False and $EmailError == False and $NameError == False) {

		//Create a new user account with the mandatory information
        $query = "Insert INTO user (Name,Password,Email) VALUES (?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sss",$name,$password,$email);
        $stmt->execute();
        $results = $stmt->fetch();

		//If the account was successfully created, log the user into the new account
		if ($mysqli->affected_rows == 1) {

			$sql = "SELECT * FROM user WHERE Email=\"".$email."\";";
			$result = $mysqli->query($sql);
			$UID = -1;
			
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$UID = $row["UID"];
				}
			}
			
			$_SESSION['ID'] = $UID;
			header("Location: $url");
		}
		else {
			echo "<div class='container' id='error1'>Darn! that email is taken :( Try another!</div>";
		}
	}
	else {
		echo "<div class='container' id='error2'>Invalid Credentials please try again</div>";
	}
}
//End of user registration page 1 sql commands
?>

<html>
<!DOCTYPE html>
<div class="container">

	<div class="form-horizontal" id="centerbox">
		Registration Progress
	</div>
	
	<div class="progress">
		<div class="progress-bar progress-bar-striped" role="progressbar" 
			aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
		</div>
	</div>
	
    <form  class="form-horizontal" action="" method="post">
        <div>
            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-4" >Required Information</label>
				
                <div class="col-sm-7"></div>
			</div>

            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Name</label>
				
                <div class="col-sm-7">
					<input type="text" name="name" size="30" id="signup_Name"/></label>
				</div>
            </div>
			
			<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Email</label>
				
				<div class="col-sm-7">
					<input type="text" name="email" size="30" id="signup_Email"/></label>
				</div>
            </div>

            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Password</label>
				
				<div class="col-sm-7">
					<input type="password" name="password" size="30" id="signup_Password"/></label>
                </div>
            </div>
			
            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Confirm password</label>
				
                <div class="col-sm-7">
					<input type="password" name="confirmpassword" size="30" id="signup_ConfirmPass"/></label>
                </div>
            </div>

            <div class="form-group" id="centerbox">
                <div class="control-label col-sm-6">
					<input class="btn btn-default" type="submit" name="submit" value="Register" id="signup_Submit"/>
                </div>
            </div>
			
        </div>
    </form>
</div>

</html>
