<?php
/**
This file is where users can create accounts.
Accounts created on this page are automically given a ranking of "3", which is simply an account without administrative privileges (further distinctions between account rankings may be given in the future).
Only the name, email, and password information must be created to create an account.
Errors will not be introduced to this page any time soon because specific errors can currently only be associated with users who are logged in.
*/
include 'config/header.php'; //connects to database
require_once('../sql_connector.php');?>


<?php // the last page of the registration page
if(isset($_POST["submit"])) //waits for buttons press
{		
	$url= 'index.php'; // transfer to the file after sumbit
	// When Users add their information to the registration page 4(Software Skills), it will add infomations to 
	 // Mysqldatabase
	
	{
		$SoftwareSkil = implode(',', $_POST['SoftwareSkill']);//allows to select multiple skills in the array
		echo '<p>'.$SoftwareSkil.'</p>';
		$sql = "UPDATE user SET SoftwareSkills = '" .$SoftwareSkil."' WHERE uid=".$_SESSION['ID'].";";
		$result = $mysqli->query($sql);
		echo "Date Success"; // displays	
	}
	header("Location: $url"); // will take you to url

}  
//End of user registration page 4 sql commands
?>


<html>
<!DOCTYPE html>
<div class="container">

	<div class="form-horizontal" id="centerbox">
		Registration Progress
	</div>
	
	<div class="progress">
		<div class="progress-bar progress-bar-striped" role="progressbar" 
			aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%">
			75%
		</div>
	</div>
	
	<form  class="form-horizontal" action="" method="post">
        <div>
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-4" >Optional, may leave this page blank</label>
                <div class="col-sm-7"></div>
            </div>

			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-2">Software Skills</label>
			</div>
			
			<div class="form-group" id="centerbox">
				<div class="col-sm-2">
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_C" value="C"/> C <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Java" value="Java"/> Java <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_PHP" value="PHP"/> PHP <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Perl" value="Perl"/> Perl <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Python" value="Python"/> Python <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Ruby" value="Ruby"/> Ruby <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Graphics" value="Graphics"/> Graphics <br/>
				</div>
				<div class="col-sm-2">
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_C#" value="C#"/> C# <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_JavaScript" value="JavaScript"/> JavaScript <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_SQL" value="SQL"/> SQL <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Net" value=".Net"/> .Net <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_VB" value="Visual Basic"/> Visual Basic <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Prolog" value="Prolog"/> Prolog <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Animation" value="Animation"/> Animation <br/>
				</div>
				<div class="col-sm-2">
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_C++" value="C++"/> C++ <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_R" value="R"/> R <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Swift" value="Swift"/> Swift<br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Assembly" value="Assembly"/> Assembly <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Pascal" value="Pascal"/> Pascal <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Go" value="Go"/> Go <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_WebDesign" value="Web Design/HTML"/> Web Design/HTML <br/>
				</div>
				<div class="col-sm-2">
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_CSS" value="CSS"/> CSS <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_ObjC" value="Obective-C"/> Objective-C <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Shell" value="Shell"/> Shell <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_MATLAB" value="MATLAB"/> MATLAB <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_SAS" value="SAS"/> SAS <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Scratch" value="Scratch"/> Scratch <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Cloud" value="Cloud Computing"/> Cloud Computing <br/>
				</div>
				<div class="col-sm-2">
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_MSoffice" value="Microsoft Office"/> Microsoft Office <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Enterprise" value="Enterprise Systems"/> Enterprise Systems <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Android" value="Android"/> Android <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_iOS" value="iOS/Mac OS X"/> iOS/Mac OS X <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Windows" value="Windows"/> Windows <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Linux" value="Linux"/> Linux <br/>
					<input type="checkbox" name="SoftwareSkill[]" id="softwareSkills_Client/Server" value="Client/Server"/> Client/Server <br/>
				</div>
			</div>
			
			<div class="form-group" id="centerbox">
				<label class="control-label col-sm-5">Did we forget any skills?</label>
				
				<div class="col-sm-7">
					<input type="text" name="SoftwareSkill[]" size="30" id="softwareSkills_Textbox"/>
				</div>
			</div>
			
			<label class="control-label col-sm-5">(list with commas seperating)</label>
			
			<div class="form-group" id="centerbox">
				<div class="control-label col-sm-6">
					<input class="btn btn-default" type="btn" name="back" value="Back" onclick="history.back()" id="signup_Back3"/>
					<input class="btn btn-default" type="submit" name="submit" value="Submit" id="signup_Next3"/>
				</div>
			</div>
			
		</div>		
    </form>
</div>

</html>

