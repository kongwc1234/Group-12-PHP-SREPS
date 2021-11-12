<?php
	session_start();
	require 'mysqli_connect.php';
	$sql = "SELECT * FROM item";
	$result = mysqli_query($dbc, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

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
				if(isset($_GET['msg']) && $_GET['msg']=='success_delete')
				{
					echo "<strong style='color: green'>The item has been successfully deleted.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed_delete')
				{
					echo "<strong style='color: red'>*Unable to delete item. Item is in sales record.</strong>
						<br>
						<br>";
				}

				if(isset($_GET['msg']) && $_GET['msg']=='success_edit')
				{
					echo "<strong style='color: green'>The item has been successfully edited.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed_edit')
				{
					echo "<strong style='color: red'>*Invalid item Details, please enter again.</strong>
						<br>
						<br>";
				}
			?>
		<?php
			echo "<h2>Predict Monthly Sales</h2>";
			?>

<table id="table_id" class="display">
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>4 Months Ago</th>
        <th>3 Months Ago</th>
	    <th>2 Months Ago</th>
		<th>1 Month Ago</th>
		<th>This Month</th>
    <th>Following Month</th>
        </tr>
    </thead>
    <tbody>

<?php
foreach($rows as $row)
{
  $sql = "SELECT IFNULL(sum(quantity_price), 0) AS Total_Price FROM sales_item NATURAL JOIN sales WHERE item_id = '".$row["item_id"]."' AND month(sales_date) = month(DATE_SUB(curdate(), INTERVAL 1 MONTH))";
  $result = mysqli_query($dbc, $sql);
	$month1 = mysqli_fetch_assoc($result);
  $sql = "SELECT IFNULL(sum(quantity_price), 0) AS Total_Price FROM sales_item NATURAL JOIN sales WHERE item_id = '".$row["item_id"]."' AND month(sales_date) = month(DATE_SUB(curdate(), INTERVAL 2 MONTH))";
  $result = mysqli_query($dbc, $sql);
	$month2 = mysqli_fetch_assoc($result);
  $sql = "SELECT IFNULL(sum(quantity_price), 0) AS Total_Price FROM sales_item NATURAL JOIN sales WHERE item_id = '".$row["item_id"]."' AND month(sales_date) = month(DATE_SUB(curdate(), INTERVAL 3 MONTH))";
  $result = mysqli_query($dbc, $sql);
	$month3 = mysqli_fetch_assoc($result);
  $sql = "SELECT IFNULL(sum(quantity_price), 0) AS Total_Price FROM sales_item NATURAL JOIN sales WHERE item_id = '".$row["item_id"]."' AND month(sales_date) = month(DATE_SUB(curdate(), INTERVAL 4 MONTH))";
  $result = mysqli_query($dbc, $sql);
	$month4 = mysqli_fetch_assoc($result);
  $sql = "SELECT IFNULL(sum(quantity_price), 0) AS Total_Price FROM sales_item NATURAL JOIN sales WHERE item_id = '".$row["item_id"]."' AND month(sales_date) = month(curdate())";
  $result = mysqli_query($dbc, $sql);
  $currentmonth = mysqli_fetch_assoc($result);
  echo "<tr>";
	echo "<td>" .$row['item_id']. "</td>";
	echo "<td>" .$row['item_name']. "</td>";
	echo "<td>" .$month4['Total_Price']. "</td> ";
	echo "<td>" .$month3['Total_Price']. "</td> ";
	echo "<td>" .$month2['Total_Price']. "</td> ";
	echo "<td>" .$month1['Total_Price']. "</td> ";
  echo "<td>" .$currentmonth['Total_Price']. "</td> ";
  $avg = ($month4['Total_Price'] + $month3['Total_Price'] + $month2['Total_Price'] + $month1['Total_Price'] + $currentmonth['Total_Price']) / 5;
  echo "<td>" .$avg. "</td> ";
?>
	</tr>
<?php
}
?>

</tbody>
</table>
<script type="text/javascript">
$(document).ready(function(){
	$('#table_id').DataTable();
});
</script>
</html>
