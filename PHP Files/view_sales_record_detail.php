<?php
	session_start();
	require_once('mysqli_connect.php');
	$sql = "SELECT * FROM sales_item WHERE sales_id = '".$_POST['key']."'";
    $result = mysqli_query($dbc, $sql);
	$row = mysqli_fetch_assoc($result);
?>

<html>
	<head>
		<title>
			View Sales Record
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
		<form action="edit_item_form_handler.php" method="post">
			<h2>View Sales Record</h2>
			<?php
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table">Sales ID</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" readonly="readonly" name="sales_od" value="'.$row["sales_id"].'" maxlength="5" required></td>
				</tr>
			</table>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item ID</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="item_name" value="'.$row["item_id"].'" required></td>
				</tr>
			</table>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Quantity</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="quantity" value="'.$row["quantity"].'" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Quantity Price</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="quantity_price" value="'.$row["quantity_price"].'" required></td>
				</tr>
			</table>
			
			<input type="submit" value="Submit" name="Submit">
		</form>';
		?>
	</body>
</html>
