<?php
	session_start();
?>
<html>
	<head>
		<title>Delete items</title>
	</head>
	<body>
		<?php
			if(isset($_POST['delete_item']))
			{
				$data_missing=array();
				if(empty($_POST['key']))
				{
					$data_missing[]='Item ID';
				}
				else
				{
					$item_id=trim($_POST['key']);
				}

				if(empty($data_missing))
				{
					$cnt=1;
					require_once('mysqli_connect.php');
					if($cnt==1)
					{
						$i=$_POST["key"];  
						$query="DELETE from item WHERE item_id='$i'";
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
						echo "Successfully Deleted";
						header("location: view_item.php?msg=success_delete");
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
						header("location: view_item.php?msg=failed_delete");

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