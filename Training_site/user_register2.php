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
//Start of code for user registration page 2 in SQL
	echo "<div class='container' id='error_success'>Account creation successful. Please continue with registration.</div>";
	
	// If the user fills out any forms this saves the information in a SESSION variable
	//	to be used to retain information on pages when refreshed.	
	if(isset($_POST['yearofbirth'])) {
		$_SESSION['yearofbirth'] = $_POST['yearofbirth'];
	}
	
	if(isset($_POST['monthofbirth'])) {
		$_SESSION['monthofbirth'] = $_POST['monthofbirth'];
	}
	
	if(isset($_POST['dayofbirth'])) {
		$_SESSION['dayofbirth'] = $_POST['dayofbirth'];
	}
	
	if(isset($_POST['phone_number'])) {
		$_SESSION['phone_number'] = $_POST['phone_number'];
	}
	
	if(isset($_POST['state'])) {
		$_SESSION['state'] = $_POST['state'];
	}
	
	if(isset($_POST['city'])) {
		$_SESSION['city'] = $_POST['city'];
	}
	
	if(isset($_POST['zip'])) {
		$_SESSION['zip'] = $_POST['zip'];
	}
	
	if(isset($_POST['streetname'])) {
		$_SESSION['streetname'] = $_POST['streetname'];
	}
	
	if(isset($_POST['streetnumber'])) {
		$_SESSION['streetnumber'] = $_POST['streetnumber'];
	}
	
if(isset($_POST['submit'])) {		//waits for buttons press
	//Add the optional information, if available
	//Add optional user information
	$url = 'user_register3.php';

	//Gender
	$sql = "UPDATE user SET gender=\"".$_POST['gender']."\" WHERE uid=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	//Date of birth
	$dateofbirth = $_POST["yearofbirth"]."-".$_POST["monthofbirth"]."-".$_POST["dayofbirth"];
	$sql = "UPDATE user SET dateofbirth='".$dateofbirth."' WHERE uid=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	//Phone information
	$sql = "INSERT INTO phone_list(user_id, phone_number, primary_phone) VALUES(".$_SESSION['ID'].", ".$_POST["phone_number"].", 1)";
	$result = $mysqli->query($sql);

	//Add optional address information
	$sql = "INSERT INTO mail_address(user_id) VALUES(".$_SESSION['ID'].")";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET state=\"".$_POST["state"]."\" WHERE user_id=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET city=\"".$_POST["city"]."\" WHERE user_id=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET zip=".$_POST["zip"]." WHERE user_id=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET street=\"".$_POST["streetname"]."\" WHERE user_id=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET street_num=".$_POST["streetnumber"]." WHERE user_id=".$_SESSION['ID'].";";
	$result = $mysqli->query($sql);
	
	header("Location: $url");
}
//End of user registration page 2 sql commands
?>

<html>
<!DOCTYPE html>
<div class="container">

	<div class="form-horizontal" id="centerbox">
		Registration Progress
	</div>
	
	<div class="progress">
		<div class="progress-bar progress-bar-striped" role="progressbar" 
			aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
			25%
		</div>
	</div>
	
    <form  class="form-horizontal" action="" method="post">
        <div>
            <div class="form-group" id="centerbox">
				<label class="control-label col-sm-4" >Optional, may leave this page blank</label>
                <div class="col-sm-7"></div>
            </div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Gender</label>
				
				<div class="col-sm-7b">
					<input type="radio" name="gender" value="Female" id="radiobtn_Female"/> Female <br/>
				</div>
				<div class="col-sm-7c">
					<input type="radio" name="gender" value="Male" id="radiobtn_Male"/> Male <br/>
				</div>
			</div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Date of birth (MM/DD/YYYY)</label>
				
				<div class="col-sm-7">
					<input type="text" name="monthofbirth" size="6" id="signup_MonthOfBirth" value="<?php echo isset($_SESSION['monthofbirth']) ? $_SESSION['monthofbirth'] : ''; ?>"/> /
					<input type="text" name="dayofbirth" size="6" id="signup_DayOfBirth" value="<?php echo isset($_SESSION['dayofbirth']) ? $_SESSION['dayofbirth'] : ''; ?>"/> /
					<input type="text" name="yearofbirth" size="6" id="signup_YearOfBirth" value="<?php echo isset($_SESSION['yearofbirth']) ? $_SESSION['yearofbirth'] : ''; ?>"/>
				</div>
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Primary phone</label>
					
				<div class="col-sm-7">
					<input type="text" name="phone_number" size="30" id="signup_PhoneNumber" value="<?php echo isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : ''; ?>"/>
				</div>
			</div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Street name</label>
				
				<div class="col-sm-7">
					<input type="text" name="streetname" size="30" id="signup_StreetName" value="<?php echo isset($_SESSION['streetname']) ? $_SESSION['streetname'] : ''; ?>"/>
				</div>
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Street number</label>
				
				<div class="col-sm-7">
					<input type="text" name="streetnumber" size="30" id="signup_StreetNumber" value="<?php echo isset($_SESSION['streetnumber']) ? $_SESSION['streetnumber'] : ''; ?>"/>
				</div>
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">City</label>
				
				<div class="col-sm-7">
					<input type="text" name="city" size="30" id="signup_City" value="<?php echo isset($_SESSION['city']) ? $_SESSION['city'] : ''; ?>"/>
				</div>
			</div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">State (two letter abbreviation)</label>
				
				<div class="col-sm-7">
					<input type="text" name="state" size="30" id="signup_State" value="<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : ''; ?>"/>
				</div>
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Zip code</label>
				
				<div class="col-sm-7">
					<input type="text" name="zip" size="30" id="signup_Zip" value="<?php echo isset($_SESSION['zip']) ? $_SESSION['zip'] : ''; ?>"/>
				</div>
			</div>

			<div class="form-group" id="centerbox">
				<div class="control-label col-sm-6">
					<input class="btn btn-default" type="submit" name="submit" value="Next" id="signup_Next1"/>
				</div>
			</div>
			
		</div>		
    </form>
</div>

</html>
