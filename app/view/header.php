<?php
session_start(); //Start a session

/***************DO NOT ALLOW DIRECT ACCESS************************************/
if ( stripos( $_SERVER[ 'REQUEST_URI' ], basename( __FILE__ ) ) !== FALSE ) { // TRUE if the script's file name is found in the URL
  header( 'HTTP/1.0 403 Forbidden' );
  die( "<h2>Forbidden! You don't have permission to access this page.</h2>" );
}
/*****************************************************************************/

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/skeleton.css">
  <title></title>
</head>


<!-- notification message -->

<!-- logged in user information -->

<!-- Header -->
<div class="nav-slim">

<div class="nav-link aleft">
<ul>


<li>
<a href="/user/profile"> 
<?php if(isset($_SESSION['username'])){
echo "Hello: ".$_SESSION['username'];
echo "<li><a href='/user/logout'>Log Out</a></li>";
}else{
echo "<li><a href='/user/login'>Log In</a></li>";
} ?>
<li>

<div class="c-search">
<label for="search">Search</label>

</div>
</li>


</ul>
</div>
<div class="nav-link aright">
<ul>

  <?php if(isset($_SESSION['coin'])){  ?>
   <li><a href="#"><?php echo $_SESSION['coin']; ?> <i class="fa fa-moon-o" aria-hidden="true"></i> coins</a></li>
 <?php } ?>
<li><a href="#">support@email.com</a></li>

</ul>
</div>
</div>
<div class="nav">
<div class="nav-logo">CIBO MVC</div>

 <!-- SIDEBAR START -->

 <!-- SIDEBAR END -->

<div class="nav-link aright">
<ul>


    <li>CONTACT</li>
    <li>LINK3</li>
    <li>LINK2</li>
    <li><a href="/blog/index">BLOG</a></li>
    <li><a href="/home/aboutus">ABOUT</a></li>
    <li><a href="/home/index">HOME</a></li>
</ul>
</div>
<!--//================================== BREADCRUMB =========================================================// -->

<div class="breadcrumb">
<pill>breadcrumb</pill>
</div>

<!--//================================== BORDER top,bottom,left,right =======================================// -->
</div>
<div class="bordy bordy_left"></div>
<div class="bordy bordy_right"></div>
<div class="bordy bordy_top"></div>
<div class="bordy bordy_bottom"></div>



<!--//================================== END NAV =======================================// -->
<body>
  <div class="body-box">
