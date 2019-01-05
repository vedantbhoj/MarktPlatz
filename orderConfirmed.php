<?php

        $userid = $_COOKIE['loginid'];
         include('./php/globals.php');

		// Open new connection
		$conn = open_db_conn();
        
        if(isset($_POST['checkout']))
        {
            if ($conn->connect_error) 
                die("Connection failed: " . $conn->connect_error);
            
                $query = "select orderid from orders where userid = '$userid' AND isordered = 0";
        		$result = mysqli_query($conn, $query);
        
        		$result = mysqli_fetch_array($result);
        		$orderid = $result['orderid'];
        
        		$query = "update orders set isordered = 1 where orderid = '$orderid'";
        		if(mysqli_query($conn, $query))
        		{
        		    echo '<script>alert(Checkout - success)</script>';
        		}
        		else
        		{
        		    echo '<script>alert(Checkout - fail)</script>';
        		}
        		
        }
        
        if(isset($_POST['paymentsubmit']))
        {
             if ($conn->connect_error) 
                die("Connection failed: " . $conn->connect_error);
            
                $query = "select orderid from orders where userid = '$userid' AND isordered = 0";
        		$result = mysqli_query($conn, $query);
        
        		$result = mysqli_fetch_array($result);
        		$orderid = $result['orderid'];
        
        		$query = "update orders set isordered = 1 where orderid = '$orderid'";
        		if(mysqli_query($conn, $query))
        		{
        		            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= 'From: <admin@MarktPlatz.com>' . "\r\n";
                        
                            $subject = "MarktPlatz : Ordered Confirmed!";
                            $message = '<img src="https://vedantbhoj.com/Marketplace/images/icons/logo-01.png" alt="logo" height="40" width="240">';
                            $message.= "<br>Hello ".$_POST['name']." <br> <h2>Your order has been confirmed!</h2> <br> Your Order Number is $orderid . <br><br> Thank You for Shopping.<br>";
                            
                            $userEmailAddress = $_POST['email'];
                            $to = $userEmailAddress;
                            mail($to,$subject,$message,$headers);
                            echo '<script>alert("Ordered confirmed!");</script>';
                            echo '<script>window.parent.location.reload();</script>';
        		}
        		else
        		{
        		    echo '<script>alert("Payment Failed!!")</script>';
        		}
        		
  
        }
        
       
        mysqli_close($conn);
         
        
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

#LoginForm
	{
		 background-repeat:no-repeat; 
		 background-position:center; 
		 background-size:cover; 
		 padding:10px;
	}


.panel p 
	{ 	
	color: #777777;
    font-size: 14px;
    /* margin-bottom: 30px; */
    line-height: 24px;
	}
	
.login-form .form-control 
	{
    background: #f7f7f7 none repeat scroll 0 0;
    border: 1px solid #d4d4d4;
    border-radius: 4px;
    font-size: 14px;
    height: 40px;
    line-height: 40px;
	}
	
.main-div 
	{
    background: #ffffff none repeat scroll 0 0;
    /* border-radius: 2px; */
    /* margin: 10px auto 30px; */
    padding: 5px 10px 10px 10px;
	}

.login-form .form-group 
	{
	  margin-bottom:10px;
	  width:70%;
	  margin:auto;

	}
	
.login-form
	{ 
	text-align:center;
	}

	
.login-form  .btn.btn-primary 
	{
    background: #f0ad4e none repeat scroll 0 0;
    border-color: #f0ad4e;
    color: #ffffff;
    font-size: 14px;
    width: 50%;
    height: 35px;
    line-height: 35px;
    padding: 0;
	}

</style>

</head>
<body>
<div id="LoginForm">
<div class="container">
	<div class="login-form">
		<div class="main-div">
			<div class="panel">							
				<h4>You're almost there!</h4>
				<h5>Please enter your payment information</h5><br>
			</div>	
			<form id="LoginData" method="POST">
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email Address to recieve order details"><br>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Name On Card"><br>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="cardnumber" placeholder="Card Number" pattern="\d*" maxlength="12"><br>
				</div>
				
				<div class="form-group">
					<input type="date" class="form-control" name="expiry" placeholder="Expiry Date"><br>
				</div>
				
				<button type="submit" name="paymentsubmit" class="btn btn-primary">Confirm and Pay</button>
				<br> <br>
			</form>		
		</div>
	</div>
</div>
</div>
</body></html>




