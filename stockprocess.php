<?php
include 'includes/conn.php';
if (isset($_POST['item_id'])) {
	$pquantity = $_POST['product_qty'];
	$measurement_id = $_POST['measurement_id'];
	$expiry = $_POST['expiry'];
	
	if (empty($pquantity)) {
		$error = 'Enter Quantity to proceed';
		die(json_encode(array('items' => $error)));
	} else if (is_numeric($pquantity) == FALSE) {
		$error = 'Quantity should be numeric';
		die(json_encode(array('items' => $error)));
	} else {
		foreach ($_POST as $key => $value) {
			$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
		}
		$id1 = $new_product['item_id'];

		$statement = $con->prepare("SELECT itemname  FROM inventoryitems WHERE inventoryitem_id=? LIMIT 1");
		$statement->bind_param('i', $id1);
		$statement->execute();
		$statement->bind_result($productname);
		while ($statement->fetch()) {
			$new_product["menuitem"] = $productname; //fetch product name from database
			$key = $new_product['item_id'];

			if (isset($_SESSION["bproducts"])) {  //if session var already exist
				if (isset($_SESSION["bproducts"][$key])) //check item exist in products array
				{
					$i = 1;
					while (isset($_SESSION['bproducts'][$key.'_'.$i]))
						$i++; //unset old item
					$key .= "_".$i;
				}
			}

			$_SESSION["bproducts"][$key] = $new_product;	//update products with new item array	
		}

		$total_items = count($_SESSION["bproducts"]); //count total items
		die(json_encode(array('items' => $total_items))); //output json 
	}
}
################## list products in cart ###################
if (isset($_POST["load_cart"]) && $_POST["load_cart"] == 1) {

	if (isset($_SESSION["bproducts"]) && count($_SESSION["bproducts"]) > 0) { //if we have session variable
		//		$cart_box = '<ul class="cart-products-loaded">';
		//$total = 0;

?>

		<div class="table">

			<table class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Measurement Unit</th>
						<th>Quantity</th>
						<th>Expiry</th>
						<th></th>
					</tr>
				</thead>
			<tbody>
				<tbody>
					<?php
					foreach ($_SESSION["bproducts"] as $key => $product) { //loop though items and prepare html content

						//set variables to use them in HTML content below
						$menuitem = $product["menuitem"];
						$item_id = $product["item_id"];
						$product_qty = $product["product_qty"];
						$expiry = $product["expiry"];
						$measurement_id = $product["measurement_id"];
						$getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
						$row2 =  mysqli_fetch_array($getunit);
						$measurement = $row2['measurement'];
					?>
						<tr>
							<td><?php echo $menuitem; ?></td>
							<td><?php echo $measurement; ?></td>
							<td><?php echo $product_qty; ?></td>
							<td><?php echo $expiry; ?></td>
							<!-- <td><strong> ITEM :</strong> <?php echo $menuitem; ?><br>
								<strong> QTY :</strong> <?php echo $product_qty; ?><br>
								<strong>UNIT :</strong> <?php echo $measurement; ?><br>
							</td> -->

							<td><a href="#" class="remove-item text-danger" data-code="<?php echo $key; ?>"><i class="fa fa-trash"></i></a></td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div><!-- /table-responsive -->


<?php

	} else {
		die("No items added yet"); //we have empty cart
	}
}

################# remove item from shopping cart ################
if (isset($_GET["remove_code"]) && isset($_SESSION["bproducts"])) {
	$item_id   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

	if (isset($_SESSION["bproducts"][$item_id])) {
		unset($_SESSION["bproducts"][$item_id]);
	}

	$total_items = count($_SESSION["bproducts"]);
	die(json_encode(array('items' => $total_items)));
}
