<?php
	session_start();
?>
<html>
	<head>
		<title>Edit Item</title>
	</head>
	<body>
		<?php
		$temp=0;
			if(isset($_POST['Submit']))
			{
				$data_missing=array();
				if(empty($_POST['item_id']))
				{
					$data_missing[]='Item ID';
				}
				else
				{
					$item_id=trim($_POST['item_id']);
				}

				if(empty($_POST['cat_id']))
				{
					$data_missing[]='Category ID';
				}
				else
				{
					$cat_id=trim($_POST['cat_id']);
				}


				if(empty($_POST['item_name']))
				{
					$data_missing[]='Item Name';
				}
				else
				{
					$item_name=trim($_POST['item_name']);
				}

				if(empty($_POST['item_description']))
				{
					$data_missing[]='Item Description';
				}
				else
				{
					$item_description=trim($_POST['item_description']);
				}

				if(empty($_POST['item_price']))
				{
					$data_missing[]='Item Price';
				}
				else
				{
					$item_price=trim($_POST['item_price']);
				}

				if(empty($_POST['item_stock']))
				{
					$data_missing[]='Item Stock';
				}
				else
				{
					$item_stock=trim($_POST['item_stock']);
				}



				if(empty($data_missing))
				{
					$cnt=1;
					require_once('mysqli_connect.php');

					if($cnt==1)
					{
						$query="UPDATE `item` SET item_id = '$item_id', cat_id = '$cat_id', item_name = '$item_name', item_description = '$item_description', item_price = '$item_price', item_stock = '$item_stock' WHERE item_id = '$item_id'";
						if (mysqli_query($dbc,$query))
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
						echo "Successfully Submitted";
						header("location:view_item.php?msg=success_edit");
					}
					else{
						echo "Submit Error";
						echo mysqli_error();
						header("location: view_item.php?msg=failed_edit");
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