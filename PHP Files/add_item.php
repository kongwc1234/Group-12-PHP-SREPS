<?php
	session_start();
	require_once('mysqli_connect.php');
	$sql = "SELECT * FROM category";
    $result = mysqli_query($dbc, $sql);
	$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

	if (empty($_SESSION) || empty($_SESSION['login_user'])) 
	{
		header("Location: login_page.php");
	}

	if ($_SESSION['user_type']==2){
		header("Location: staff_homepage.php");
	}
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
		<form action="add_item_form_handler.php" method="post">
			<h2>Enter Items Details</h2>
			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='success')
				{
					echo "<strong style='color: green'>The item has been successfully added.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed')
				{
					echo "<strong style='color: red'>Duplicate ID, please enter again.</strong>
						<br>
						<br>";
				}
			?>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item ID</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" disabled name="item_id" maxlength="5" required></td>
				</tr>
			</table>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item Category</td>
				</tr>
				<tr>
					<td class="fix_table"><select type="text" name="cat_id" required>
						<?php
						foreach($categories as $category){
						echo "<option value = ".$category['cat_id'].">".$category['cat_name']."</option>";
						}?>
						</select>
					</td>
				</tr>
			</table>
			<br>
			<hr>

			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item Name</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="item_name" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item Description</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="item_description" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item Price</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" step="0.01" name="item_price" pattern="^\d*(\.\d{0,2})?$" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Item Stock</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" pattern="[0-9]+" name="item_stock" required></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Submit" name="Submit" style="width:10%;margin-left:auto">
		</form>

	</body>
</html>
