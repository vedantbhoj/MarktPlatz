<?php 
include('./php/globals.php');
        $conn = open_db_conn();

		// Get parameters from HTTP POST
		$prodID = $_GET['prodID'];
		$prodCat = $_GET['prodCat'];
		$userid = $_GET['userid'];

		// Retrieve orderid for given userid
		$query = "select orderid from orders where userid = ".$userid." and isordered = FALSE";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0)
			return;
		$result = mysqli_fetch_array($result);
		$orderid = $result['orderid'];

		$query = "delete from cart where orderid = ".$orderid." and prodID = ".$prodID." and prodCat = ".$prodCat;

		// Execute the query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);	
		?>