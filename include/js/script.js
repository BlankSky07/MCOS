$(document).ready(function() {

  $('#sidenavToggler').trigger('click');

//---------------INDEX-ALL-ORDERS------------------//

  $('#allOrdersIndexTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'On-Queue'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Processing'){
        $('td', row).css('background-color', '#ffe680');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Available/For Pick-Up'){
        $('td', row).css('background-color', '#99ff99');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Order Served'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//------------INDEX-ON-QUEUE-ORDERS--------------//

  $('#OnQueueIndexTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[5] == 'On-Queue'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//------------INDEX-PROCESSING-ORDERS--------------//

  $('#ProcessingIndexTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'Processing'){
        $('td', row).css('background-color', '#ffe680');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//------------INDEX-FOR-PICK-UP-ORDERS--------------//

  $('#ForPickUpIndexTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'Available/For Pick-Up'){
        $('td', row).css('background-color', '#99ff99');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//-------------INDEX-COMPLETED-ORDERS---------------//

  $('#CompletedIndexTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'Order Served'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//---------------INDEX-CART-----------------//

  $('#cartTable').DataTable({
      stateSave: true
  });

  $('#submitorder').hide()

//------------INDEX-NEW-ORDER---------------//

  $('#neworderTable').DataTable( {
        paging:         false,
    createdRow: function(row, data, index){

      if(data[3] == 'Pending'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
      }

      if(data[3] == 'Available'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
      }
    }
  });

//---------------GET-GROUP----------------//

  $('#customer-name').on('change', function() {

    var NewCID = parseInt($(this).val());
    //var NewCID = $("#NewOrderCID").text();
  
        
     $.post("../../include/getgroup.php", { 

          NewCID : NewCID

      }, function(data){

        $("#NewOrderGroup").text(data);

      });
 

  });


//---------------TIME-IN-OUT----------------//

  $('#txtMCStatusCID').on('change', function() {

    var MCID = parseInt($(this).val());
        
     $.post("../../include/getmcstatus.php", { 

          MCID : MCID

      }, function(data){

        $("#Attend").html(data);

      });

     $("#txtMCStatusCID").val('');

     $('#txtMCStatusCID').trigger('click');

  });

//---------------COUNTER----------------//

  $('#counterTable').DataTable( {
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'On-Queue'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

  $('#counterProcessingTable').DataTable( {
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'Processing'){
        $('td', row).css('background-color', '#ffe680');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

  $('#counterForPickUpTable').DataTable( {
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'Available/For Pick-Up'){
        $('td', row).css('background-color', '#99ff99');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//------------ADMIN-DASHBOARD------------//

  $('#DBordersTable').DataTable({
    scrollY: '40vh',
    scrollCollapse: true,
    paging: false,
    createdRow: function(row, data, index){

      if(data[5] == 'On-Queue'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
      }
    }
  });

  $('#DBcompletedTable').DataTable( {
    scrollY: '40vh',
    scrollCollapse: true,
    paging: false,
    createdRow: function(row, data, index){

      if(data[6] == 'Order Served'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
      }
    }
  });

  $('#DBpendingTable').DataTable( {
    scrollY: '40vh',
    scrollCollapse: true,
    paging: false,
    createdRow: function(row, data, index){

      if(data[3] == 'Pending'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
      }
    }
  });

//-----------ADMIN-ORDER-LIST------------//

  $('#ordersTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[6] == 'On-Queue'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Processing'){
        $('td', row).css('background-color', '#ffe680');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Available/For Pick-Up'){
        $('td', row).css('background-color', '#99ff99');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }

      if(data[6] == 'Order Served'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
        $('th', row).css('border-color', 'black');
        $('table', row).css('border-color', 'black');
      }
    }
  });

//---------ADMIN-INVENTORY-LIST----------//

  $('#inventoryTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[3] == 'Pending'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
      }

      if(data[3] == 'Available'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
      } 
    }
  });

//---------ADMIN-MANAGE-PERSONNEL----------//

  $('#manageTable').DataTable({
    paging: true,
    stateSave: true,
    createdRow: function(row, data, index){

      if(data[5] == 'Available'){
        $('td', row).css('background-color', '#99ebff');
        $('td', row).css('border-color', 'black');
      }
      if(data[5] == 'Not Available'){
        $('td', row).css('background-color', '#ffb3b3');
        $('td', row).css('border-color', 'black');
      }
    }
  });

  $('select').on('change', function() {
    var customerid = parseInt(this.value);
  });

   //Adding Items to Cart

   $('#neworderTable #addtocart').click(function() {
      
      var tr = $(this).closest('tr');
      var id = tr.children('td:eq(0)').text(); 

      $.post("../index/addtocart.php", {Inventory_ID : id}, function(data, status){

        var cartnum = parseInt($('#cart-num').text());
        var qtynum = parseInt($(".card-body" + id).find("#OrderQuantity").val());
        var cartfull = "Cart is Full";
        var cartid = cartnum-1;

        $('select').on('change', function() {

          var customerid = parseInt(this.value);

        });


          if(cartnum != 5){

              if($('.card-body'+id).length){
                  $(".card-body" + id).find("#OrderQuantity").val(qtynum + 1);
                  $('#submitorder').show()
              }

              else{

                  $('#cartdata').append(data);                  
                  $('#cart-num').text(cartnum + 1);
                  $('#cartitem').attr("id","cartitem"+cartnum);                  
                  $('#submitorder').show()

                  }
              }

          else{

            if($('.card-body'+id).length){

                  $(".card-body" + id).find("#OrderQuantity").val(qtynum + 1);
                  $('#submitorder').show()

              }

              else{

                 $('#cart-full').text(" - [" + cartfull + "]");
                 $('#submitorder').show()

              }    
          }

      });

    });

  $("#submitorder").click(function(){

  var UseCase = $("#txtUseCase").text();
  var invid1 = $("#cartitem0").find("#InventoryID").text();
  var invqty1 = $("#cartitem0").find("#OrderQuantity").val();

  var invid2 = $("#cartitem1").find("#InventoryID").text();
  var invqty2 = $("#cartitem1").find("#OrderQuantity").val();

  var invid3 = $("#cartitem2").find("#InventoryID").text();
  var invqty3 = $("#cartitem2").find("#OrderQuantity").val();

  var invid4 = $("#cartitem3").find("#InventoryID").text();
  var invqty4 = $("#cartitem3").find("#OrderQuantity").val();

  var invid5 = $("#cartitem4").find("#InventoryID").text();
  var invqty5 = $("#cartitem4").find("#OrderQuantity").val();

  var custname = $("#customer-name").children("option:selected").text();

  //var custgroup = $("#customer-name").children("option:selected").val();

  var custgroup = $("#NewOrderGroup").text();

  //var custgroup =parseInt($(this).val());

  $.post("../../include/addtocart.php", { 
    InvID1 : invid1, InvQTY1 : invqty1,
    InvID2 : invid2, InvQTY2 : invqty2,
    InvID3 : invid3, InvQTY3 : invqty3,
    InvID4 : invid4, InvQTY4 : invqty4,
    InvID5 : invid5, InvQTY5 : invqty5,
    UseCase : UseCase,
    CustName : custname,
    custgroup : custgroup
  }, function(data, status){
    
      alert('Your Order is Successfully Submitted.');
      location.reload ()

      });

  var cartnum = parseInt($('#cart-num').text());

  $('#cartitem0').remove();
  $('#cartitem1').remove();
  $('#cartitem2').remove();
  $('#cartitem3').remove();
  $('#cartitem4').remove();
  $('#cart-num').text("0");
  $('#submitorder').hide()

});

//--------------------//

//Update Modal for Manage Personnel
//Gets Data from Table to Modal
//Table

  var tablee = $('#manageTable').DataTable();
 
    $('#manageTable tbody').on( 'click', 'i', function () {

       var MCID = $(this).closest('tr').find('#txtMCIDTable').text();
       var MCCID = $(this).closest('tr').find('#txtCIDTable').text();
       var Fname = $(this).closest('tr').find('#txtMCFNameTable').text();
       var Lname = $(this).closest('tr').find('#txtMCLNameTable').text();


       $("#txtEditMCID").text(MCID);
       $("#txtEditMCCIDModal").val(MCCID);
       $("#txtEditMCFNameModal").val(Fname);
       $("#txtEditMCLNameModal").val(Lname);

    } );

//--------------------//


//-------------------------------ALL-ORDERS-PAGE-----------------------------//

//--------------------//

//Cancel Modal for All Orders Page
//Gets Data from Table to Modal
//Table

  var table = $('#allOrdersIndexTable').DataTable();
 
    $('#allOrdersIndexTable tbody').on( 'click', 'i', function () {

       var OrderID = $(this).closest('tr').find('#txtOrderID').text();
       var ItemName = $(this).closest('tr').find('#txtItemName').text();
       var ItemDesc = $(this).closest('tr').find('#txtItemDesc').text();

       $("#txtOrderIDModal").text(OrderID);
       $("#txtItemNameModal").text(ItemName);
       $("#txtItemDescModal").text(ItemDesc);

    } );

//--------------------//


//-------------------------------INVENTORY-PAGE------------------------------//


//--------------------//


//ADD ITEM
//Adds Item to the Database
//Modal

$("#btnAddtoInventory").click(function(){

var AddItemName = $("#txtItemNameModal").val();
var AddItemDesc = $("#txtItemDescModal").val();
var AddItemQty = $("#txtItemQtyModal").val();

var file_data = $('#file')[0].files[0];
var form_data = new FormData();

form_data.append('file', file_data);
form_data.append('AddItemName', AddItemName);
form_data.append('AddItemDesc', AddItemDesc);
form_data.append('AddItemQty', AddItemQty);

  $.ajax({
    url: '../../include/addtoinventory.php', 
    dataType: 'text', 
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',

    success: function (response) {
      $('#msg').html(response); // display success response from the server
      location.reload ()
    },

    error: function (response) {
      $('#msg').html(response); // display error response from the server
    }

  });

});


//--------------------//


//UPDATE ITEM
//Gets Data from Table to Modal
//Table

  var tblUpdateInventory = $('#inventoryTable').DataTable();
 
    $('#inventoryTable tbody').on( 'click', 'i', function () {

       var EditInventoryID = $(this).closest('tr').find('#txtInventoryIDTable').text();
       var EditItemName = $(this).closest('tr').find('#txtItemNameTable').text();
       var EditItemDesc = $(this).closest('tr').find('#txtItemDescTable').text();
       var EditItemQty = $(this).closest('tr').find('#txtItemQtyTable').text();
       var EditItemRemarks = $(this).closest('tr').find('#txtItemRemarksTable').text();

       $("#txtEditInventoryIDModal").text(EditInventoryID);
       $("#txtEditItemNameModal").val(EditItemName);
       $("#txtEditItemDescModal").val(EditItemDesc);
       $("#txtEditItemQtyModal").val(EditItemQty);
       $("#txtEditItemRemarksModal").val(EditItemRemarks);

    } );


//--------------------//


//DELETE ITEM
//Gets Data from Table to Modal
//Table

  var tblDeleteInventory = $('#inventoryTable').DataTable();
 
    $('#inventoryTable tbody').on( 'click', 'i', function () {

       var DeleteInventoryID = $(this).closest('tr').find('#txtInventoryIDTable').text();
       var DeleteItemName = $(this).closest('tr').find('#txtItemNameTable').text();
       var DeleteItemDesc = $(this).closest('tr').find('#txtItemDescTable').text();

       $("#txtDeleteInventoryIDModal").text(DeleteInventoryID);
       $("#txtDeleteItemNameModal").text(DeleteItemName);
       $("#txtDeleteItemDescModal").text(DeleteItemDesc);

    } );


    //--------------------//


//DELETE ITEM FROM MANAGE PERSONNEL
//Gets Data from Table to Modal
//Table

  var tblDeleteMC = $('#manageTable').DataTable();
 
    $('#manageTable tbody').on( 'click', 'i', function () {

       var DeleteMCID = $(this).closest('tr').find('#txtMCIDTable').text();
       var DeleteMCFName = $(this).closest('tr').find('#txtMCFNameTable').text();
       var DeleteMCLName = $(this).closest('tr').find('#txtMCLNameTable').text();
       var DeleteMCCID = $(this).closest('tr').find('#txtCIDTable').text();

       $("#txtDeleteMCIDModal").text(DeleteMCID);
       $("#txtDeleteMCFnameModal").text(DeleteMCFName);
       $("#txtDeleteMCLnameModal").text(DeleteMCLName);
       $("#txtDeleteMCCIDModal").text(DeleteMCCID);

    } );


//-------------------------------CUSTOMER-PAGE------------------------------//


//--------------------//


//ADD ITEM
//Adds Item to the Database
//Modal

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

$("#btnAddtoCustomer").click(function(){

var form = $("#AddCustomerForm");
    form.validate();

      if(form.valid()){

var AddCustomerName = $("#txtAddCustomerModal").val();
var AddCustomerCID = $("#txtAddCIDModal").val();

$.post("../include/addcustomer.php", { 

    AddCustomerName : AddCustomerName, 
    AddCustomerCID : AddCustomerCID

  }, function(data, status){

        location.reload ()

      });

}

});


//--------------------//


//UPDATE ITEM
//Gets Data from Table to Modal
//Table

  var tblEditCustomer = $('#customersTable').DataTable();
 
    $('#customersTable tbody').on( 'click', 'i', function () {

       var EditCustomerID = $(this).closest('tr').find('#txtCustomerIDTable').text();
       var EditCustomerName = $(this).closest('tr').find('#txtCustomerNameTable').text();
       var EditCID = $(this).closest('tr').find('#txtCustomerCIDTable').text();

       console.log(EditCustomerID)

       $("#txtEditCustomerIDModal").text(EditCustomerID);
       $("#txtEditCustomerNameModal").val(EditCustomerName);
       $("#txtEditCIDModal").val(EditCID);

    } );


//--------------------//


//DELETE ITEM
//Gets Data from Table to Modal
//Table

  var tblEditCustomer = $('#customersTable').DataTable();
 
    $('#customersTable tbody').on( 'click', 'i', function () {

       var EditCustomerID = $(this).closest('tr').find('#txtCustomerIDTable').text();
       var EditCustomerName = $(this).closest('tr').find('#txtCustomerNameTable').text();
       var EditCID = $(this).closest('tr').find('#txtCustomerCIDTable').text();

       console.log(EditCustomerID)

       $("#txtDeleteCustomerIDModal").text(EditCustomerID);
       $("#txtDeleteCustomerNameModal").text(EditCustomerName);
       $("#txtDeleteCIDModal").text(EditCID);

    } );

}); //End of Document Ready


//--------------------//

//UPDATE ITEM
//Updates Item to Inventory
//Modal

$("#btnEditInventory").click(function(){

var InventoryID = $("#txtEditInventoryIDModal").text();
var ItemName = $("#txtEditItemNameModal").val();
var ItemDesc = $("#txtEditItemDescModal").val();
var ItemQty = $("#txtEditItemQtyModal").val();
var ItemStatus = $("#txtEditItemStatusModal").val();
var ItemRemarks = $("#txtEditItemRemarksModal").text();

var file_data = $('#editfile')[0].files[0];
var form_data = new FormData();

form_data.append('file', file_data);
form_data.append('InventoryID', InventoryID);
form_data.append('ItemName', ItemName);
form_data.append('ItemDesc', ItemDesc);
form_data.append('ItemQty', ItemQty);
form_data.append('ItemStatus', ItemStatus);
form_data.append('ItemRemarks', ItemRemarks);

  $.ajax({
    url: '../../include/editinventory.php', 
    dataType: 'text', 
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',

    success: function (response) {
      $('#msg').html(response); // display success response from the server
      location.reload ()
    },

    error: function (response) {
      $('#msg').html(response); // display error response from the server
    }
    
  });

});


//--------------------//

//DELETE ITEM
//Deletes Item to Inventory
//Modal

$("#btnDeleteInventory").click(function(){

var InventoryID = $("#txtDeleteInventoryIDModal").text();

$.post("../../include/deleteinventory.php", { 

    InventoryID : InventoryID

  }, function(data, status){

        location.reload ()

      });

});

//-------------------------------CART-PAGE------------------------------//


//REMOVE ITEM
//Remove Item from the Cart
//Cart

function remove_cart(){

  var cartnum = parseInt($('#cart-num').text());

  $('#remove-cart').parent('[id^=cartitem]').remove();
  $('#cart-num').text(cartnum - 1);

  if(cartnum == 1){
    $('#submitorder').hide()
  }

};



//Cancel Order in All Orders Page
//Updates Database

$("#btnCancelOrder").click(function(){

var OrderID = $("#txtOrderIDModal").text();

$.post("../include/cancelorder.php", { 
    getOrderID : OrderID
  }, function(data, status){

        alert('Your is Successfully Cancelled.');
        location.reload ()

      });
});



//--------------------//

//UPDATE ITEM
//Updates Item to Customer
//Modal

$("#btnEditCustomer").click(function(){

var CustomerID = $("#txtEditCustomerIDModal").text();
var CustomerName = $("#txtEditCustomerNameModal").val();
var CustomerCID = $("#txtEditCIDModal").val();

$.post("../include/editcustomer.php", { 

    CustomerID : CustomerID, CustomerName : CustomerName, CustomerCID : CustomerCID

  }, function(data, status){

        location.reload ()

      });

});


//--------------------//

//DELETE ITEM
//Deletes Item to Customer
//Modal

$("#btnDeleteCustomer").click(function(){

var CustomerID = $("#txtDeleteCustomerIDModal").text();

$.post("../include/deletecustomer.php", { 

    CustomerID : CustomerID

  }, function(data, status){

        location.reload ()

      });

});


//-------------------------------ITEM------------------------------//


//--------------------//


//UPDATE SERVED QTY1
//Updates Served Qty1 to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnDoneItem1', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var ServedQty = $("#txtServedQty1").val();

    $.post("../../include/updateitemstatus.php", { 

        ServedQty : ServedQty,
        OrderID : OrderID

      }, function(data, status){

            location.reload ()

          });


});


//--------------------//


//--------------------//


//UPDATE SERVED QTY2
//Updates Served Qty2 to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnDoneItem2', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var ServedQty = $("#txtServedQty2").val();

    $.post("../../include/updateitemstatus2.php", { 

        ServedQty : ServedQty,
        OrderID : OrderID

      }, function(data, status){

            location.reload ()

          });


});


//--------------------//

//--------------------//


//UPDATE SERVED QTY3
//Updates Served Qty3 to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnDoneItem3', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var ServedQty = $("#txtServedQty3").val();

    console.log(ServedQty);

    console.log(OrderID);

    $.post("../../include/updateitemstatus3.php", { 

        ServedQty : ServedQty,
        OrderID : OrderID

      }, function(data, status){

            console.log(data);

            location.reload ()

          });


});


