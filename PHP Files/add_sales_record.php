<?php
	session_start();
	require_once('mysqli_connect.php');
	$sql = "SELECT * FROM category";
    $result = mysqli_query($dbc, $sql);
	$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$sql = "SELECT staff_id FROM account WHERE staff_username = '".$_SESSION['login_user']."'";	
	$result = mysqli_query($dbc, $sql);
	$row = mysqli_fetch_assoc($result);

	$sql = "SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'php-sreps' AND   TABLE_NAME   = 'sales'";
	$result = mysqli_query($dbc, $sql);
	$row2 = mysqli_fetch_assoc($result); 

?>
<html>
	<head>
		<title>
			Add items
		</title>
		<style>
			input {
    			border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 7px 30px;
			}
			input[type=submit] {
				background-color: #030337;
				color: white;
    			border-radius: 4px;
    			padding: 7px 45px;
    			margin: 0px 200px
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body>
		<img class="logo" src="logo.png"/>
		<h1 id="title">
			People Health Pharmacy
		</h1>
		<div>
			<ul style="background-color:darkblue">
				<li><a href="staff_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<form action="add_sales_record_form_handler.php" method="post">
			<h2>Enter Sales Record</h2>
			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='success')
				{
					echo "<strong style='color: green'>The sales record has been successfully added.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed')
				{
					echo "<strong style='color: red'>*Invalid item Details, please enter again.</strong>
						<br>
						<br>";
				}
			?>

			<?php
				echo '<table cellpadding="5">
                <tr>
                    <td class="fix_table">Staff ID</td>
                </tr>
                <tr>
                    <td class="fix_table"><input type="text" readonly="readonly" name="staff_id" maxlength="5" value ="'.$row['staff_id'].'" required></td>
                </tr>
            </table>';
			?>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Sales Date</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="date" name="sales_date" required></td>
				</tr>
			</table>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Sales Description</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="sales_description" required></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Submit" name="Submit">
		</form>

	</body>
</html>
