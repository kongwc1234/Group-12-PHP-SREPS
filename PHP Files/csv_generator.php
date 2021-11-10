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

			<?php
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="demo.csv"');

				header('Pragma: no-cache');
				header('Expires: 0');
				$file = fopen('demo.csv', 'w');
				
 
				//query the database
				//$query = 'SELECT* FROM sales';
				$sql = "SELECT * FROM sales WHERE sales_date>='".$_POST['start_date']."' and sales_date<='".$_POST['end_date']."'";
 
				if ($rows=mysqli_query($dbc, $sql))
				{
				// loop over the rows, outputting them
				$columns = array('sales_id', 'staff_id', 'sales_date', 'sales_description');
                $sql = "SELECT item_name FROM item";
                $result = mysqli_query($dbc, $sql);
                $columnstoadd = mysqli_fetch_all($result,MYSQLI_ASSOC);
                foreach($columnstoadd as $i){
					echo var_dump($i);
                    array_push($columns, $i["item_name"].' '. "quantity", $i["item_name"].' '."quantity price");
                }
				array_push($columns,"total_price");
                fputcsv($file, $columns);
				while ($row = mysqli_fetch_assoc($rows))
				{
					$sql="SELECT item.item_id, IFNULL(quantity,0) AS quantity, IFNULL(quantity_price, 0) AS quantity_price FROM sales_item RIGHT JOIN item ON item.item_id = sales_item.item_id AND sales_id = '".$row["sales_id"]."'";
					//$sql = "SELECT * FROM sales_item WHERE sales_id = '".$row["sales_id"]."'";
					$result2 = mysqli_query($dbc, $sql);
					$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

					$sql = "SELECT SUM(quantity_price) AS total_price FROM sales_item WHERE sales_id = '".$row["sales_id"]."'";
					$result = mysqli_query($dbc, $sql);
					$total_price = mysqli_fetch_assoc($result);

					foreach($rows2 as $row2){
					echo var_dump($row2);
					array_push($row,$row2["quantity"]);
					array_push($row,$row2["quantity_price"]);
					}
					array_push($row,$total_price["total_price"]);
					fputcsv($file, $row);
				}
				// free result set
				mysqli_free_result($result);
				}
				// close the connection
				mysqli_close($dbc);

		
				header("location: view_sales_report.php?msg=success_download");
				
			?>