//--------------------//


//--------------------//


//UPDATE SERVED QTY4
//Updates Served Qty4 to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnDoneItem4', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var ServedQty = $("#txtServedQty4").val();

    console.log(ServedQty);

    console.log(OrderID);

    $.post("../../include/updateitemstatus4.php", { 

        ServedQty : ServedQty,
        OrderID : OrderID

      }, function(data, status){

            console.log(data);

            location.reload ()

          });


});


//--------------------//


//--------------------//


//UPDATE SERVED QTY5
//Updates Served Qty5 to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnDoneItem5', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var ServedQty = $("#txtServedQty5").val();

    console.log(ServedQty);

    console.log(OrderID);

    $.post("../../include/updateitemstatus5.php", { 

        ServedQty : ServedQty,
        OrderID : OrderID

      }, function(data, status){

            console.log(data);

            location.reload ()

          });


});


//--------------------//




//--------------------//


//SERVED ORDER
//Updates Status to Available for Pick-up to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnOrderPrepared', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID1').text();

    console.log(OrderID);

    $.post("../../include/updateorderprepared.php", { 

        OrderID : OrderID

      }, function(data, status){

            console.log(data);

            location.reload ()

          });


});


//--------------------//




//--------------------//


//UPDATE MC Personnel
//Updates MC Personnel to the Database
//Button


