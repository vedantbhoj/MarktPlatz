<?php
    include('./globals.php');
    
    function get_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$userid = $_GET['userid'];
		//$userid = "20";

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

	get_cart();

    /*$items = array();

		
	array_push($items, array(
				"prodID"=>4,
				"prodCat"=>2,
				"orderid"=>1,
				"qty"=>5,
				));
				
	array_push($items, array(
				"prodID"=>1,
				"prodCat"=>2,
				"orderid"=>2,
				"qty"=>10,
				));
				
				print(json_encode($items));*/
?>