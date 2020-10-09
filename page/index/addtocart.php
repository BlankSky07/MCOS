<?php

$conn = mysqli_connect("localhost","root","","mosdb");


  if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

		$id=$_POST['Inventory_ID']; 
	
		$query=mysqli_query($conn,"SELECT * FROM `tblinventory` WHERE Inventory_ID='$id'");
		
		if (mysqli_num_rows($query) == 0){

			echo "Item not Found in Database!";
		
    }
		else {
			
      $row=mysqli_fetch_array($query);

			echo'
          <div class="card darkgrey o-hidden h-100" id="cartitem">
            <div class="card-body'.$row['Inventory_ID'].'">
              <div class="card-body-icon red">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>

              <div class="mr-5" name="OrderNumber" id="OrderNumber"><strong>Inventory_ID #:</strong><strong id="InventoryID" name="InventoryID">'.$row['Inventory_ID'].'</strong> </div>
              <div class="mr-5" id="ItemName"><strong>Item:</strong> '.$row['Item_Name'].'</div>
              <div class="mr-5" id="ItemDescription"><strong>Description:</strong> '.$row['Item_Description'].'</div>
              <div class="mr-5">QTY:<input type="text" value="1" name="OrderQuantity" id="OrderQuantity"></strong></div>
                         
            </div>

            <a class="card-footer darkgrey clearfix small z-1" href="#" id="remove-cart" onclick="remove_cart()">                  
              <span class="float-left">Remove</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i> 
              </span>
            </a>
          </div>';} ?>