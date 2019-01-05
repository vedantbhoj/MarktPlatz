<?php
	// Include global functions
	include('./globals.php');

	function add_new_order() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP GET
		$userid = $_GET['userid'];
		$date = $_GET['date'];

		// Insert new order record
		$query = "insert into order(userid, date) values('$userid','$date')";

		// Close MySQL connection
		close_db_conn($conn);
	}

	function add_to_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$userid = $_POST['userid'];
		$prodID = $_POST['prodID'];
		$prodCat = $_POST['prodCat'];
		$qty = $_POST['qty'];

		// Retrieve orderid for given userid
		$query = "select orderid from orders where userid = ".$userid." and isordered = FALSE";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0)
			return;
		$result = mysqli_fetch_array($result);
		$orderid = $result['orderid'];

		// Check if prior record available
		$query = "select * from cart where orderid = ".$orderid." and prodID = ".$prodID." and prodCat = ".$prodCat;

		// Run the query
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) == 0) {
			// No prior record. Insert new record
			$query = "insert into cart(orderID, prodID, prodCat, qty) values(".$orderid.", ".$prodID.", ".$prodCat.", ".$qty.")";
		}
		else {
			// Record found. Just update the quantity
			$query = "update cart set qty = ".$qty." where orderid = ".$orderid." and prodID = ".$prodID." and prodCat = ".$prodCat;
		}

		// Execute the insert query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);
	}

	function remove_from_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$prodID = $_POST['prodID'];
		$prodCat = $_POST['prodCat'];
		$userid = $_POST['userid'];

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
	}

	function place_order() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$userid = $_POST['userid'];

		// Retrieve orderid for given userid
		$query = "select orderid from orders where userid = ".$userid." and isordered = FALSE";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0)
			return;
		$result = mysqli_fetch_array($result);
		$orderid = $result['orderid'];

		$query = "update order set isordered = TRUE where orderid = ".$orderid;
		
		// Execute the query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);
	}

	function get_cart($userid) {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		// $userid = $_GET['userid'];

		// Retrieve orderid for given userid
		$query = "select orderid from orders where userid = ".$userid." and isordered = FALSE";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0)
			return;
		$result = mysqli_fetch_array($result);
		$orderid = $result['orderid'];

		$query = "select * from cart where orderid = ".$orderid;

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
	}

	get_cart(1);
?>