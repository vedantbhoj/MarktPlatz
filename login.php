<?php
                // Track page visit
               // include('./php/track_page_visits.php');
                //store_visited_pages("Login");

                include('./php/globals.php');

				// Open new connection
				$conn = open_db_conn();
                
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                if(isset($_POST["loginsubmit"]))
                {
                    $email = $_POST["email"];
                    $userpassword = $_POST["password"];
                    $query = "SELECT userid,firstname,lastname FROM users WHERE email='$email' AND password ='$userpassword'";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result) == 1)
                    {
                        $fn = "";
                        $ln = "";
                        $user = array();
                        while($row = mysqli_fetch_array($result)) {
                            $fn = $row['firstname'];
                            $ln = $row['lastname'];
                            $id = $row['userid'];
                        }
                        setcookie("login", $fn, time() + (10*60*60), "/");
                        setcookie("loginid",$id,time() + (10*60*60),"/");
                        unset($_POST["loginsubmit"]);
                        echo '<script>  window.parent.location.reload();</script>';
                    }
                    else
                    {
                        unset($_POST["loginsubmit"]);
                        echo '<script>alert("Invalid!");</script>';
                    }
                }
                
                if(isset($_POST["signupsubmit"]))
                {
                    $firstname = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $email= $_POST["email"];
                    $userpassword = $_POST["password"];
                    $phone = $_POST["phone"];
                    $query = "SELECT * FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $query);
                
                    if(mysqli_num_rows($result) > 0)
                        echo '<script>alert("A user with this email already exists!")</script>';
                    else
                    {
                       $query1 = "INSERT INTO users(firstname,lastname,homephone,email,password) VALUES('$firstname', '$lastname', '$phone', '$email', '$userpassword')";
                        if(mysqli_query($conn, $query1))
                        {
                            unset($_POST["signupsubmit"]);
                            $message = $firstname." ".$lastname." ".$email;
                            mail("veducool28@gmail.com","Login Notification",$message);
                            echo '<script>alert("Successfully created a new user. Please log in with your credentials")</script>';
                        }
                        else
                        {                       
                            unset($_POST["signupsubmit"]);
                            echo '<script>alert("Failed to create a user")</script>';
                        }

                    }
                }
?>
<!DOCTYPE html>
<html>
<head>


<title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="589399201948-255don1dpps07hqplmfpkff5hk9nd3a5">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
#error
{
    visibility:hidden;
}
#LoginForm
	{
		 background-repeat:no-repeat; 
		 background-position:center; 
		 background-size:cover; 
		 padding:10px;
	}

#SignUpForm
	{
		style.display:none;
	}

.form-heading 
	{ 
		color:#fff; 
		font-size:23px;
	}
.panel h2
	{ 
		color:#444444; 
		font-size:18px; 
		margin:0 0 8px 0;
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
	}
	
.login-form
	{ 
	text-align:center;
	}
	
.forgot a 
	{
	  color: #777777;
	  font-size: 14px;
	  text-decoration: underline;
	}
	
.login-form  .btn.btn-primary 
	{
    background: #f0ad4e none repeat scroll 0 0;
    border-color: #f0ad4e;
    color: #ffffff;
    font-size: 14px;
    width: 100%;
    height: 35px;
    line-height: 35px;
    padding: 0;
	}
	
.forgot 
	{
	  text-align: left; margin-bottom:30px;
	}
	
.botto-text
	{
	  color: #ffffff;
	  font-size: 14px;
	  margin: auto;
	}
	
.login-form .btn.btn-primary.reset 
	{
	  background: #ff9900 none repeat scroll 0 0;
	}
.back 
	{ 
	  text-align: left; margin-top:10px;
	}
.back a 
	{
		color: #444444; font-size: 13px;
		text-decoration: none;
	}


	
</style>

</head>

<body>
<div id="LoginForm">
<div class="container">
	<div class="login-form">
		<div class="main-div">
			<div class="panel">							
				<h5>Please enter your email and password</h5>
			</div>	
			<form id="LoginData" method="POST">
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email Address">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name="password"  placeholder="Password">
				</div>
				
				<div id="error">Invalid credentials!</div>
				
				<div class="forgot">
					<a href="reset.html">Forgot password?</a>
				</div>
				
				<button type="submit" name="loginsubmit" class="btn btn-primary">Login</button>
				<br> <br>
				<input type="button" value = "Create new account" onclick = "toggleToSignUp()" class="btn btn-primary" ></input>
				
			</form>		
		</div>
	</div>
</div>
<div style="display: inline-grid;margin-left: 35%;text-align: -webkit-center;">
    <!--<fb:login-button size="xlarge" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>&nbsp&nbsp-->
    <div class="g-signin2" data-onsuccess="onSignIn" onclick="ClickLogin()" data-theme="dark"></div>
</div>


</div>

<div id="SignUpForm" style="display:none;">

<div class="container">
	<div class="login-form">
		<div class="main-div">
			<div class="panel">							
				<h5>Create a New User</h5>
			</div>	
			<form id="SignUp" method="POST">
				
				<div class="form-group">
					<input type="text" class="form-control" name="firstname" placeholder="First Name" required>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
				</div>
				
				<div class="form-group">
					<input type="email" class="form-control" name = "email" placeholder="Email Address" required>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name = "password"  placeholder="Password" required>					
				</div>
				
				<button type="submit" name = "signupsubmit" class="btn btn-primary">Submit</button>
				<br> <br>
				<input type="button" value = "Back To Login" onclick = "toggleToLogin()" class="btn btn-primary" ></input>				
			</form>
		
		</div>
	</div>
</div>
</div>


			<script>
			function toggleToSignUp() {
				$("#LoginForm").hide();
				$("#SignUpForm").show();
			}
			
			function toggleToLogin() {
				$("#SignUpForm").hide();
				$("#LoginForm").show();
			}
			

function postSSOdetails(firstname,lastname,email){
$.ajax({
    url : "SSOlogin.php?firstname="+firstname+"&lastname="+lastname+"&email="+email,
    type : "post",
    async: false,
    success : function(data) { window.parent.location.reload();},
    error: function() {alert("Some error occured!!");
    }
 });
}

var clicked=false;//Global Variable
function ClickLogin()
{
    clicked=true;
}

//Google
function onSignIn(googleUser) {
     if (clicked) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
			var firstname,lastname,email;
	
			firstname = profile.getGivenName();
			lastname = profile.getFamilyName();
			email =  profile.getEmail();
			alert('Successfull Google login for: ' + firstname +" "+lastname);
			postSSOdetails(firstname,lastname,email);
                }
      };
			
			</script>	

</body>