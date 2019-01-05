<?php
        include('./php/track_page_visits.php');
        store_visited_pages("Home");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!--<script src="js/market.js"></script>-->
<script src="js/common.js"></script>
<script>function checkLoginState() {
        debugger;
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
}
    function checkLoginState() {
        debugger;
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
}

function statusChangeCallback(response) {
    debugger;
	// The response object is returned with a status field that lets the app know the current login status of the person.
	if (response.status === 'connected') {
		console.log('Welcome! Fetching your information.... ');
		FB.api('/me?fields=id,email,cover,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified', 
		function(response) {
			alert('Successfull FB login for: ' + response.name);
			var firstname,lastname,email;
			var result = response.name.split(" ");
			firstname = result[0];
			lastname = result[1];
			email = response.email;
			postSSOdetails(firstname,lastname,email);
			
	});
	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
		alert('Please log ' + 'into this app.');
	} else {
		// The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
	    alert('Please log ' + 'into Facebook.');
	}
}

function postSSOdetails(firstname,lastname,email){
    debugger;
$.ajax({
    url : "SSOlogin.php?firstname="+firstname+"&lastname="+lastname+"&email="+email,
    type : "post",
    async: false,
    success : function(data) { window.location.reload();},
    error: function() {alert("Some error occured!!");
    }
 });
}

window.fbAsyncInit = function() {
    FB.init({
      appId      : '499982363843216',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.2'
    });
      
    FB.AppEvents.logPageView();   
      
  };

(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<!--===============================================================================================-->

<style>
* {
  box-sizing: border-box;
}


.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

 input#myInput {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input#myInput[type=text] {
background-color: #ffffff;
    width: 100%;
    border: #c3bfc38a;
    border-style: solid;
}

