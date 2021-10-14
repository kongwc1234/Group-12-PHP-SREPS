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

				if(empty($_POST['staff_id']))
				{
					$data_missing[]='Staff ID';
				}
				else
				{
					$staff_id=trim($_POST['staff_id']);
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
						$query="INSERT INTO sales (staff_id, sales_date, sales_description) VALUES ('$staff_id','$sales_date','$sales_description')";
						if (mysqli_query($dbc,$query))
						{
							$affected_rows=1;
							$quantity = $_POST['quantity'];
                            $sql = "SELECT MAX(sales_id) AS sales_id FROM sales";
                            $result = mysqli_query($dbc, $sql);
                            $row = mysqli_fetch_assoc($result);
                            foreach($quantity as $key=>$keyvalue){
				if($keyvalue == 0){
				continue;
}
				$sql = "SELECT * FROM item WHERE item_id = $key";
				$result = mysqli_query($dbc, $sql);
				$row2 = mysqli_fetch_assoc($result);
                            $sql = "INSERT INTO sales_item(sales_id, item_id, quantity, quantity_price) VALUES('".$row['sales_id']."', '$key', '$keyvalue', '$keyvalue' * '$row2[item_price]')";
            			mysqli_query($dbc, $sql);
				$sql = "UPDATE `item` SET item_stock = item_stock - '$keyvalue' WHERE item_id='$key'";
				mysqli_query($dbc, $sql);
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
						header("location:add_sales_record.php?msg=success");
					}
					else{
						echo "Submit Error";
						echo mysqli_error();
						header("location: add_sales_record.php?msg=failed");
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
