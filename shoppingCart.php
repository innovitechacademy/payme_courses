<?php 
	session_start();
?>
<?php include 'header_member.php';?>

<div class="container-fluid">

	<?php	
		$mID;		
		if(isset($_SESSION['userID'])){					
			$mID = $_SESSION['userID'];
		}
	?>

		<script>
		
			function sendForm(formID) {
				document.getElementById(formID).submit();
			}

			function less(id, action, formID) {

				var num = parseInt(document.getElementById(id).value);

				if (!(num - 1 <= 0))
					document.getElementById(id).value = num - 1;
				document.getElementById(action).value = "LESS";
				//alert(formID);
				sendForm(formID);
			}


			function add(id, action, formID) {

				var num = parseInt(document.getElementById(id).value);
				if (!(num + 1 > 10))
					document.getElementById(id).value = num + 1;

				document.getElementById(action).value = "ADD";
				//alert(formID);
				sendForm(formID);

			}

			function whenChange(o, action, formID) {
				if (parseInt(o.value) <= 0 || parseInt(o.value) > 10) {
					o.value = "1";
				}
				document.getElementById(action).value = "CHANGE";
				//alert(formID);
				sendForm(formID);
			}


			function deleteItem(action, formID) {
				document.getElementById(action).value = "DELETE";
				//alert(formID);
				sendForm(formID);
			}


			function clearAll() {

				var o = document.getElementById("allItemID");
				if (!(o.value == null || o.value == "")) {
					document.getElementById("action").value = "clearAll";
					sendForm("allItemIDForm");
					alert("Clear all order success.");
				} else {
					alert("Nothing to remove.");
				}
			}

			function orderAll() {
				//sendForm("typeForm");
                var type = document.getElementById("typeI").value;
                var invoiceType = document.getElementById("invoiceType");
                invoiceType.value = type;
				var o = document.getElementById("allItemID");
				if (!(o.value == null || o.value == "")) {

					document.getElementById("action").value = "orderAll";
					sendForm("allItemIDForm");
					alert("Order success.");
				} else {
					alert("Nothing to order.");
				}
			}

		</script>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><img src="photo/bk_shopping-cart.png" width="20" height="20"> My Shopping Cart ---> Order</li>
		</ol>

		<?php	
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "unnovieshop_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname)
				or die('<span style="color:blue;">'.mysqli_connect_error()."</span>");
	
			$div = "";
			$allItemID = "";
			$allItemQty = "";

			$sql = "SELECT * FROM shopping_cart WHERE memberID = '".$mID."'";
			$result = $conn->query($sql);
			$numResults = mysqli_num_rows($result);
	
			$sql = "SELECT * FROM combo_shopping_cart WHERE memberID = '".$mID."'";
   			$result = $conn->query($sql);
   			$numResults += mysqli_num_rows($result);

			$i = 0;
			$icon = "";	$s="";
			$price = 0.0;	
					
			$sql = "SELECT * FROM item, shopping_cart, main_item WHERE item.itemID = shopping_cart.itemID and main_item.itemID = shopping_cart.itemID and memberID='".$mID."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // output data of each row
				//$row = mysqli_fetch_array($result);
				if (!$result) {
				    printf("Error: %s\n", mysqli_error($conn));
				    exit();
				}



				while($row = mysqli_fetch_array($result)){
					$price = $row['price'];
					$icon = "<img src=\"photo/bk_burger.png\" width=\"20\" height=\"20\">";

					//$icon = "<img src=\"photo/bk_snack.png\" width=\"20\" height=\"20\">";

					//$icon = "<img src=\"photo/bk_drink.png\" width=\"20\" height=\"20\">";



					$allItemID .= $row['itemID'].((--$numResults == $i)?"":",");
					$allItemQty .= $row['qty'].(($i == $numResults)?"":",");
					$div .= "		<form method=\"POST\" action=\"handleShoppingCart.php\" id=\"form".$row['itemID']."\">
						<div class=\"card\">
			      <div class=\"row\">
			        <div class=\"col-md-3\">
					<center>
				  <img src=\"photo/".$row['itemImg']."\" width=\"260\" height=\"260\" style=\"padding:0.3cm;\" class=\"col-md-10\">
						</center>
				</div>
				<div class=\"col-md-5 px-2\">
				  <div class=\"card-block px-3\">
				    <h2 class=\"card-title\">$icon";
						  $div.=" ".$row['itemName']."</h2>
				    <p class=\"card-text\">".$row['itemDesc']."</p>";
						  $div.="								<input name=\"itemID\" value=\"".$row['itemID']."\" readonly hidden/>
											<input name=\"memberID\" value=\"".$mID."\" readonly hidden/>
											<input id=\"action".$row['itemID']."\" name=\"action\" value=\"\" readonly hidden/>
											<table>
												<tr><td colspan=\"3\"><center><h2>$".$price." / per one</h2></center></td></tr>
												<tr><td style=\"width:50px;\"> 
												<a onclick=\"less('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">-</a></td>
												<td><input type=\"number\" onchange=\"whenChange(this, 'action".$row['itemID']."','form".$row['itemID']."')\" id=\"num".$row['itemID']."\" class=\"form-control\" name=\"qty\" min=\"1\" max=\"10\" size=\"3\" value=\"".$row['qty']."\"></td>
												<td style=\"width:50px;\"><a onclick=\"add('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">+</a></td></tr>
												</table>            
												</div>
				</div>



					   <div class=\"col-md-3 px-2\" style=\"padding:2cm;\">
				  <div class=\"card-block px-1\">
				    <p class=\"card-text\"><h4>Total : $".($row['price']*$row['qty'])."</h4></p>
						  <p class=\"card-text\"><a class=\"btn btn-danger\" onclick=\"deleteItem('action".$row['itemID']."','form".$row['itemID']."');\">Delete item</a></p>
				  </div>
				</div>

			        </div>
			      </div>
					</form>";

				}
			}

			$sql = "SELECT * FROM item, shopping_cart, side_dish WHERE item.itemID = shopping_cart.itemID and side_dish.itemID = shopping_cart.itemID and memberID='".$mID."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // output data of each row
				//$row = mysqli_fetch_array($result);
			if (!$result) {
			    printf("Error: %s\n", mysqli_error($conn));
			    exit();
			}



			while($row = mysqli_fetch_array($result)){
				$price = $row['price'];
			//$icon = "<img src=\"photo/bk_burger.png\" width=\"20\" height=\"20\">";

			$icon = "<img src=\"photo/bk_snack.png\" width=\"20\" height=\"20\">";

			//$icon = "<img src=\"photo/bk_drink.png\" width=\"20\" height=\"20\">";




				$allItemID .= $row['itemID'].((--$numResults == $i)?"":",");
				$allItemQty .= $row['qty'].(($i == $numResults)?"":",");
			$div .= "		<form method=\"POST\" action=\"handleShoppingCart.php\" id=\"form".$row['itemID']."\">
						<div class=\"card\">
			      <div class=\"row\">
			        <div class=\"col-md-3\">
					<center>
				  <img src=\"photo/".$row['itemImg']."\" width=\"260\" height=\"260\" style=\"padding:0.3cm;\" class=\"col-md-10\">
						</center>
				</div>
				<div class=\"col-md-5 px-2\">
				  <div class=\"card-block px-3\">
				    <h2 class=\"card-title\">$icon";
						  $div.=" ".$row['itemName']."</h2>
				    <p class=\"card-text\">".$row['itemDesc']."</p>";
						  $div.="								<input name=\"itemID\" value=\"".$row['itemID']."\" readonly hidden/>
											<input name=\"memberID\" value=\"".$mID."\" readonly hidden/>
											<input id=\"action".$row['itemID']."\" name=\"action\" value=\"\" readonly hidden/>
											<table>
												<tr><td colspan=\"3\"><center><h2>$".$price." / per one</h2></center></td></tr>
												<tr><td style=\"width:50px;\"> 
												<a onclick=\"less('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">-</a></td>
												<td><input type=\"number\" onchange=\"whenChange(this, 'action".$row['itemID']."','form".$row['itemID']."')\" id=\"num".$row['itemID']."\" class=\"form-control\" name=\"qty\" min=\"1\" max=\"10\" size=\"3\" value=\"".$row['qty']."\"></td>
												<td style=\"width:50px;\"><a onclick=\"add('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">+</a></td></tr>
												</table>            
												</div>
				</div>



					   <div class=\"col-md-3 px-2\" style=\"padding:2cm;\">
				  <div class=\"card-block px-1\">
				    <p class=\"card-text\"><h4>Total : $".($row['price']*$row['qty'])."</h4></p>
						  <p class=\"card-text\"><a class=\"btn btn-danger\" onclick=\"deleteItem('action".$row['itemID']."','form".$row['itemID']."');\">Delete item</a></p>
				  </div>
				</div>

			        </div>
			      </div>
					</form>";

			}
		}

			$sql = "SELECT * FROM item, shopping_cart, drink WHERE item.itemID = shopping_cart.itemID and drink.itemID = shopping_cart.itemID and memberID='".$mID."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // output data of each row
				//$row = mysqli_fetch_array($result);
			if (!$result) {
			    printf("Error: %s\n", mysqli_error($conn));
			    exit();
			}



				while($row = mysqli_fetch_array($result)){

					$price = $row['price'];
				//$icon = "<img src=\"photo/bk_burger.png\" width=\"20\" height=\"20\">";

				//$icon = "<img src=\"photo/bk_snack.png\" width=\"20\" height=\"20\">";

				//$icon = "<img src=\"photo/bk_drink.png\" width=\"20\" height=\"20\">";


				if($row['itemType']=="Hot Drink")
					$icon = "<img src=\"photo/bk_hotDrink.png\" width=\"20\" height=\"20\">";
				else if($row['itemType']=="Cold Drink"){
					$icon = "<img src=\"photo/bk_coldDrink.png\" width=\"20\" height=\"20\">";
				}




					$allItemID .= $row['itemID'].((--$numResults == $i)?"":",");
					$allItemQty .= $row['qty'].(($i == $numResults)?"":",");
				$div .= "		<form method=\"POST\" action=\"handleShoppingCart.php\" id=\"form".$row['itemID']."\">
							<div class=\"card\">
				      <div class=\"row\">
				        <div class=\"col-md-3\">
						<center>
					  <img src=\"photo/".$row['itemImg']."\" width=\"260\" height=\"260\" style=\"padding:0.3cm;\" class=\"col-md-10\">
							</center>
					</div>
					<div class=\"col-md-5 px-2\">
					  <div class=\"card-block px-3\">
					    <h2 class=\"card-title\">$icon";
							  $div.=" ".$row['itemName']."</h2>
					    <p class=\"card-text\">".$row['itemDesc']."</p>";
							  $div.="								<input name=\"itemID\" value=\"".$row['itemID']."\" readonly hidden/>
												<input name=\"memberID\" value=\"".$mID."\" readonly hidden/>
												<input id=\"action".$row['itemID']."\" name=\"action\" value=\"\" readonly hidden/>
												<table>
													<tr><td colspan=\"3\"><center><h2>$".$price." / per one</h2></center></td></tr>
													<tr><td style=\"width:50px;\"> 
													<a onclick=\"less('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">-</a></td>
													<td><input type=\"number\" onchange=\"whenChange(this, 'action".$row['itemID']."','form".$row['itemID']."')\" id=\"num".$row['itemID']."\" class=\"form-control\" name=\"qty\" min=\"1\" max=\"10\" size=\"3\" value=\"".$row['qty']."\"></td>
													<td style=\"width:50px;\"><a onclick=\"add('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">+</a></td></tr>
													</table>            
													</div>
					</div>



						   <div class=\"col-md-3 px-2\" style=\"padding:2cm;\">
					  <div class=\"card-block px-1\">
					    <p class=\"card-text\"><h4>Total : $".($row['price']*$row['qty'])."</h4></p>
							  <p class=\"card-text\"><a class=\"btn btn-danger\" onclick=\"deleteItem('action".$row['itemID']."','form".$row['itemID']."');\">Delete item</a></p>
					  </div>
					</div>

				        </div>
				      </div>
						</form>";

				}


			}
	
	
			$sql = "SELECT * FROM item, combo_shopping_cart, combo_info WHERE item.itemID = combo_info.itemID and combo_info.comboID = combo_shopping_cart.comboID and memberID='".$mID."'";
				
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // output data of each row
				//$row = mysqli_fetch_array($result);
			if (!$result) {
			    printf("Error: %s\n", mysqli_error($conn));
			    exit();
			}

				while($row = mysqli_fetch_array($result)){

					$price = $row['price'];

					$icon = "<img src=\"photo/bk_combo.png\" width=\"20\" height=\"20\">";

					$allItemID .= $row['itemID'].((--$numResults == $i)?"":",");
					$allItemQty .= $row['qty'].(($i == $numResults)?"":",");
				$div .= "		<form method=\"POST\" action=\"handleShoppingCart.php\" id=\"form".$row['itemID']."\">
							<div class=\"card\">
				      <div class=\"row\">
				        <div class=\"col-md-3\">
						<center>
					  <img src=\"photo/".$row['itemImg']."\" width=\"260\" height=\"260\" style=\"padding:0.3cm;\" class=\"col-md-10\">
							</center>
					</div>
					<div class=\"col-md-5 px-2\">
					  <div class=\"card-block px-3\">
					    <h2 class=\"card-title\">$icon";
							  $div.=" ".$row['itemName']."</h2>";
							  $div.="								
							  <input name=\"itemID\" value=\"".$row['itemID']."\" readonly hidden/>
							  <input name=\"comboID\" value=\"".$row['comboID']."\" readonly hidden/>
												<input name=\"memberID\" value=\"".$mID."\" readonly hidden/>
												<input id=\"action".$row['itemID']."\" name=\"action\" value=\"\" readonly hidden/>

												<table>
													<tr><td colspan=\"3\"><center><h2>$".$price." / per one</h2></center></td></tr>
													<tr><td style=\"width:50px;\"> 
													<a onclick=\"less('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">-</a></td>
													<td><input type=\"number\" onchange=\"whenChange(this, 'action".$row['itemID']."','form".$row['itemID']."')\" id=\"num".$row['itemID']."\" class=\"form-control\" name=\"qty\" min=\"1\" max=\"10\" size=\"3\" value=\"".$row['qty']."\"></td>
													<td style=\"width:50px;\"><a onclick=\"add('num".$row['itemID']."', 'action".$row['itemID']."','form".$row['itemID']."');\" class=\"w3-button w3-large w3-circle w3-xlarge w3-ripple w3-grey\" style=\"height:50px;width:50px;\">+</a></td></tr>
												</table>  
													</div>
					</div>



						   <div class=\"col-md-3 px-2\" style=\"padding:2cm;\">
					  <div class=\"card-block px-1\">
					    <p class=\"card-text\"><h4>Total : $".($row['price']*$row['qty'])."</h4></p>
							  <p class=\"card-text\"><a class=\"btn btn-danger\" onclick=\"deleteItem('action".$row['itemID']."','form".$row['itemID']."');\">Delete item</a></p>
					  </div>
					</div>

				        </div>
				      </div>
						</form>";
				}
			}
				mysqli_close($conn);
		
							echo "<form method=\"POST\" action=\"handleShoppingCart.php\" id=\"allItemIDForm\">
							<input name=\"memberID\" value=\"".$mID."\"readonly  hidden/>
							<input id=\"action\" name=\"action\" value=\"\" readonly hidden/>
							<input id=\"allItemID\" name=\"allItemID\" value=\"".$allItemID."\"readonly  hidden/>
							<input id=\"allItemQty\" name=\"allItemQty\" value=\"".$allItemQty."\" readonly hidden/>
                            <input id=\"invoiceType\" name=\"invoiceType\" value=\"\" readonly hidden/>
							</form>".$div;
						
		?>
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			
			<div class="row">
				<div class="col-lg-12">
					<div class="card mb-3">
						<div class="card-body">
							<center>
								
								
									Order Method :
									<select name="typeI" id="typeI">
										<option value="Take-out">Take-out</option>
										<option value="Dine-in">Dine-in</option>
										<option value="Delivery">Delivery</option>
									</select>
								
								
								<br>

								<input type="button" onclick="clearAll()" class="btn btn-secondary btn-lg" name="clear" value="Clear All">
								<input type="button" onclick="orderAll()" class="btn btn-secondary btn-lg" name="order" value="Order Now">

							</center>
						</div>

					</div>
				</div>
			</div>

</div>

<?php include 'footer_member.php';?>