$('#counterTable tbody').on( 'click', '#btnMC', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    var MC = $("#txtMC").val();

    console.log(MC);

    $.post("../../include/updatemc.php", { 

        MC : MC,
        OrderID : OrderID

      }, function(data, status){

            console.log(data);

            location.reload ()

          });


});


//--------------------//




//--------------------//


//UPDATE MC Personnel
//Updates MC Personnel to the Database
//Button


$('#counterProcessingTable tbody').on( 'click', '#btnOrderPrepared', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();

    $.post("../../include/updateorderprepared.php", { 

        OrderID : OrderID

      }, function(data, status){

            location.reload ()

        });


});


//--------------------//


//--------------------//


//UPDATE MC Personnel
//Updates MC Personnel to the Database
//Button


$('#counterForPickUpTable tbody').on( 'click', '#btnOrderServed', function(){

    var OrderID = $(this).closest('tr').find('#ItemOrderID').text();
    var ReceiverCID = $("#ReceiverCID").val();

    $.post("../../include/updateorderserved.php", { 

        OrderID : OrderID,
        ReceiverCID : ReceiverCID


      }, function(data, status){

            location.reload ()

        });


});


//--------------------//




//--------------------//

//Add MC Personnel
//Add MC to Inventory
//Modal

$("#btnAddMC").click(function(){

  var MCFName = $("#txtFNameModal").val();
  var MCLName = $("#txtLNameModal").val();
  var MCCID = $("#txtCIDModal").val();

  var file_data = $('#AddMCPhoto')[0].files[0];
  var form_data = new FormData();

  form_data.append('file', file_data);
  form_data.append('MCFName', MCFName);
  form_data.append('MCLName', MCLName);
  form_data.append('MCCID', MCCID);

  $.ajax({
    url: '../../include/addmc.php', 
    dataType: 'text', 
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',

    success: function (response) {
      $('#msg').html(response); // display success response from the server
      location.reload ()
    },

    error: function (response) {
      $('#msg').html(response); // display error response from the server
    }

  });

});


