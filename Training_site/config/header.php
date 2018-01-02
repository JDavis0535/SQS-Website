
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/navbar.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

  </head>

  <body>

    <!--
      This container also has specific CSS rules defined in main.css, identified
      by the id="heading2", in addition to the base level bootstrap CSS styling.

      These rules allow the heading to properly order the multiple pieces of content
      within (all the buttons and welcom message). These items need to be ordered
      horizontally rather than vertically to all fit in the top of the page.

      When the viewport's width decreases to a point that there is not enough space
      for the heading the Bootstrap rules will reorder the content vertically.
    -->
    <div class="container" id="heading2">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
		      <li><a href="./">Home </a></li>
              <?php
                if(isset($_SESSION['priv'])){
                    echo '<li> <a href = "profile.php" id="link_viewProfile">  View Profile </a></li> ';
		                echo '<li> <a href = "groups.php" id="link_Groups">  Groups </a></li> ';

                    if($_SESSION['level'] == '5'){
                        //Administrator pages
			echo '<li> <a href ="admin_user_info.php" id="link_Admin">  Admin Page </a></li>';
                    }
		    else if($_SESSION['level'] == '4')
		    {
			//Superuser pages
			echo '<li> <a href="superuser_user_info.php" id="link_Super"> Superuser Page </a> </li>';
		    }
                    echo '<li> <a href = "log_out.php" id="link_Logout">  Log out </a></li> ';
                }
                else{
                    echo '<li> <a href = "user_login.php" id="link_Signin">  Sign in </a></li> ';
                    echo '<li> <a href = "user_register.php" id="link_Singup">  Sign up </a></li>';
                }
                ?>

              </li>
            </ul>


            <ul class="nav navbar-nav navbar-right" >
              <div style="display:flex;justify-content:flex-end;align-items:center">
            
            <?php 

              require_once('../sql_connector.php');


              if(isset($_SESSION['name'])) { 


                echo "<div class='col-sm-4'> <li> Hello ". $_SESSION['name']."</li></div> <br>"; 

                $UID = $_SESSION['user'];

            //Check Display name
                $query = "select Name, Email,SoftwareSkills,HardwareSkill, level from user where UID = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("s",$UID);
                $stmt->execute();
                $stmt->bind_result($name, $email,$SoftwareSkills,$HardwareSkill, $level);
                $stmt->fetch();
                $stmt->close();

                //echo $name, $email, $level;
                    
            //Check address information
                $state = "N/A";
                $city = "N/A";
                $zip = "N/A";
                $state = "N/A";
                $street_num = "N/A";
                $street = "N/A";
                $query = "select state, city, zip, street, street_num from mail_address where user_id = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("s",$UID);
                $stmt->execute();
                $stmt->bind_result($state, $city, $zip, $street, $street_num);
                $stmt->fetch();
                $stmt->close();

                $phone_numbers = [];
                $phone_number_ids = [];
                $group_ids = [];
                $number_of_phones = 0;
                $UID = $_SESSION["user"];
                $sql1 = "SELECT * FROM phone_list WHERE user_id=".$UID.";";
                $result1 = $mysqli->query($sql1);
                if($result1->num_rows > 0){
                  $number_of_phones = $result1->num_rows;
                  while($row = $result1->fetch_assoc()){
                    array_push($phone_numbers, $row["phone_number"]);
                    array_push($phone_number_ids, $row["id"]);
                  }
                }
                


                $i_val = 0;
                if (isset($name))  $i_val+=1;  
                if (isset($SoftwareSkills)) $i_val+=1;
                if (isset($HardwareSkill)) $i_val+=1;
                if (isset($level))  $i_val+=1;
                if (isset($state)) $i_val+=1;
                if (isset($city)) $i_val +=1;
                if (isset($zip)) $i_val += 1;
                if (isset($street)) $i_val +=1;
                if (isset($street_num)) $i_val +=1;
                if (isset($phone_numbers[0])) $i_val +=1;

                $i_val = (($i_val/10)*100);

                echo "Profile ". $i_val . "%  completed";

                
    }
              
?>

              
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      

      var complete = <?php echo $i_val ?>;
      var incomplete =  100 - complete;
      if ( complete != undefined ){
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
      }


      function drawChart() {


        var data = google.visualization.arrayToDataTable([
          ['Effort', 'Amount given'],
          ['Complete', complete],
          ['Incomplete', incomplete]
        ]);

        var options = {
          pieHole: 0.6,
          legend: 'none',
          pieSliceTextStyle: {  color: 'white', fontName: 'tahoma', fontSize: '17' },
          pieStartAngle: 360,
          backgroundColor: '#253640',
          // backgroundColor.stroke: '#253640',
          chartArea:{left:0,top:0,width:'90%',height:'90%'},
          forceIFrame: true,
          pieSliceBorderColor: '#253640',
          fontSize: 12,
          slices: {
            0: { color: 'yellow'  },
            1: { color: 'transparent', textStyle: { color: '#253640'} }
          },
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
        chart.draw(data, options);
      }


    </script>
  
    <div id="donut_single" style="width: 125px; height: 125px;"></div>
  



              <li ><a href="./"> <img src="assets/images/logo.png" alt="SQS logo"></a></li>
            </div>
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
