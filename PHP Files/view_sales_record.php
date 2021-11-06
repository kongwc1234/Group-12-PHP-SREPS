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
			echo "<h2>View Sales Record</h2>";
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
<script type="text/javascript">
$(document).ready(function(){
	$('#table_id').DataTable();
});
</script>
</html>