//--------------------//




//--------------------//

//DELETE ITEM
//DELETE MC to Database
//Modal

$("#btnDeleteMC").click(function(){

  var MCID = $("#txtDeleteMCIDModal").text();

  $.post("../../include/deletemc.php", { 
 
      MCID : MCID

    }, function(data, status){

          location.reload ()

        });

});


//--------------------//

//--------------------//

//UPDATE ITEM
//Updates MC to DATABASE
//Modal

$("#btnEditMC").click(function(){

  var MCID = $("#txtEditMCID").text();
  var MCFName = $("#txtEditMCFNameModal").val();
  var MCLName = $("#txtEditMCLNameModal").val();
  var MCCID = $("#txtEditMCCIDModal").val();

  var file_data = $('#EditMCPhoto')[0].files[0];
  var form_data = new FormData();

  form_data.append('file', file_data);
  form_data.append('MCID', MCID);
  form_data.append('MCFName', MCFName);
  form_data.append('MCLName', MCLName);
  form_data.append('MCCID', MCCID);

    $.ajax({
    url: '../../include/updatemcmanage.php', 
    dataType: 'text', 
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',

    success: function (response) {
      $('#msg').html(response); // display success response from the server
      location.reload ()
    },

    error: function (response) {
      $('#msg').html(response); // display error response from the server
    }

  });


});


//--------------------//


//--------------------//

//UPDATE MCSTATUS
//Updates MC to DATABASE
//Modal



//--------------------//

//---------------------------------DESIGN-------------------------------//

(function($) {
  "use strict";

  $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
  })
  
  $("#sidenavToggler").click(function(e) {
    e.preventDefault();
    $("body").toggleClass("sidenav-toggled");
    $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
    $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
  });
  
  $(".navbar-sidenav .nav-link-collapse").click(function(e) {
    e.preventDefault();
    $("body").removeClass("sidenav-toggled");
  });
  
  $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
    var e0 = e.originalEvent,
      delta = e0.wheelDelta || -e0.detail;
    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
    e.preventDefault();
  });
  
  $(document).scroll(function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });
 
  $('[data-toggle="tooltip"]').tooltip()
  
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });
})(jQuery); 

function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getYear(); 
x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
document.getElementById('ct').innerHTML = x1;
display_c();
 }

 function loadlink(){
    $('#mainscreenTable').load('mainscreenview.php #mainscreenTable', function () {
      $(this).unwrap();
    });
}

setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 1000);