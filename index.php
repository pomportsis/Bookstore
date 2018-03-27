<!doctype html>
<html lang="en">
<?php
session_start();
if( ! isset($_SESSION['username'])) {
	$_SESSION['username']='?';
	$_SESSION['cart']='?';
}

require_once "internal/dbconnect.php";
?>
  <head>
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lab3</title>


    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
	<script src="ajax/add_cart.js"></script>
  </head>

  <body>
<header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Lab3</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php?p=start">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=shopinfo">Shop Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=cart">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=login">Login</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="?p=contact">Contact</a>
            </li>        
			</ul>
        </div>
      </nav>
    </header>
    
<!-- Apo edw bazw apo to Dashboard Template -->
<div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
<!-- <a class="nav-link active" href="#">ADMIN<span class="sr-only">(current)</span></a> -->
<?php
	
	if($_SESSION['username']=='admin') {

		print <<<END
		<h2>Admin MENU</h2>
		<ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="?p=customerlist">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=orderlist">Orders</a>
            </li>
          </ul>
END;
    }
?>
<?php
	
	if($_SESSION['username']!='?') {

		print <<<END
		<h2>User MENU</h2><ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="?p=myorders">My Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=myinfo">My Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=logout">Logout</a>
            </li>
            
          </ul>
END;
require "internal/menuleft.php";
    }
?>

</nav>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
<?php
if( ! isset($_REQUEST['p'])) {
	$_REQUEST['p']='start';
}
$p = $_REQUEST['p'];
switch ($p){
case "start" :		require "internal/start.php";
					break;
case "shopinfo": 	require "internal/shopinfo.php";
					break;
case "products":    require "internal/products.php";
                    break;
case "cart":        require "internal/cart.php";
                    break;
case "contact":     require "internal/contact.php";
                    break;
case "login" :		require "internal/login.php";
					break;
case "do_login":	require "internal/do_login.php";
					break;
case "after_login": require "internal/after_login.php";
                    break;
case "logout":      require "internal/logout.php";
                    break;
case "myorders":    require "internal/myorders.php";
                    break;
case "myinfo":   	require "internal/myinfo.php";
                    break;
case "customerlist":require "internal/customerlist.php";
                    break;
case "orderlist":   require "internal/orderlist.php";
                    break;
case 'catinfo':		require "internal/catinfo.inc";
					break;
case 'addcart':		require "internal/addcart.php";
					break;
case 'emptycart':	require "internal/emptycart.php";
					break;
case 'buy':		    require "internal/buy.php";
					break;

default: 
	print "Page not available";
}
?>
</main>
</div>
<div id="footer"></div>
</body>
</html>
