<?php
	session_start();
	if (empty($_SESSION) || empty($_SESSION['login_user']))
	{
		header("Location: login_page.php");
	}
?>
<html>
	<head>
		<title>
			Welcome Staff Member
		</title>
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
		<?php
			echo "<h2>Welcome ".$_SESSION['login_user']."</h2>";
			?>
		<table cellpadding="5">
			<?php
				if ($_SESSION['user_type']==1){

			?>
			<tr>
				<td class="admin_func"><a href="add_item.php"><i class="fa fa-plus" aria-hidden="true"></i> Add Items</a>
				</td>
			</tr>

			<tr>
				<td class="admin_func"><a href="view_item.php"><i class="fa fa-edit" aria-hidden="true"></i> View Items</a>
				</td>
			</tr>
			<?php
			}
			?>

			<tr>
				<td class="admin_func"><a href="add_sales_record.php"><i class="fa fa-plus" aria-hidden="true"></i> Add sales record</a>
				</td>
			</tr>

			<tr>
				<td class="admin_func"><a href="view_sales_record.php"><i class="fa fa-edit" aria-hidden="true"></i> View sales record</a>
				</td>
			</tr>

			<?php
				if ($_SESSION['user_type']==1){

			?>
			<tr>
				<td class="admin_func"><a href="view_sales_report.php"><i class="fa fa-edit" aria-hidden="true"></i> View sales report</a>
				</td>
			</tr>

			<tr>
				<td class="admin_func"><a href="compare_sales_report.php"><i class="fa fa-edit" aria-hidden="true"></i> Compare sales report</a>
				</td>
			</tr>

			<tr>
				<td class="admin_func"><a href="predict_monthlysales.php"><i class="fa fa-edit" aria-hidden="true"></i> Predict Monthly Sales</a>
				</td>
			</tr>

			<tr>
				<td class="admin_func"><a href="predict_weeklysales.php"><i class="fa fa-edit" aria-hidden="true"></i> Predict Weekly Sales</a>
				</td>
			</tr>
			<?php
			}
			?>



		</table>
	</body>
</html>
