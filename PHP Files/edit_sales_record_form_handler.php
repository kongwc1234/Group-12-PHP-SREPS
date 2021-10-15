<?php
	session_start();
?>
<html>
	<head>
		<title>Add Item</title>
	</head>
	<body>
		<?php
		$temp=0;
			if(isset($_POST['Submit']))
			{
				$data_missing=array();
				if(empty($_POST['sales_id']))
				{
					$data_missing[]='Sales ID';
				}
				else
				{
					$sales_id=trim($_POST['sales_id']);
				}
				if(empty($_POST['sales_date']))
				{
					$data_missing[]='Sales Date';
				}
				else
				{
					$sales_date=trim($_POST['sales_date']);
				}

				if(empty($_POST['sales_description']))
				{
					$data_missing[]='Sales Description';
				}
				else
				{
					$sales_description=trim($_POST['sales_description']);
				}



				if(empty($data_missing))
				{
					$cnt=1;
					require_once('mysqli_connect.php');

					if($cnt==1)
					{
						$query="UPDATE `sales` SET sales_date = '$sales_date', sales_description = '$sales_description' WHERE sales_id = '$sales_id'";
						if (mysqli_query($dbc,$query))
						{
							$affected_rows=1;
							$quantity = $_POST['quantity'];
                       
                            foreach($quantity as $key=>$keyvalue){
							$sql = "SELECT * FROM item WHERE item_id = '$key'";
							$result = mysqli_query($dbc, $sql);
							$item = mysqli_fetch_assoc($result);
							$sql = "SELECT * FROM sales_item WHERE sales_id = '$sales_id' AND item_id = '$key'";
							$result = mysqli_query($dbc, $sql);
							$salesitem = mysqli_fetch_assoc($result);
							
							if(is_null($salesitem) && $keyvalue != 0){
								$difference = 0 - $keyvalue;
								$sql = "INSERT INTO sales_item(sales_id, item_id, quantity, quantity_price) VALUES('$sales_id', '$key', '$keyvalue', '$keyvalue' * '$item[item_price]')";
								$result = mysqli_query($dbc, $sql);
								$sql = "SELECT * FROM sales_item WHERE sales_id = '$sales_id' AND item_id = '$key'";
								$result = mysqli_query($dbc, $sql);
								$salesitem = mysqli_fetch_assoc($result);
								$sql2="UPDATE item SET item_stock=item_stock + '$difference' WHERE item_id='$key'";
								$result2=mysqli_query($dbc,$sql2);
							}
							else if(!is_null($salesitem) && $keyvalue == 0){
								$difference = $salesitem['quantity'] - $keyvalue;
								$sql2="UPDATE item SET item_stock=item_stock + '$difference' WHERE item_id='$key'";
								$result2=mysqli_query($dbc,$sql2);
								$sql = "DELETE from sales_item WHERE sales_id='$sales_id' AND item_id = '$key'";
								$result = mysqli_query($dbc, $sql);
								continue;
							}
							else{
							$difference = $salesitem['quantity'] - $keyvalue;
							$sql = "UPDATE `sales_item` SET quantity = '$keyvalue', quantity_price = '$keyvalue' * '$item[item_price]' WHERE sales_id = '$sales_id' AND item_id = '$key'";
							$result = mysqli_query($dbc,$sql);
							$sql2="UPDATE item SET item_stock=item_stock + '$difference' WHERE item_id='$key'";
							$result2=mysqli_query($dbc,$sql2);
							}
                            }
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
						echo "Successfully Submitted";
						header("location:view_sales_record.php?msg=success");
					}
					else{
						echo "Submit Error";
						echo mysqli_error();
						header("location: view_sales_record.php?msg=failed");
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
				echo "Submit request not received";
			}
		?>
	</body>
</html>