<?php
    include('./php/globals.php');

		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$userid = $_COOKIE['loginid'];

		// Retrieve orderid for given userid
		/*$query = "select orderid from orders where userid = '$userid' and isordered = 0";
		$result = mysqli_query($conn, $query);
		//if(mysqli_num_rows($result) == 0)
		//	return;
		$result = mysqli_fetch_array($result);
		
		$orderid = $result['orderid'];*/

		$query = "SELECT cart.prodID, cart.prodCat, cart.orderid, cart.qty FROM cart INNER JOIN orders ON orders.orderid=cart.orderid where orders.userid = $userid and isordered = 0";

		$result = mysqli_query($conn, $query);

		$items = array();

		while ($row = mysqli_fetch_array($result)) {
			array_push($items, array(
				"prodID"=>$row['prodID'],
				"prodCat"=>$row['prodCat'],
				"orderid"=>$row['orderid'],
				"qty"=>$row['qty'],
				));
		}

		if(mysqli_num_rows($result) > 0) {
			print(json_encode($items));
		}

		// Close MySQL connection
		close_db_conn($conn);
?>