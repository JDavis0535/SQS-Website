<?php
/**
This file is where users can create accounts.
Accounts created on this page are automically given a ranking of "3", which is simply an account without administrative privileges (further distinctions between account rankings may be given in the future).
Only the name, email, and password information must be created to create an account.
Errors will not be introduced to this page any time soon because specific errors can currently only be associated with users who are logged in.
*/
include 'config/header.php'; //connects to database
require_once('../sql_connector.php');?>




<?php //Begining of  user registration  of page 3
// When Users add their information to the registration page 3(Hardware skills), it will add infomation to Mysql //database

if(isset($_POST["submit"])) //waits for buttons press
{		
	$url= 'user_register4.php';
	
	{
		$HardwareskillList = implode(',', $_POST['HardwareSkill']); //allows to select multiple skills in the array
		echo '<p>'.$HardwareskillList.'</p>';
		$sql = "UPDATE user SET HardwareSkill = '" .$HardwareskillList."' WHERE uid=".$_SESSION['ID'].";";
		$result = $mysqli->query($sql);
		echo "Date Success"; //Diplays
	}
	header("Location: $url"); // will take you to the next registration page

}  
//End of user registration page 3 sql commands
?>




<html>
<!DOCTYPE html>
<div class="container">

	<div class="form-horizontal" id="centerbox">
		Registration Progress
	</div>
	
	<div class="progress">
		<div class="progress-bar progress-bar-striped" role="progressbar" 
			aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
			50%
		</div>
	</div>
	
	<form  class="form-horizontal" action="" method="post">
        <div>
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-4" >Optional, may leave this page blank</label>
                <div class="col-sm-7"></div>
            </div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-2">Hardware Skills</label>
			</div>
			
			<div class="form-group" id="centerbox">
				<div class="col-sm-2">
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_ComputerAssembly" value="ComputerAssembly"/> Computer Assembly <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_ComputerMaintenence" value="computerMaintenence"/> Computer Maintenence <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_Troubleshooting" value="troubleshooting"/> Troubleshooting<br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_Printer" value="PrinterNcartageRefill"/> Printer & Cartage Refilling <br/>
					
				</div>				
				<div class="col-sm-2" >
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_OperationMonitoring" value="installingSoftwares"/> Operation Monitoring<br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_NetworkProcessing" value="networkProcessing"/> Network Processing <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_DiasterRecovery" value="disasterRecovery"/> Disaster Recovery <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_CircuitDesign" value="circuitDesignK"/> Circuit Design Knownledge<br/>
				</div>
				<div class="col-sm-3"  >

					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_Systems" value="configuringNetworking"/> Systems Analysis <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_InstallingApps" value="InstalingApp"/> Installing Applications <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_InstallingComponents" value=" componentsNDriver "/> Installing Components & Drivers <br/>
					<input type="checkbox" name="HardwareSkill[]" id="hardwareSkills_Backup" value="BackupManagement"/> Backup Management, Reporting & Recovery <br/>
				</div>
				
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Did we forget any skills?</label>
				
				<div class="col-sm-7">
					<input type="text" name="HardwareSkill[]" size="30" id="hardwareSkills_Textbox"/>
				</div>
			</div>
			
			<label class="control-label col-sm-5">(list with commas seperating)</label>
			
			<div class="form-group" id="centerbox">
				<div class="control-label col-sm-6">
					<input class="btn btn-default" type="btn" name="back" value="Back" onclick="history.back()" id="signup_Back2"/>
					<input class="btn btn-default" type="submit" name="submit" value="Next" id="signup_Next2"/>
				</div>
			</div>
			
		</div>		
    </form>
</div>

</html>