input[name=searchSubmit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
  border: 1px solid transparent;
  padding: 10px;
  font-size: 16px;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>



</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Currency - USD
						</a>
						
						<a href="#" id="top_bar_login" data-toggle="modal" data-target="#loginModal" class="flex-c-m trans-04 p-lr-25">
							Login to My Account
						</a>
						
					    <a href="#" class="flex-c-m trans-04 p-lr-25 username"  style="display:none;">
						
						</a>
						
						<a href="#" id="top_bar_logout" style="display:none;" class="flex-c-m trans-04 p-lr-25">
							Logout
						</a>
						<a href="#" id="top_bar_FB" style="display:none;" class="flex-c-m trans-04 p-lr-25">
							<fb:login-button size="large" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
						</a>
					</div>
				</div>
			</div>

<!--Login Popup-->
<div class="modal fade" id="loginModal" role="dialog" style="z-index:10000;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: unset;text-align: center;">
          <button type="button" onclick="location.reload();" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login / Sign-up</h4>
        </div>
        <div class="modal-body" style="overflow:none;">
          <iframe src="login.php" style="width: 470px;height: 470px;"></iframe>
        </div>
      </div>
      
    </div>
  </div>
  
  <!--Tracking Popup-->
  <div class="modal fade" id="trackingModal" role="dialog" style="z-index:10000;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: unset;text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tracking System</h4>
        </div>
        <div class="modal-body" style="overflow:none;">
          <iframe src="tracking.php" style="width: 470px;height: 470px;"></iframe>
        </div>
      </div>
      
    </div>
  </div>


			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="popular_products.php">Popular Products</a>
							</li>

							<li>
								<a href="blog.php">News</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
							
							<li>
								<a href="#" data-toggle="modal" data-target="#trackingModal">Page Tracking</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<a href="shoping-cart.php" style="color: black;" ><i class="zmdi zmdi-shopping-cart"></i></a>
						</div>

					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Currency - USD
						</a>
						
						<a href="#" id="top_bar_login" data-toggle="modal" data-target="#myModal" class="flex-c-m p-lr-10 trans-04">
							Login to My Account
						</a>
						
						<a href="#" class="flex-c-m p-lr-10 trans-04 username"  style="display:none;" >
						</a>
						
						<a href="#" id="top_bar_logout" style="display:none;" class="flex-c-m p-lr-10 trans-04">
							Logout
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.php">Shop Products</a>
				</li>

				<li>
					<a href="shoping-cart.php" class="label1 rs1" data-label1="hot">Features</a>
				</li>

				<li>
					<a href="blog.php">News</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search" id ="searchProduct">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button><br>
            <h2>Search the store for your product</h2><br><br>
			<form autocomplete="off" method = "POST">
                  <div class="autocomplete" style="width:800px;">
                   <input id="myInput" type="text" name="mySearch" placeholder="Search">
                  </div><br> <br> 
                  <input type="submit" name="searchSubmit">
                </form>
			</div>
		</div>
		
<script>
        function autocomplete(inp, arr) {
          /*the autocomplete function takes two arguments,
          the text field element and an array of possible autocompleted values:*/
          var currentFocus;
          /*execute a function when someone writes in the text field:*/
          inp.addEventListener("input", function(e) {
              var a, b, i, val = this.value;
              /*close any already open lists of autocompleted values*/
              closeAllLists();
              if (!val) { return false;}
              currentFocus = -1;
              /*create a DIV element that will contain the items (values):*/
              a = document.createElement("DIV");
              a.setAttribute("id", this.id + "autocomplete-list");
              a.setAttribute("class", "autocomplete-items");
              /*append the DIV element as a child of the autocomplete container:*/
              this.parentNode.appendChild(a);
              /*for each item in the array...*/
              for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                  /*create a DIV element for each matching element:*/
                  b = document.createElement("DIV");
                  /*make the matching letters bold:*/
                  b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                  b.innerHTML += arr[i].substr(val.length);
                  /*insert a input field that will hold the current array item's value:*/
                  b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                  /*execute a function when someone clicks on the item value (DIV element):*/
                  b.addEventListener("click", function(e) {
                      /*insert the value for the autocomplete text field:*/
                      inp.value = this.getElementsByTagName("input")[0].value;
                      /*close the list of autocompleted values,
                      (or any other open lists of autocompleted values:*/
                      closeAllLists();
                  });
                  a.appendChild(b);
                }
              }
          });
          /*execute a function presses a key on the keyboard:*/
          inp.addEventListener("keydown", function(e) {
              var x = document.getElementById(this.id + "autocomplete-list");
              if (x) x = x.getElementsByTagName("div");
              if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
              } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
              } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                  /*and simulate a click on the "active" item:*/
                  if (x) x[currentFocus].click();
                }
              }
          });
          function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
          }
          function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
              x[i].classList.remove("autocomplete-active");
            }
          }
          function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
              if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
              }
            }
          }
          /*execute a function when someone clicks in the document:*/
          document.addEventListener("click", function (e) {
              closeAllLists(e.target);
          });
        }
        
        /*An array containing all the country names in the world:*/
        var countries = ["Cannondale - ModelX",
                         "Cannondale - Synapse",
                         "Cannondale - Synapse Alloy",
                         "Cannondale - SystemSix",
                         "Cannondale - CAAD12",
                         "Cannondale - CAAD12 Optimo",
                         "Cannondale - TopStone",
                         "Cannondale - Slate",
                         "Cannondale - SE Collection",
                         "Counter Strike",
                         "PlayerUnknowns Battlegrounds",
                         "Need For Speed",
                         "FIFA 2017 - Manager Edition",
                         "Project I.G.I",
                         "Assassins Creed",
                         "Grand Theft Auto",
                         "Tron Legacy",
                         "Age of Empires",
                         "Stronghold - Crusader",
                         "Studio Apartment",
                         "1Bed1Bath Apartment",
                         "2Bed2Bath Apartment",
                         "3Bed3Bath Apartment",
                         "4Bed4Bath Apartment",
                         "Villas on rent",
                         "Office spaces on rent",
                         "Houses on sale",
                         "Corporate Buildings on rent",
                         "Town house on rent",
                         "The Kite Runner",
                         "The Alchemist",
                         "Five Point Someone",
                         "One Night At The Call Center",
                         "The Colour Purple",
                         "A Brief History Of Time",
                         "Harry Potter and the Philosphers Stone",
                         "The Chronicles Of Narnia - The Lion, The Witch and the Wardrobe",
                         "The Secret Garden",
                         "Alices Adventures in Wonderland"];

                         
        
        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput"), countries);
