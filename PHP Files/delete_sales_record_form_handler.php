<?php
	session_start();
	require_once('mysqli_connect.php');
	$sql = "SELECT * FROM sales_item WHERE sales_id = '".$_POST['key']."'";
    $result = mysqli_query($dbc, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html>
	<head>
		<title>Delete sales record</title>
	</head>
	<body>
		<?php
			if(isset($_POST['delete_sales_record']))
			{
				$data_missing=array();
				if(empty($_POST['key']))
				{
					$data_missing[]='Sales ID';
				}
				else
				{
					$sales_id=trim($_POST['key']);
				}

				if(empty($data_missing))
				{
					$cnt=1;
					if($cnt==1)
					{	
						foreach($rows as $row)
						{
							$sql="SELECT * FROM item WHERE item_id='".$row['item_id']."'";
							$result=mysqli_query($dbc,$sql);
							$item=mysqli_fetch_assoc($result);
							$sql2="UPDATE item SET item_stock=item_stock + '".$row['quantity']."' WHERE item_id='".$row['item_id']."'";
							$result2=mysqli_query($dbc,$sql2);						
						}
						
						$i=$_POST["key"];  
						$query="DELETE from sales_item WHERE sales_id='$i'";
						$query2="DELETE from sales WHERE sales_id='$i'";
					

						if (mysqli_query($dbc,$query))
						{
							$affected_rows=1;
						}
						else{
							$affected_rows=0;
						}
						
						if (mysqli_query($dbc,$query2))
						{
							$affected_rows=1;
							
						}
						else{
							$affected_rows=0;
						}	
					
					}
					else
					{
						$affected_rows=0;
					}
					mysqli_close($dbc);
	
					if($affected_rows==1)
					{
						echo "Successfully Deleted";
						header("location: view_sales_record.php?msg=success_delete");
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
						header("location: view_sales_record.php?msg=failed_delete");

					}
				}
				else
				{
					echo "The following data fields were empty! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Delete request not received";
			}
		?>
	</body>
</html>