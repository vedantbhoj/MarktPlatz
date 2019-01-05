<?php
include('./php/globals.php');
$conn = open_db_conn();
        
                    $firstname = $_GET["firstname"];
                    $lastname = $_GET["lastname"];
                    $email= $_GET["email"];
                    $query = "SELECT userid FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $query);
                    
            		if(mysqli_num_rows($result) > 0)
            		{
                		$result = mysqli_fetch_array($result);
                		$userid = $result['userid'];
                		
                		$message = $firstname." with emailid - ".$email;
                        mail("veducool28@gmail.com","FB/Google Login Notification",$message);
                        
                        setcookie("login", $firstname, time() + (10*60*60), "/");
                        setcookie("loginid",$userid,time() + (10*60*60),"/");
                    }
                    else
                    {
                        $query1 = "INSERT INTO users(firstname,lastname,email) VALUES('$firstname','$lastname','$email')";
                        
                        if(mysqli_query($conn, $query1))
                        {
                          $query = "SELECT userid FROM users WHERE email='$email'";
                          $result = mysqli_query($conn, $query);
                        $result = mysqli_fetch_array($result);
                		$userid = $result['userid'];
                		
                		$message = $firstname." ".$lastname." with emailid - ".$email;
                        mail("veducool28@gmail.com","FB/Google Login Notification",$message);
                        
                        setcookie("login", $firstname, time() + (10*60*60), "/");
                        setcookie("loginid",$userid,time() + (10*60*60),"/");
                            echo '<script>alert("Successfully created a new user.")</script>';
                        }
                        else
                        {                       
                            echo '<script>alert("Failed to create a user")</script>';
                        }
                    }
close_db_conn($conn);
?>