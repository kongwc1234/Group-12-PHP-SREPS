<?php
	session_start();
	require_once('mysqli_connect.php');
	$sql = "SELECT * FROM sales_item WHERE sales_id = '".$_POST['key']."'";
    $result = mysqli_query($dbc, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "SELECT * FROM sales NATURAL JOIN staff WHERE sales_id = '".$_POST['key']."'";
	$result = mysqli_query($dbc, $sql);
	$row2 = mysqli_fetch_assoc($result);
	$sql = "SELECT * FROM sales_item NATURAL JOIN item WHERE sales_id = '".$_POST['key']."'";
    $result = mysqli_query($dbc, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	if (empty($_SESSION) || empty($_SESSION['login_user'])) 
	{
		header("Location: login_page.php");
	}
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
			<h2>View Sales Record</h2>

			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='success_delete')
				{
					echo "<strong style='color: green'>The sales record has been successfully deleted.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed_delete')
				{
					echo "<strong style='color: red'>*Invalid sales record Details, please enter again.</strong>
						<br>
						<br>";
				}

				if(isset($_GET['msg']) && $_GET['msg']=='success_edit')
				{
					echo "<strong style='color: green'>The sales record has been successfully edited.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed_edit')
				{
					echo "<strong style='color: red'>*Invalid sales record Details, please enter again.</strong>
						<br>
						<br>";
				}
			?>

			<?php
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table">Sales ID</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" readonly="readonly" name="sales_id" value="'.$row2["sales_id"].'" maxlength="5" required></td>
				</tr>
			</table>
			<br>
			<hr>
			
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Added by:</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" readonly="readonly" name="staff_id" value="'.$row2["staff_fname"].' '.$row2["staff_lname"].' ('.$row2["staff_id"].')" maxlength="5" required>
					</td>
				</tr>
			</table>
			<br>
			<hr>
			
			<table cellpadding="5">
			<tr>
					<td class="fix_table">Sales Date</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" readonly="readonly" name="sales_date" value="'.$row2["sales_date"].'" maxlength="5" required></td>
				</tr>
			</table>
			<br>
			<hr>
			
			<table cellpadding="5">
			<tr>
					<td class="fix_table">Sales Description</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" readonly="readonly" name="sales_description" value="'.$row2["sales_description"].'" maxlength="5" required></td>
				</tr>
			</table>
			<br>
			<hr>
			
			<td class = "fix_table"><h2>Item Quantity &emsp; &ensp; Item Quantity Price</h2>';
			
			foreach($rows as $row3){
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>'.$row3["item_name"].' (ID '.$row3["item_id"].')</b></td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" readonly="readonly" pattern="[0-9]*" min="0" max="'.$row3["item_stock"].'" style="width:78%" name="quantity['.$row3["item_id"].']" value="'.$row3["quantity"].'"></td>
							      <input type="hidden" name="itemid[]" value="'.$row3["item_id"].'">
								  <td class="fix_table">'.$row3["quantity_price"].'</td>
				</tr>
			</table>
			<br>
					<td class = "fix_table">  &nbsp RM'.$row3["item_price"].' Each </td>
			<br>
			<br>
			<hr>';
			}
			$sql = "SELECT SUM(quantity_price) AS total_price FROM sales_item WHERE sales_id = '".$_POST['key']."'";
			$result = mysqli_query($dbc, $sql);
			$total_price = mysqli_fetch_assoc($result);
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>Total Price</b></td>
					<td class="fix_table">'.$total_price["total_price"].'</td>
				</tr>
			</table>';
		?>
		<br>
		<br>

		  <?php 
				if ($_SESSION['user_type']==1){
					
		?>
		<form method='post' action='edit_sales_record.php'>
      <input type='submit' name='edit' value='Edit' style="width:10%;margin-left:auto">
      <input type='hidden' name='key' value= <?php echo $row2['sales_id']; ?>>
	  </form>

	
	<form method='post' action='delete_sales_record_form_handler.php' onsubmit="return confirm('Do you really want to delete this sales record?');"><input type='submit' name='delete_sales_record' value='Delete' style="width:10%;margin-left:auto">
      <input type='hidden' name='key' value= <?php echo $row2['sales_id'];  ?>>
    </form>
	<?php
	}
	?>
		<form method='post' action='view_sales_record.php'>
      <input type='submit' class='w3-button w3-khaki' name='view' value='Back' style="width:10%;margin-left:auto">
	</body>
</html>
