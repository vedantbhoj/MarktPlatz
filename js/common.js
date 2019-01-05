$( document ).ready(function() {
    
    //Prevent Resubmisson on refresh
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    $('.left-top-bar').html("Welcome to the All in One Cross-Domain Marketplace!!");
//Removing search icon on all the pages except index.php    
var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
if(filename==="index.php" || filename==="")
{
$('.zmdi-search').show();
}
else
{
$('.zmdi-search').hide();
}
if(filename==="product.php" || filename==="popular_products.php")
{
 $('.js-show-filter').hide();   
 $('.js-show-search').hide();   
}
//////
    var username = getCookie("login");
    
    $("#top_bar_logout").click(function(){
    deleteCookie("login");
    deleteCookie("loginid");
    deleteCookie("VISITED_PAGES");
    window.location.href = "https://marktplatz.vedantbhoj.com/";
    });
    
    if(username!==undefined && username !== '' && username !== null)
    {
        $("#top_bar_login").hide();
        $("#top_bar_logout").show();
        $('.username').show();
        $('.username').html("Hi! "+username);
        $("#top_bar_FB").hide();
    }
    else
    {
        
        $("#top_bar_login").show();
        $("#top_bar_logout").hide();
        $('.username').hide();
        $('.username').html("");
        $("#top_bar_FB").show();
    }
    
    function setCookie(name, value, days) {
    var d = new Date;
    d.setTime(d.getTime() + 24*60*60*1000*days);
    document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}

function deleteCookie(name) { setCookie(name, '', -1); }

    
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
    
    });