</script>
		
		<?php
		if(isset($_POST['searchSubmit']))
		{
		    switch($_POST['mySearch']) 
		    {
        case "Cannondale - ModelX" : echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20ModelX&prodID=1';</script>"; break;         
        case "Cannondale - Synapse" : echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20Synapse&prodID=2';</script>"; break;
        case "Cannondale - Synapse Alloy" : echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20Synapse%20Alloy&prodID=3';</script>"; break;
        case "Cannondale - SystemSix": echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20SystemSix&prodID=4';</script>"; break;
        case        "Cannondale - CAAD12": echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20CAAD12&prodID=5';</script>"; break;
        case       "Cannondale - CAAD12 Optimo": echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20CAAD12%20Optimo&prodID=6';</script>"; break;
        case       "Cannondale - TopStone": echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20TopStone&prodID=7';</script>"; break;
        case      "Cannondale - Slate": echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20Slate&prodID=8';</script>"; break;
        case        "Cannondale - SE Collection" : echo "<script>location.href = 'product-detail.php?prodCatName=Bikes&prodCat=4&prodName=Cannondale%20-%20SE_Collection&prodID=9';</script>"; break;
        case       "Counter Strike" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Counter%20Strike&prodID=1';</script>"; break;
        case      "PlayerUnknowns Battlegrounds" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=PlayerUnknown%27s%20Battlegrounds%20(PUBG)&prodID=2';</script>"; break;
        case       "Need For Speed" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Need%20for%20Speed%20(NFS)&prodID=3';</script>"; break;
        case       "FIFA 2017 - Manager Edition" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=FIFA%2017%20(Manager%20Edition)&prodID=4';</script>"; break;
        case       "Project I.G.I" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Project%20I.G.I&prodID=5';</script>"; break;
        case     "Assassins Creed" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Assassins%20Creed%20II&prodID=6';</script>"; break;
        case      "Grand Theft Auto" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Grand%20Theft%20Auto%20V&prodID=7';</script>"; break;
        case        "Tron Legacy" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Tron%20(Legacy)&prodID=8';</script>"; break;
        case       "Age of Empires" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Age%20of%20Empires%20III&prodID=9';</script>"; break;
        case      "Stronghold - Crusader" : echo "<script>location.href = 'product-detail.php?prodCatName=Games&prodCat=3&prodName=Stronghold:%20Crusader&prodID=10';</script>"; break;
        case       "Studio Apartment" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Studio%20Apartment&prodID=1000';</script>"; break;
        case        "1Bed1Bath Apartment" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=1Bed1Bath%20Apartment&prodID=2000';</script>"; break;
        case       "2Bed2Bath Apartment" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=2Bed2Bath%20Apartment&prodID=3000';</script>"; break;
        case      "3Bed3Bath Apartment" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=3Bed3Bath%20Apartment&prodID=4000';</script>"; break;
        case      "4Bed4Bath Apartment" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=4Bed4Bath%20Apartment&prodID=5000';</script>"; break;
        case "Villas on rent" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Villas%20on%20rent&prodID=6000';</script>"; break;
        case      "Office spaces on rent" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Office%20spaces%20on%20rent&prodID=7000';</script>"; break;
        case      "Houses on sale" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Houses%20on%20sale&prodID=8000';</script>"; break;
        case        "Corporate Buildings on rent" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Corporate%20Buildings%20on%20rent&prodID=9000';</script>"; break;
        case      "Town house on rent" : echo "<script>location.href = 'product-detail.php?prodCatName=Homes&prodCat=1&prodName=Town%20house%20on%20rent&prodID=10000';</script>"; break;
        case      "The Kite Runner" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=The%20Kite%20Runner&prodID=2001';</script>"; break;
        case      "The Alchemist" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=The%20Alchemist&prodID=2002';</script>"; break;
        case       "Five Point Someone" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=Five%20point%20someone&prodID=2003';</script>"; break;
        case       "One Night At The Call Center" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=One%20Night%20at%20the%20call%20center&prodID=2004';</script>"; break;
        case       "The Colour Purple" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=The%20Color%20Purple&prodID=2005';</script>"; break;
        case       "A Brief History Of Time" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=A%20Brief%20History%20of%20Time&prodID=2006';</script>"; break;
        case      "Harry Potter and the Philosphers Stone" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=Harry%20Potter%20and%20the%20Philosophers%20Stone.&prodID=2007';</script>"; break;
        case       "The Chronicles Of Narnia - The Lion, The Witch and the Wardrobe" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=Lion%20Witch%20and%20Wardrobe&prodID=2009';</script>"; break;
        case     "The Secret Garden" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=The%20Secret%20Garden&prodID=2008';</script>"; break;
        case      "Alices Adventures in Wonderland" : echo "<script>location.href = 'product-detail.php?prodCatName=Books&prodCat=2&prodName=Alices%20Adventures%20in%20the%20wonderland&prodID=2010';</script>"; break;
            }
		}
		?>
		
		
	</header>

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url(images/slide-01.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									ALL NEW PERFORMANCE
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
								Cannondale Bikes
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url(images/slide-02.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Experience VR with Occulus© 
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Games
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url(images/slide-03.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									BEST SELLING BOOKS
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Word
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="item-slick1" style="background-image: url(images/slide-04.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Your Space
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Nest Away
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-01.jpg" alt="IMG-BANNER">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Bikes
								</span>

								<span class="block1-info stext-102 trans-04">
									Better Performance
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-md-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-02.jpg" alt="IMG-BANNER">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Games
								</span>

								<span class="block1-info stext-102 trans-04">
									New Arrivals
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-md-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-03.jpg" alt="IMG-BANNER">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Books
								</span>

								<span class="block1-info stext-102 trans-04">
									Best Sellers
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
				
				
				<div class="col-md-6 col-md-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/banner-04.jpg" alt="IMG-BANNER">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Homes
								</span>

								<span class="block1-info stext-102 trans-04">
									All New Designs
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								Bikes
							</a>
						</li>

						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								Games
							</a>
						</li>

						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								Books
							</a>
						</li>

						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								Homes
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
					
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>


								<a href="https://api.whatsapp.com/send?phone=123456789&text=Hi,%20please%20help%20me.%20I%20am%20facing%20some%20issues." class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="WhatsApp">
									<i class="fa fa-whatsapp"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>