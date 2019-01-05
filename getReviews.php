<?php

//Get product data

    $prodId = $_GET['prodId'];
    $prodCat = $_GET['prodCat'];

//connect to server
    include('./php/globals.php');

		// Open new connection
		$conn = open_db_conn();

    if ($conn->connect_error) 
    {
        echo '<script>alert("Connection failed!")</script>';
    }
        
    $getReviews = "SELECT users.firstname, users.lastname , reviews.rating , reviews.review 
                    FROM reviews INNER JOIN users ON reviews.userid = users.userid AND
                    reviews.prodid = '$prodId' AND reviews.prodCat = '$prodCat'";
    
    $result = mysqli_query($conn,$getReviews);
    
    $count = mysqli_num_rows($result); 
    
    $products = array();
    while($row = mysqli_fetch_array($result))
    {
	    array_push($products, array(
            "firstname"=>$row['firstname'],
            "lastname"=>$row['lastname'],
            "rating"=>$row['rating'],
            "review"=>$row['review']
	        ));
    }
    
    if($count > 0) 
    {
	    print(json_encode($products));
    } 
    else 
    {
        print("No products Found");
    }
    
 
    mysqli_close($conn);
?>