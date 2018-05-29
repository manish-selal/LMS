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

$sql = mysql_query("SELECT * FROM leaves");
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Approved Leaves</title>
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
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<br>
	<h1>Approved Leaves By Sr. Director</h1>
<br>
	<table id="myTable" class="data-table">
		<thead>
			<tr class="header">
				<th>SNo</th>
				<th>User Name</th>
				<th>User Id</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Leave Type</th>
				<th>Duration</th>
				<th>From Date</th>
				<th>To Date</th>
				<th>Days</th>
				<th>Status</th>
				<th>Action</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($row = mysql_fetch_array($sql))
			{   
				if ($row['Status']=="Approved")
				{
				{
					echo '
					<tr>
				    <td>'.$no.'</td>
				    <td>'.$row['User_Name'].'</td>
				    <td>'.$row['User_Id'].'</td>
				    <td>'.$row['Department'].'</td>
				    <td>'.$row['Designation'].'</td>
				    <td>'.$row['Leave_Type'].'</td>
				    <td>'.$row['Duration'].'</td>
				    <td>'.$row['From_Date'].'</td>
				    <td>'.$row['To_Date'].'</td>
				    <td>'.$row['Days'].'</td>
				    <td>'.$row['Status'].'</td>
				    <td><button name="name" style="background-color:#f55858; border:1px solid black;" value="Reject '.$row['User_Id'].' '.$row['U_Id'].' '.$row['Leave_Type'].' '.$row['Days'].'" '.$row['Status'].' onclick="do_reject(this.value)">Cancel</button></td>
				    </tr>';
					}
				$no++;
			}
			}
			?>
				
		</tbody>
	</table>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>

<script type="text/javascript">
	function do_reject(r1) {
		var words = r1.split(" ");
		var decision = words[0];
		var id = words[1];
		var uid = words[2];
		var type = words[3];
		var days = words[4];
		var status = words[5];
		window.location.href = "Approved_Leaves_Cancel.php?decision=" + decision +"&id=" + id +"&uid=" + uid +"&type=" + type +"&days=" + days +"&status=" +status;
	}
</script>
</body>
	</html>