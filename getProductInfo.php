<?php

       include('./php/globals.php');

		// Open new connection
		$conn = open_db_conn();

    $getProductInfo = "SELECT * from visitcount ORDER BY visitcounter DESC";
    
    if ($conn->connect_error) 
    {
        die("Failed!");
    }
    $result = mysqli_query($conn,$getProductInfo);
    
    $count = mysqli_num_rows($result);
    
    $productinfo= array();
    while($row = mysqli_fetch_array($result))
    {
	    array_push($productinfo, array(
            "prodID"=>$row['prodID'],
            "prodCat"=>$row['prodCat'],
            "prodCatName"=>$row['prodCatName'],
            "visitcounter"=>$row['visitcounter']
	        ));
    }
    
    if($count > 0) 
    {
	    print(json_encode($productinfo));
    } 
    else 
    {
        print("No products Found");
    }
    
 
    mysqli_close($conn);

?>