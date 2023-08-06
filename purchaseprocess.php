<?php
include 'includes/conn.php';
if (isset($_POST['type'])) {
	$type = $_POST['type'];
    $store = $_POST['store'];
    $supplier = $_POST['supplier'];
    $category = $_POST['unitprice'];
    // $subcategory= $_POST['subcategory'];
    $item = $_POST['item'];
    $quantity= $_POST['quantity'];

	
	if (empty($type)) {
		$error = 'Enter Store Type to proceed';
		die(json_encode(array('items' => $error)));
	} else if (is_numeric($quantity) == FALSE) {
		$error = 'Quantity should be numeric';
		die(json_encode(array('items' => $error)));
	}else if (empty($item)) {
        $error = 'Enter Item to proceed';
        die(json_encode(array('items' => $error)));
    }
     else {
		foreach ($_POST as $key => $value) {
			$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
		}
		$id1 = $new_product['item'];

		$statement = $con->prepare("SELECT itemname  FROM inventoryitems WHERE inventoryitem_id=? LIMIT 1");
		$statement->bind_param('i', $id1);
		$statement->execute();
		$statement->bind_result($productname);
		while ($statement->fetch()) {
			$new_product["menuitem"] = $productname; //fetch product name from database
			$key = $new_product['item'];

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

		<div class="table" style="overflow:hidden; overflow-x:auto">

			<table class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Measurement Unit</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Subtotal</th>
						<th>Store</th>
						<!-- <th>Category</th> -->
						<th></th>
					</tr>
				</thead>
			<tbody>
				<tbody>
					<?php
					$totalcharge =0;
					foreach ($_SESSION["bproducts"] as $key => $product) { //loop though items and prepare html content

						//set variables to use them in HTML content below
						$menuitem = $product["menuitem"];
						$item_id = $product["item"];
                        $getmeasure = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id ='$item_id'");
                        $row1 = mysqli_fetch_array($getmeasure);
                        $measurement_id = $row1['measurement_id'];
						$product_qty = $product["quantity"];
						$store = $product["store"];
						$type = $product['type'];
						$supplier = $product['supplier'];
						
                        // $category = $product['category'];
						// $expiry = $product["expiry"];
						$getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
						$row2 =  mysqli_fetch_array($getunit);
						$measurement = $row2['measurement'];
							$getstore = mysqli_query($con, "SELECT * FROM stores WHERE status=1 AND store_id='$store'");
							$row4 = mysqli_fetch_array($getstore);
							$storename = $row4['store'];
							if ($supplier != 0)  {
								$supplieritems =  mysqli_query($con, "SELECT * FROM supplierproducts WHERE status=1 AND supplier_id='$supplier' AND product_id='$item_id'") or die(mysqli_error($con));
													   $rows =  mysqli_fetch_array($supplieritems);
													   $price = $rows['price'];
													   $subtotal = $product_qty * $price;
													   $totalcharge += $subtotal;
							   // $getcategory = mysqli_query($con, "SELECT * FROM itemcategories WHERE status = 1 AND itemcategory_id = '$category'");
							   // $row5 = mysqli_fetch_array($getcategory);
							   // $categoryname = $row5['category'];
							}else{
								$price = $product['unitprice'];
								$subtotal = $product_qty * $price;
								$totalcharge = $totalcharge + $subtotal;
							}
						
					?>
						<tr>
							<td><?php echo $menuitem; ?></td>
							<td><?php echo $measurement; ?></td>
							<td><?php echo $product_qty; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $subtotal; ?></td>
							<td><?php echo $storename; ?></td>
							<!-- <td><?php echo $categoryname ?></td> -->
							<!-- <td><?php echo $expiry; ?></td> -->
							<!-- <td><strong> ITEM :</strong> <?php echo $menuitem; ?><br>
								<strong> QTY :</strong> <?php echo $product_qty; ?><br>
								<strong>UNIT :</strong> <?php echo $measurement; ?><br>
							</td> -->

							<td><a href="#" class="remove-item text-danger" data-code="<?php echo $key; ?>"><i class="fa fa-trash"></i></a></td>
						</tr>
					<?php } ?>

				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" align="right"><strong>Total: <?php echo $totalcharge; ?></strong></td>
					</tr>
				</tfoot>
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
