<?php
session_start();
?>

<?php
$loggedinuser = $_SESSION["userid"];
?>

<?php 
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql = mysql_query("SELECT * FROM leaves WHERE User_Id = $loggedinuser");
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Admin Requested Leaves</title>
	<link rel="stylesheet" type="text/css" href="Requested_Leaves.css">
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
	<ul id = "menu">
		<li><a href="Admin_Dashboard.php">Home</a></li>
		<li><a class="drop">Admin</a>
			<div class="dropdown_Admin">
				<div class="col_1">
					<p><a href="List_Users.php">Users</a></p>
                </div>
                <div class="col_2">
                    <p><a href="Create.html">Create</a></p>
                </div>
                <div class="col_3">
                    <p><a href="Leave_Balance.php">Leave Balance</a></p>
                </div>
			</div>
		</li>
    	<li><a class="drop">HR Admin</a>
    		<div class="dropdown_HR_Admin">
				<div class="col_1">
					<p><a href="#">Link1</a></p>
                </div>
                <div class="col_2">
                    <p><a href="#">Link2</a></p>
                </div>
                <div class="col_3">
                    <p><a href="#">Link3</a></p>
                </div>    			
        </li>
        <li><a href="Requested_Leaves.php">Approved Leaves</a></li>
        <li><a href="Admin_My_Leaves.php">My Leaves</a></li>
		<li><a href="https://www.india.gov.in/calendar" target="Blank">Calendar</a></li>
		<li><a href="Admin_Request_Leave.php">Request Leave</a></li>
		<li class="menu_right"><a href="Sign_Out.php">Sign Out</a></li>
	</ul>
<br>
	<h1>Admin Requested Leaves</h1>
<br>
	<table class="data-table">
		<thead>
			<tr>
				<th>SNo</th>
				<th>User Name</th>
				<th>User Id</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Leave Type</th>
				<th>From Date</th>
				<th>To Date</th>
				<th>Days</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($row = mysql_fetch_array($sql))
			{
				echo '
				<tr>
				<td>'.$no.'</td>
				<td>'.$row['User_Name'].'</td>
				<td>'.$row['User_Id'].'</td>
				<td>'.$row['Department'].'</td>
				<td>'.$row['Designation'].'</td>
				<td>'.$row['Leave_Type'].'</td>
				<td>'.$row['From_Date'].'</td>
				<td>'.$row['To_Date'].'</td>
				<td>'.$row['Days'].'</td>
				<td>'.$row['Status'].'</td>
				</tr>';
				$no++;
			}
			?>
				
			</tbody>
		</table>
	</body>
</html>