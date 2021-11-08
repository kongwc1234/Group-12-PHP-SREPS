<?php
	session_start();
	require 'mysqli_connect.php';
	$sql = "SELECT * FROM sales";
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
					echo "<strong style='color: green'>Sales record has been successfully deleted.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed_delete')
				{
					echo "<strong style='color: red'>*Invalid sales record detail, please enter again.</strong>
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
			
			echo "<h2>Compare Sales Report</h2>";
			?>
			<form action=""  method="post">
				<tr>
					<td>Left Sales Report</td>
					<br>
					<td class="fix_table"><input type="date" name="start_date" required></td>
					<td>To</td>
					<td class="fix_table"><input type="date" name="end_date" required></td>
					
				</tr>
				<br>
				<br>
				<tr>
					<td>Right Sales Report</td>
					<br>
					<td class="fix_table"><input type="date" name="start_date2" required></td>
					<td>To</td>
					<td class="fix_table"><input type="date" name="end_date2" required></td>

					<input type='submit' class='w3-button w3-khaki' name='submit_dates' value='Submit' width='100%'>
				</tr>

			</form>
			<br>
			<hr>
			<div class="verticalLine">
			</div>


			<div style="float:left ;width:49%" >
		


			<?php
			if (isset($_POST['submit_dates']))
			{
			?>
				<table id="table_id" class="display">
	
    <thead>
        <tr>
        <th>Sales ID</th>
        <th>Staff ID</th>
        <th>Sales Date</th>
	    <th>Sales Description</th>
		<th></th>
        </tr>
    </thead>
    <tbody>
	<?php
		$sql = "SELECT * FROM sales WHERE sales_date>='".$_POST['start_date']."' and sales_date<='".$_POST['end_date']."'";
		$result = mysqli_query($dbc, $sql);
		$rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	?>
	<?php
foreach($rows2 as $row)
{
	echo "<tr>";
	echo "<td>" .$row['sales_id']. "</td>";
	echo "<td>" .$row['staff_id']. "</td>";
	echo "<td>" .$row['sales_date']. "</td> ";
	echo "<td>" .$row['sales_description']. "</td> ";
?>
	<td>
	<form method='post' action='view_sales_record_detail.php'>
      <input type='submit' class='w3-button w3-khaki' name='view' value='View' width='100%'>
      <input type='hidden' name='key' value= <?php echo $row['sales_id']; ?>>
	  </form>

	</td>
	</tr>
<?php
}
?>

</tbody>
</table>
<?php
	echo '<td class = "fix_table"><h2>Item Quantity &emsp; &ensp; Item Quantity Price</h2>';
			$sql ="SELECT item_id, item_name,item_price, SUM(quantity) as quantity_sold , SUM(quantity_price) AS total_sold FROM item NATURAL JOIN sales_item NATURAL JOIN sales WHERE sales_date>='".$_POST['start_date']."' and sales_date<='".$_POST['end_date']."' GROUP BY item_id, item_name,item_price";
			$result = mysqli_query($dbc, $sql);
			$rows3 = mysqli_fetch_all($result,MYSQLI_ASSOC);
			foreach($rows3 as $row3){
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>'.$row3["item_name"].' (ID '.$row3["item_id"].')</b></td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" readonly="readonly" pattern="[0-9]*" style="width:78%" name="quantity['.$row3["item_id"].']" value="'.$row3["quantity_sold"].'"></td>
								  <td class="fix_table">'.$row3["total_sold"].'</td>
				</tr>
			</table>
			<br>
					<td class = "fix_table">  &nbsp RM'.$row3["item_price"].' Each </td>
			<br>
			<br>
			<hr>';
			}
			$sql = "SELECT SUM(quantity_price) AS total_price FROM sales_item NATURAL JOIN sales WHERE sales_date>='".$_POST['start_date']."' and sales_date<='".$_POST['end_date']."'";
			$result = mysqli_query($dbc, $sql);
			$total_price = mysqli_fetch_assoc($result);
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>Total Price</b></td>
					<td class="fix_table">'.$total_price["total_price"].'</td>
				</tr>
			</table>';
	?>
			<?php
			}else
			{
			?><table id="table_id" class="display">
	
    <thead>
        <tr>
        <th>Sales ID</th>
        <th>Staff ID</th>
        <th>Sales Date</th>
	    <th>Sales Description</th>
		<th></th>
        </tr>
    </thead>
    <tbody>
	
<?php
foreach($rows as $row)
{
	echo "<tr>";
	echo "<td>" .$row['sales_id']. "</td>";
	echo "<td>" .$row['staff_id']. "</td>";
	echo "<td>" .$row['sales_date']. "</td> ";
	echo "<td>" .$row['sales_description']. "</td> ";
?>
	<td>
	<form method='post' action='view_sales_record_detail.php'>
      <input type='submit' class='w3-button w3-khaki' name='view' value='View' width='100%'>
      <input type='hidden' name='key' value= <?php echo $row['sales_id']; ?>>
	  </form>

	</td>
	</tr>
<?php
}
?>

</tbody>
</table>
<?php
			}
			?>
			  </div>
</div>

<div style="float:right ;width:49%" >
		


			<?php
			if (isset($_POST['submit_dates']))
			{
			?>
				<table id="table2_id" class="display">
	
    <thead>
        <tr>
        <th>Sales ID</th>
        <th>Staff ID</th>
        <th>Sales Date</th>
	    <th>Sales Description</th>
		<th></th>
        </tr>
    </thead>
    <tbody>
	<?php
		$sql = "SELECT * FROM sales WHERE sales_date>='".$_POST['start_date2']."' and sales_date<='".$_POST['end_date2']."'";
		$result = mysqli_query($dbc, $sql);
		$rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	?>
	<?php
foreach($rows2 as $row)
{
	echo "<tr>";
	echo "<td>" .$row['sales_id']. "</td>";
	echo "<td>" .$row['staff_id']. "</td>";
	echo "<td>" .$row['sales_date']. "</td> ";
	echo "<td>" .$row['sales_description']. "</td> ";
?>
	<td>
	<form method='post' action='view_sales_record_detail.php'>
      <input type='submit' class='w3-button w3-khaki' name='view' value='View' width='100%'>
      <input type='hidden' name='key' value= <?php echo $row['sales_id']; ?>>
	  </form>

	</td>
	</tr>
<?php
}
?>

</tbody>
</table>
<?php
	echo '<td class = "fix_table"><h2>Item Quantity &emsp; &ensp; Item Quantity Price</h2>';
			$sql ="SELECT item_id, item_name,item_price, SUM(quantity) as quantity_sold , SUM(quantity_price) AS total_sold FROM item NATURAL JOIN sales_item NATURAL JOIN sales WHERE sales_date>='".$_POST['start_date2']."' and sales_date<='".$_POST['end_date2']."' GROUP BY item_id, item_name,item_price";
			$result = mysqli_query($dbc, $sql);
			$rows3 = mysqli_fetch_all($result,MYSQLI_ASSOC);
			foreach($rows3 as $row3){
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>'.$row3["item_name"].' (ID '.$row3["item_id"].')</b></td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" readonly="readonly" pattern="[0-9]*" style="width:78%" name="quantity['.$row3["item_id"].']" value="'.$row3["quantity_sold"].'"></td>
								  <td class="fix_table">'.$row3["total_sold"].'</td>
				</tr>
			</table>
			<br>
					<td class = "fix_table">  &nbsp RM'.$row3["item_price"].' Each </td>
			<br>
			<br>
			<hr>';
			}
			$sql = "SELECT SUM(quantity_price) AS total_price FROM sales_item NATURAL JOIN sales WHERE sales_date>='".$_POST['start_date2']."' and sales_date<='".$_POST['end_date2']."'";
			$result = mysqli_query($dbc, $sql);
			$total_price = mysqli_fetch_assoc($result);
			echo '<table cellpadding="5">
				<tr>
					<td class="fix_table"><b>Total Price</b></td>
					<td class="fix_table">'.$total_price["total_price"].'</td>
				</tr>
			</table>';
	?>
			<?php
			}else
			{
			?><table id="table2_id" class="display">
	
    <thead>
        <tr>
        <th>Sales ID</th>
        <th>Staff ID</th>
        <th>Sales Date</th>
	    <th>Sales Description</th>
		<th></th>
        </tr>
    </thead>
    <tbody>
	
<?php
foreach($rows as $row)
{
	echo "<tr>";
	echo "<td>" .$row['sales_id']. "</td>";
	echo "<td>" .$row['staff_id']. "</td>";
	echo "<td>" .$row['sales_date']. "</td> ";
	echo "<td>" .$row['sales_description']. "</td> ";
?>
	<td>
	<form method='post' action='view_sales_record_detail.php'>
      <input type='submit' class='w3-button w3-khaki' name='view' value='View' width='100%'>
      <input type='hidden' name='key' value= <?php echo $row['sales_id']; ?>>
	  </form>

	</td>
	</tr>
<?php
}
?>

</tbody>
</table>
<?php
			}
			?>
			  </div>
</div>
</body>


<script type="text/javascript">
$(document).ready(function(){
	$('#table_id').DataTable();
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#table2_id').DataTable();
});
</script>
</html>
