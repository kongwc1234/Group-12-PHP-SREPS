<?php
	session_start();
	require 'mysqli_connect.php';
	$sql = "SELECT * FROM item";
	$result = mysqli_query($dbc, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
					echo "<strong style='color: red'>*Invalid item Details, please enter again.</strong>
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
			echo "<h2>View Items</h2>";
			?>

<table id="table_id" class="display">
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Desc</th>
	    <th>Price</th>
		<th>Stock</th>
		<th>Category</th>
		<th></th>
        </tr>
    </thead>
    <tbody>

<?php
foreach($rows as $row)
{
	echo "<tr>";
	echo "<td>" .$row['item_id']. "</td>";
	echo "<td>" .$row['item_name']. "</td>";
	echo "<td>" .$row['item_description']. "</td> ";
	echo "<td>" .$row['item_price']. "</td> ";
	echo "<td>" .$row['item_stock']. "</td> ";
	echo "<td>" .$row['cat_id']. "</td> ";
?>
	<td>
	<form method='post' action='edit_item.php'>
      <input type='submit' class='w3-button w3-khaki' name='edit' value='Edit' width='100%'>
      <input type='hidden' name='key' value= <?php echo $row['item_id']; ?>>
	  </form>

	<form method='post' action='delete_item_form_handler.php' onsubmit="return confirm('Do you really want to delete this item?');"><input type='submit' class='w3-button w3-red' name='delete_item' value='Delete'>
      <input type='hidden' name='key' value= <?php echo $row['item_id'];  ?>>
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
