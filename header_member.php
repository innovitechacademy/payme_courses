<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
	<!-- Website Title-->
	<title>Member - Food Ordering System</title>
</head>
	
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="index_member.php">Food Ordering System</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
    		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
				<!-- NavBar button - Home -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home Page">
					<a class="nav-link" href="index_member.php">
						<img src="photo/menu_icon/home.png" width="20" height="20">
						<span class="nav-link-text"> Home</span>
					</a>
				</li>
				<!-- NavBar button - Profile -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="About us">
					<a class="nav-link" href="memberProfile.php">
            					<img src="photo/menu_icon/memberProfile.png" width="20" height="20">
            					<span class="nav-link-text"> Profile</span>
          				</a>
				</li>
				<!-- NavBar button - Invoice Record -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="About us">
					<a class="nav-link" href="invoiceRecord.php">
            					<img src="photo/menu_icon/invoice.png" width="20" height="20">
            					<span class="nav-link-text"> Invoice Record</span>
          				</a>
				</li>
				<!-- NavBar button - Menu -->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            					<img src="photo/menu_icon/menu.png" width="20" height="20">
            					<span class="nav-link-text"> Menu</span>
          				</a>
					<ul class="sidenav-second-level collapse" id="collapseMulti">
						<li>
							<a href="burger.php"><img src="photo/burger.png" width="20" height="20"> Burgers</a>
						</li>
						<li>
							<a href="snack.php"><img src="photo/snacks.png" width="20" height="20"> Snacks</a>
						</li>
						<li>
							<a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">
								<img src="photo/drink.png" width="20" height="20"> Drink</a>
							<ul class="sidenav-third-level collapse" id="collapseMulti2">
								<li>
									<a href="hotDrink.php"><img src="photo/hot-drink.png" width="20" height="20"> Hot Drink</a>
								</li>
								<li>
									<a href="coldDrink.php"><img src="photo/cold-drink.png" width="20" height="20"> Cold Drink</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="combo_set.php"><img src="photo/combo.png" width="20" height="20"> Combo</a>
						</li>
					</ul>
				</li>

			</ul>



			<!--	?????		-->
			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
            					<i class="fa fa-fw fa-angle-left"></i>
          				</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<!--	Message & Alerts			-->
				
<!--
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mr-lg-2" id="CartDropdown" href="shoppingCart.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="photo/shopping-cart.png" width="20" height="20">My Shopping Cart
						<span class="d-lg-none">My Shopping Cart
							<span class="badge badge-pill badge-primary">1 New</span>
						</span>
						<span class="indicator text-primary d-none d-lg-block">
							<i class="fa fa-fw fa-circle"></i>
						</span>
          				</a>
					<div class="dropdown-menu" aria-labelledby="CartDropdown">
						<h6 class="dropdown-header">My Shopping Cart:</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="">
              						<strong>Apple Pie</strong>
              						<span class="small float-right text-muted">Qty : 1</span>
              						<div class="dropdown-message small">$8.0</div>
            					</a>

						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="">View My Shopping Cart</a>
					</div>

				</li>
-->

				<li>
					<a class="nav-link mr-lg-2" href="shoppingCart.php">
						<img src="photo/shopping-cart.png" width="20" height="20"> My Shopping Cart
          				</a>
				</li>
				
<!--
				<li>
					<a class="nav-link mr-lg-2" href="voiceOrder.html">
						<img src="photo/voiceOrder.png" width="20" height="20"> Voice Order
          				</a>
				</li>
-->


				<li class="nav-item">
					<a class="nav-link" href="logout.php"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
				</li>
			</ul>



		</div>
	</nav>
	<div class="content-wrapper">	
	
	