$( document ).ready(function() {

var JSONBikes;
var JSONGames;
var JSONBooks;
var JSONHomes;

// Fetch Bike Store Products
$.ajax({
    url : "products_bikestore.php",
    type : "get",
    async: false,
    success : function(data) {
        JSONBikes = JSON.parse(data);
 $.each(JSON.parse(data), function(i, obj){
		$('.home_product_page').append(productcardhtml(obj));
	});
    },
    error: function() {
    }
 });	
 
// Fetch Game Store Products
$.ajax({
    url : "products_gamestore.php",
    type : "get",
    async: false,
    success : function(data) {
        JSONGames = JSON.parse(data);
 $.each(JSON.parse(data), function(i, obj){
	    $('.home_product_page').append(productcardhtml(obj));
	});
    },
    error: function() {
    }
 });
 
// Fetch Books Store Products
$.ajax({
    url : "products_bookstore.php",
    type : "get",
    async: false,
    success : function(data) {
        JSONBooks = JSON.parse(data);
 $.each(JSON.parse(data), function(i, obj){
		$('.home_product_page').append(productcardhtml(obj));
	});
    },
    error: function() {
    }
 });
 
// Fetch NestAway Store Products
$.ajax({
    url : "products_nestaway.php",
    type : "get",
    async: false,
    success : function(data) {
        JSONHomes = JSON.parse(data);
 $.each(JSON.parse(data), function(i, obj){
		$('.home_product_page').append(productcardhtml(obj));
	});
 },
    error: function() {
    }
 });
 
 var allproducts;
 if(JSONBikes!==undefined)
 allproducts = JSONBikes;
 if(JSONGames!==undefined)
 allproducts = allproducts.concat(JSONGames);
 if(JSONBooks!==undefined)
 allproducts = allproducts.concat(JSONBooks);
 if(JSONHomes!==undefined)
 allproducts = allproducts.concat(JSONHomes);
    
//Scripts related to the Product Detail PAGE
var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
if(filename=='product-detail.php')
{
    
    var urlparameters = getUrlVars();
    var relatedProducts;
    if(urlparameters.prodCatName == "Bikes")
    {
        relatedProducts = JSONBikes;
    }
    else if(urlparameters.prodCatName == "Games")
    {
        relatedProducts = JSONGames;
    }
    else if(urlparameters.prodCatName == "Books")
    {
        relatedProducts = JSONBooks;
    }
    else if(urlparameters.prodCatName == "Homes")
    {
        relatedProducts = JSONHomes;
    }
    
    for (var i=0 ; i < relatedProducts.length ; i++)
    {   
        if (relatedProducts[i]["prodID"] == urlparameters.prodID) {
            $('.prodName').html(relatedProducts[i]["prodName"]);
            $('.prodCatName').html(relatedProducts[i]["prodCatName"]);
            $("#prodCatName").html(relatedProducts[i]["prodCatName"] +' <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>');
            $('.prodID').html(relatedProducts[i]["prodID"]);
            $('.prodDesc').html(relatedProducts[i]["prodDesc"]);
            $('.prodPrice').html("$ "+relatedProducts[i]["prodPrice"]+'&nbsp&nbsp&nbsp<span class="stext-105 cl3" style="color: gray;text-decoration: line-through;">$'+Math.abs(relatedProducts[i]["prodPrice"]*1.3)+'</span>');
            
            var prodImg = relatedProducts[i]["prodImg"];
            
            
// Fetch reviews based on Prod ID and Prod Cat
var reviewurl = "getReviews.php?prodId="+urlparameters.prodID+"&prodCat="+urlparameters.prodCat;
$.ajax({
    url : reviewurl,
    type : "get",
    async: false,
    success : function(data) {
        var JSONreview;
        if(data=="No products Found")
        {
        $("#ReviewCount").html("Reviews (0)");
        }
        else
        {
        JSONreview = JSON.parse(data);
        $("#ReviewCount").html("Reviews ("+JSONreview.length+")");
        }
        
 $.each(JSON.parse(data), function(i, obj){
     var ratinghtml="";
        for(var i=0;i<obj.rating;i++)
            {
                ratinghtml = ratinghtml + '<i class="zmdi zmdi-star"></i>';
            }
               for(var i=0;i<5-obj.rating;i++)
            {
                ratinghtml = ratinghtml + '<i class="zmdi zmdi-star-outline"></i>';
            }
		$('.reviewsDiv').append('<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">'+
            '<img src="images/avatar-01.jpg" alt="AVATAR">'+
            '</div>'+
            '<div class="size-207">'+
            '<div class="flex-w flex-sb-m p-b-17">'+
            '<span class="mtext-107 cl2 p-r-20">'+
            obj.firstname+" "+obj.lastname+
            '</span>'+
            '<span class="fs-18 cl11">'+
            ratinghtml+
            '</span>'+
            '</div>'+
            '<p class="stext-102 cl6">'+
            obj.review+
            '</p>'+
            '</div>');
	});
 },
    error: function() {
    }
 });
            
	

            
            $('.gallery-lb').html('<div class="item-slick3" data-thumb="'+prodImg+'">'+
					'<div class="wrap-pic-w pos-relative">'+
					'<img src="'+prodImg+'" alt="IMG-PRODUCT">'+
                    '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+prodImg+'">'+
					'<i class="fa fa-expand"></i>'+
					'</a>'+
					'</div>'+
					'</div>');
					
					var userId = getCookie("loginid");
                    if(userId!==undefined && userId !== '' && userId !== null)
                    {
                        $('input[name=prodCatName]').val(relatedProducts[i]["prodCatName"]);
                        $('input[name=prodID]').val(relatedProducts[i]["prodID"]);
                        $('input[name=prodCat]').val(relatedProducts[i]["prodCat"]);
                        $('input[name=userid]').val(userId);
                    }
                    else
                    {
                        $("#reviewform").html('<h5 class="mtext-108 cl2 p-b-7">Please login to write a review.</h5>');
                    }
        }
    }
    
    
    
    $.each(relatedProducts, function(i, obj){
		$("#relatedProductsSlider").append(realtedproducthtml(obj));
	});
	$("#relatedProductsSlider").append('<script src="vendor/slick/slick.min.js"></script>'+
	'<script src="js/slick-custom.js"></script>');
	
	
	

}
else if(filename=='popular_products.php')	/////Popular Products page////////////
{
// Fetch Popular Products
$.ajax({
    url : "getProductInfo.php",
    type : "get",
    async: false,
    success : function(data) {
        var rawpopular = JSON.parse(data);
        var popular = [];
        for (var i=0 ; i < rawpopular.length ; i++)
        {  
            for(var j=0 ; j < allproducts.length ; j++)
            {
                if( (rawpopular[i]['prodCat']==allproducts[j]['prodCat']) && (rawpopular[i]['prodID']==allproducts[j]['prodID']))
                {
                    allproducts[j]['prodName'] = allproducts[j]['prodName'] + " (" +rawpopular[i]['visitcounter'] + " - Views)";
                popular.push(allproducts[j]);
                }
            }
        }
        $('.home_product_page').html("");
        $.each(popular, function(i, obj){
		$('.home_product_page').append(productcardhtml(obj));
	});
 },
    error: function() {
    }
 });
    
}
else if(filename=='shoping-cart.php')
{
// Fetch Cart
var userId = getCookie("loginid");
if(userId==null || userId=="" || userId == undefined)
{
    alert('Please login first to view the Cart.');
    window.location.href = "index.php";
}
$.ajax({
    url : "get_cart.php",
    type : "get",
    async: false,
    success : function(data) {
        if(data!=="" && data!==null && data!==undefined)
        {
        var rawcart = JSON.parse(data);
        var totalorderprice=0;
        for (var i=0 ; i < rawcart.length ; i++)
        {  
            for(var j=0 ; j < allproducts.length ; j++)
            {
                if( (rawcart[i]['prodCat']==allproducts[j]['prodCat']) && (rawcart[i]['prodID']==allproducts[j]['prodID']))
                {
                	$('.table-shopping-cart').append('<tr class="table_row">'+
                                        '<td class="column-1">'+
                                        '<div class="how-itemcart1" onclick="removecart('+rawcart[i]['prodID']+','+rawcart[i]['prodCat']+','+userId+')">'+
                                        '<img src="'+allproducts[j]['prodImg']+'" alt="IMG">'+
                                        '</div>'+
                                        '</td>'+
                                        '<td class="column-2">'+allproducts[j]['prodName']+'</td>'+
                                        '<td class="column-3">$ '+allproducts[j]['prodPrice']+'</td>'+
                                        '<td class="column-4">'+rawcart[i]['qty']+'</td>'+
                                        '<td class="column-5">$ '+rawcart[i]['qty']*allproducts[j]['prodPrice']+'</td>'+
                                        '</tr>'
                                        );
                    totalorderprice = totalorderprice + (rawcart[i]['qty']*allproducts[j]['prodPrice']);
                   
                }
            }
        }
         $('.subtotal').html("$ "+totalorderprice);
         var finalprice = totalorderprice + 40;
         $('.total').html("$ "+finalprice);
 }
        else
        {
            $('#CartForm').html('<h3 style="text-align:center;">Your Cart is Empty</h3>');
        }
    },
    error: function() {
    }
 });

}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function productcardhtml(obj){
	     var htmlstring = 
           			'<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item '+obj.prodCatName+'">'+
					'<!-- Block2 -->'+
					'<div class="block2">'+
						'<div class="block2-pic hov-img0">'+
							'<img src="'+obj.prodImg+'" alt="IMG-PRODUCT">'+
							'<a href="product-detail.php?prodCatName='+obj.prodCatName+'&prodCat='+obj.prodCat+'&prodName='+obj.prodName+'&prodID='+obj.prodID+'" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">'+
								'View'+
							'</a>'+
						'</div>'+
						'<div class="block2-txt flex-w flex-t p-t-14">'+
							'<div class="block2-txt-child1 flex-col-l ">'+
								'<a href="product-detail.php?prodCatName='+obj.prodCatName+'&prodCat='+obj.prodCat+'&prodName='+obj.prodName+'&prodID='+obj.prodID+'" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">'+
									obj.prodName+
								'</a>'+

								'<span class="stext-105 cl3">$'+
									obj.prodPrice+ '&nbsp&nbsp<span class="stext-105 cl3" style="color: gray;text-decoration: line-through;">$'+Math.abs(obj.prodPrice*1.3)+'</span>'+
								'</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';
				return htmlstring;
	    
	}
	
function realtedproducthtml(obj){
	     var htmlstring = 
           		'<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">'+
						'<!-- Block2 -->'+
						'<div class="block2">'+
							'<div class="block2-pic hov-img0">'+
								'<img src="'+obj.prodImg+'"" alt="IMG-PRODUCT">'+

								'<a href="product-detail.php?prodCatName='+obj.prodCatName+'&prodCat='+obj.prodCat+'&prodName='+obj.prodName+'&prodID='+obj.prodID+'" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">'+
									'View'+
								'</a>'+
							'</div>'+

							'<div class="block2-txt flex-w flex-t p-t-14">'+
								'<div class="block2-txt-child1 flex-col-l ">'+
									'<a href="product-detail.php?prodCatName='+obj.prodCatName+'&prodCat='+obj.prodCat+'&prodName='+obj.prodName+'&prodID='+obj.prodID+'" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">'+
											obj.prodName+
									'</a>'+

									'<span class="stext-105 cl3">$'+
									obj.prodPrice+ '&nbsp&nbsp<span class="stext-105 cl3" style="color: gray;text-decoration: line-through;">$'+Math.abs(obj.prodPrice*1.3)+'</span>'+
								'</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
				return htmlstring;
	    
	}
	
function addcartpopup(){
    $('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
    }

});