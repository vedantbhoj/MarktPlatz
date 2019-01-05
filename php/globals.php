<?php
	/* Marketplace DB:*/

	function open_db_conn() {
		$servername = "bhojvedant2844138.ipagemysql.com";
        $username = "marketplace";
        $password = "marketplace";
        $dbname = "marketplace";
    
        $conn =  mysqli_connect($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
    		return NULL;
		} 
		return $conn;
	}

	function close_db_conn($conn){
		// Close MySQL connection
		mysqli_close($conn);
	}

?>