$(document).ready(function () {
  function displayData() {
    let dataTable = $("#data-table").DataTable({
      processing: true,
      // serverSide: true,
      order: [],
      ajax: {
        url: "./includes/extractData.inc.php",
        method: "POST",
        data: {
          request_status: status,
        },
      },
      error: function () {
        alert("Fail!");
      },
    });
  }

  displayData();

  let addNewClient = $("#add-new-client");
  addNewClient.on("click", () => {
    let overlay = `
      <div class='overlay' id='overlay'>
        
      </div>
    `;
    let addNewContent = `<div class="container-create" id='container-create'>
      <div class="new-client" data-new-button id='new-client'>
          New customer
      </div>
      <div class="existing-client" data-existing-button id="existing-client">
          Existing customer
      </div>
    </div>`;

    $("body").append(overlay, addNewContent);
    $('body').css("overflow","hidden")
  });

  let newClientForm = `
      <div class="container-form" id="container-form">
        <form action="./includes/addNewClient.inc.php" method="POST">
            <div class="form-content">
                <label for="store-name">Store name:</label>
                <input type="text" name='store-name' data-input />
            </div>
            <div class="form-content">
                <label for="contact-person">Contact person:</label>
                <input type="text" name='contact-person' data-input />
            </div>
            <div class="form-content">
                <label for="contact-no">Contact no:</label>
                <input type="text" name='contact-no' id='contact-no' data-input />
            </div>
            <div class="form-content">
                <label for="address">Address</label>
                <input type="text" name='address' data-input />
            </div>
            <div class="form-span">
                <span id="alert-message"></span>
            </div>
            <div class="container-button">
                <button type="button" id='cancel-button'>Cancel</button>
                <button type="button" id='create-client'>Create</button>
            </div>
        </form>
      </div>
  `;

  $(document).on("click", "[data-new-button]", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $("#existing-client").show();
      $("#container-form").remove();
      $("#container-create").removeClass("active");
    } else {
      $("#existing-client").hide();
      $(this).addClass("active");
      $("#container-create").append(newClientForm);
      $("#container-create").addClass("active");
    }
  });

  $(document).on("click", "#cancel-button", function () {
    window.location.href = "./index.php";
  });

  $(document).on("click", "#create-client", () => {
    let inputValue = $("#container-form")
      .children()
      .children(".form-content")
      .children(":input");
    let alertMessage = $("#alert-message");

    let statusSend = [];

    for (let i = 0; i < inputValue.length; i++) {
      if (inputValue[i].value == "") {
        statusSend.push("1");
      }
    }

    if (statusSend.length == 0) {
      $.ajax({
        type: "POST",
        url: "./includes/validateClientNumber.inc.php",
        dataType: "json",
        data: {
          "request-status": inputValue[2].value,
        },
        contentType: "application/x-www-form-urlencoded;charset=utf8",
        success: function (data) {
          if (data > 0) {
            $("#alert-message").text("Contact number already exist!");
          } else {
            $("#container-form").children().submit();
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    } else {
      alertMessage.text("Please fill up all fields!");
    }
  });

  let existingForm = `
    <div class="existing-form">
          <div class="existing-container">
              <input type="text" name='existing-data' id="search-data" >
              <div class='existing-button' id='existing-button'>
              <button type="button" id="search">Search</button>
              <button type="button" id="cancel">cancel</button>
              </div>
          </div>
          <div class="form-span">
                <span id="alert-message"></span>
          </div>  
          <div class="container-clients"></div>
    </div>`;

  $(document).on("click", "#cancel", function () {
    window.location.href = "index.php";
  });

  $(document).on("click", "[data-existing-button]", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $("#new-client").show();
      $(".existing-form").hide();
      $("#container-create").removeClass("active");
    } else {
      $(this).addClass("active");
      $("#new-client").hide();
      $("#container-create").append(existingForm);
      $("#container-create").addClass("active");
    }
  });

  $(document).on("click", "#search", (e) => {
    let searchValue = $(".existing-form")
      .children(".existing-container")
      .children(":input")
      .val();

    if ($(".container-clients").length > 0) {
      $(".container-clients").children().remove();
    }

    if (searchValue == "") {
      $("#alert-message").text("TANGA MALI !!!");

      alert("Mali Tanga!!!");
      alert("Tanga !!!");
      alert("BOBO !!!");
      $(".existing-form").remove($(".container-clients"));
    } else {
      $.ajax({
        type: "POST",
        url: "./includes/existingClient.inc.php",
        data: {
          "request-status": searchValue,
        },
        success: function (data) {
          let dataCallback = JSON.parse(data);
          if (dataCallback.length == 0) {
            $("#alert-message").text("TANGA MALI !!!");
            alert("Mali Tanga!!!");
            alert("Tanga !!!");
            alert("BOBO !!!");
            $(".existing-form").remove($(".container-clients"));
          } else {
            $("#alert-message").text("");
            for (let i = 0; i < dataCallback.length; i++) {
              let eachDataTemplate = `
              <div class='clients-details' data-clients>
                <form action="./includes/placeOrder.inc.php" method='post'>
                <div class="clients" id="clients">${dataCallback[i].store_name}
                <input type='hidden' name="client-id" value="${dataCallback[i].id}" />
                </div>

                </form>
              </div>`;

              $(".existing-form")
                .children(".container-clients")
                .append(eachDataTemplate);
            }
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });

  $(document).on("click", "[data-clients]", function () {
    console.log($(this).children());
    $(this).children().submit();
  });

  $(document).on("click", "#overlay", function () {
    $("#container-create").remove();
    $(this).remove();
    $('body').css("overflow","auto")
  });


  function appendPreviewOrder(orders){
    for(let i = 1; i < orders.length - 1; i++){
      let createOrders = `<div class="preview-order-details">
                            <label>${orders[i].product_name}</label>
                            <label class='preview-price'>${orders[i].price}</label>
                          </div>`;
      $('.preview-orders').append(createOrders);
    }
  }

  function previewOrderTotalPrice(){
    let price = 0;
    let previewPrice = $(".preview-order-details");
    // for(let i = 0; i < previewPrice.length; i++){
    //   console.log(previewPrice[i])
    // }

    previewPrice.each(function(index,element) {
      // console.log($(this).children().last().text())
      price += parseInt($(this).children().last().text())
    })
    $('#total-price').html(price)
    // console.log($('#total-price'))
  }

  function createPreviewOrders(orderId){
    $.ajax({
      type: "POST",
      url: "./includes/previewOrders.inc.php",
      data: {
        "request-status": orderId
      },
      success: function(data){
        let clientDetails = JSON.parse(data);
        let orderId = clientDetails.length - 1;
        let previewDetails = `<div class="preview-order">
                                <div class="preview-details">
                                    <label class='preview-store-name'>${clientDetails[0].store_name}</label>
                                    <label>${clientDetails[0].contact_person}</label>
                                    <label>${clientDetails[0].contact_no}</label>
                                    <label>${clientDetails[0].address}</label>
                                </div>
                                <div class="preview-orders">
                                
                                </div>
                                <div class="preview-total">
                                    <label>TOTAL</label>
                                    <label id='total-price'></label>
                                </div>
                                <div class="preview-action">
                                    <button id='preview-cancel'>Cancel</button>
                                    <button id='preview-delivered'>Delivered</button>
                                    <input type='hidden' id='order-id' value='${clientDetails[orderId]}' />
                                </div>
                              </div>`;
        $("#container-body").children(".container-body-content").children("#body-left").children(".container-table").remove();
        $(".body-left").children(".title-group").children("label").text("ORDER DETAILS");

        if($(".preview-order").length > 0){
            $(".preview-order").remove();
            $("#container-body").children(".container-body-content").children("#body-left").children(".container-table").remove();
            $(".body-left").children(".title-group").children("label").text("ORDER DETAILS");
            $("#container-body").children(".container-body-content").children("#body-left").append(previewDetails);
        } else {
          $("#container-body").children(".container-body-content").children("#body-left").children(".container-table").remove();
          $(".body-left").children(".title-group").children("label").text("ORDER DETAILS");
          $("#container-body").children(".container-body-content").children("#body-left").append(previewDetails);
        }

        appendPreviewOrder(clientDetails);
        previewOrderTotalPrice();
      },
      error: function (error) {
        console.log(error);
      },
    });
    
  }

  $(document).on('click',".button-pending", function(){
    let orderId = $(this).parent().children("#order-id").html();
    createPreviewOrders(orderId);
  });

  $(document).on('click','#preview-cancel',function(){
    location.reload(true)
  })

  $(document).on('click','#preview-delivered',function(){
    if(confirm('Is this order delivered?') == true){
      $.ajax({
        type: "POST",
        url: "./includes/changeOrderStatus.inc.php",
        data: {
          'order-id': $("#order-id").val()
        },
        success: function(data){
          alert('Done');
          location.reload(true);
        }
      });
    // console.log($('#order-id').val());
    }
  })
  
});

