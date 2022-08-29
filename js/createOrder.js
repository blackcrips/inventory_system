$(document).ready(function () {
  function getProducts(buttonName, columnName) {
    $.ajax({
      type: "POST",
      url: "./includes/fetchProducts.inc.php",
      data: {
        "request-status": buttonName,
        "get-column": columnName,
      },
      success: function (data) {
        let productList = JSON.parse(data);

        if(columnName == 'product-name')
        {
          createProductNameButton(productList, buttonName);
        }
        else
        {
          showOrderDetails(productList);
          storeProductDescription = productList;
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  function createProductNameButton(productList, buttonName) {
    let containerButtons = $(".container-order-buttons");
    let itemButton = `
    <div class='main-category' id='main-category'>
      
    </div>`;
    containerButtons.append(itemButton);
    for (let i = 0; i < productList.length; i++) {
      let nameButtons = `<div class="category-button" data-name-buttons>${productList[i]}</div>`;
      $("#main-category").append(nameButtons);
    }
  }

  let storeCategory = []; // order details are store here

  // 1st action of button when placing an order
  $(document).on("click", "[data-main-buttons]", function () {
    let categoryName = $(this).html();
    getProducts(categoryName, "product-name");
    $(".main-category").hide();
    storeCategory.push(categoryName);
  });

  // Second action of button when placing an order
  $(document).on("click", "[data-name-buttons]", function () {
    let productName = $(this).html();
    let categoryName = storeCategory[0];
    getProducts(productName, categoryName);
    storeCategory.push(productName);
    $('#container-description').fadeIn();
  });
  
  $(document).on('click','#enter-price',() => {
    $('.manual-price').css('display','flex');
  });
  
  function showOrderDetails(array)
  {
    let category = array[0]['category'];
    let productName = array[0]['product_name'];
    let orderDetails = `<div class="order-options">
                              <div class="order-title">
                                <div class='order-description'>
                                  <div>${category}</div>
                                  <div>${productName}</div>
                                </div>
                                <div class='show-price'>

                                </div>
                              </div>
                          </div>
                          <hr>
                          <hr>
                          <div class="order-lists">
                              
                          </div>
                          <div class="manual-price">
                              <label for="input-price">Input price:</label>
                              <input type="input-price" id="input-price" name="input-price">
                              <textarea name="remarks" id="remarks" cols="30" rows="10" placeholder="Remarks here"></textarea>
                          </div>`;
    $('#container-description').append(orderDetails);
    getProductDescription(array);
  }

  // store product details upon choosing products
  let storeProductDescription;
  let buttonDescription;

  $(document).on('click', "[data-product-description]", function() {
    storeProductDescription.forEach(element => {
      if($(this).html() == element['product_description']){
        $('.show-price').html("P " + element['price']);
      }
    });
  });

  function getProductDescription(array)
  {
    array.forEach(element => {
      let productDescription = `<button data-product-description class='button-description'>${element['product_description']}</button>`;
      $('.order-lists').append(productDescription);
    });
    
    let enterPrice = `<button id='enter-price'>Enter Price</button>`;
    $('.order-lists').append(enterPrice);
  }


  function getPrices(
    categoryName,
    productName,
    productDescription,
    buttonName
  ) {
    $.ajax({
      type: "POST",
      url: "./includes/getPrices.inc.php",
      data: {
        "category-name": categoryName,
        "product-name": productName,
        "product-description": productDescription,
      },
      success: function (data) {
        let productList = JSON.parse(data);

        prices(buttonName, productList);
        storeCategory.push(productList[0].id)
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  function prices(buttonName, productList) {
    let containerButtons = $(".container-order-buttons");
    let itemButtons = `
    <div class='main-category' id='main-category'>
      
    </div>`;
    containerButtons.append(itemButtons);
    if (buttonName == "ORIGINAL PRICE") {
      let itemButton = `
              <div class="category-button" data-price-buttons>${productList[0].price}</div>
            `;
      $("#main-category").append(itemButton);
    } else {
      let itemButton = `
              <div class="category-button" data-price-buttons>${productList[0].reseller_price}</div>
            `;
      $("#main-category").append(itemButton);
    }
  }

  $(document).on("click", "[data-option-buttons]", function () {
    let productName = $(this).html();
    getPrices(
      storeCategory[0],
      storeCategory[1],
      storeCategory[2],
      productName
    );
    storeCategory.push(productName);
    $(this).parent().remove();
  });

  function getTotal(prices) {
    let zeroValue = 0;
    if (prices.length == 0) {
      $("#total-price").text(zeroValue.toFixed(2));
    } else {
      for (let i = 0; i < prices.length; i++) {
        zeroValue = zeroValue + parseFloat(prices[i].innerText);
        $("#total-price").text(zeroValue.toFixed(2));
      }
    }
  }

  $(document).on("click", "[data-price-buttons]", function () {
    let buttonName = $(this).html();

    let createDivOrders = `<div class="your-order">
                              <section>
                                  <div class="product-name" id="product-name">${
                                    storeCategory[1] + " " + storeCategory[2]
                                  }</div>
                                  <div hidden class="product-code" id="product-code">${storeCategory[4]}</div>
                                  <div class="container-quantity" id="container-quantity">
                                      <span class="operator" id='decrease'>
                                          &#x2D;
                                      </span>
                                      <input type='text' class="quantity" id='quantity' value='1' />
                                      <span class="operator" id='increase'>
                                          &#x2B;
                                      </span>

                                  </div>
                                  <div class="action">
                                      <button type="button" class="remove">remove</button>
                                  </div>
                              </section>
                              <div class="price" id="price">
                                  PHP <span id='data-price' data-price>${parseFloat(
                                    buttonName
                                  ).toFixed(2)}</span>
                                  <input type"text" hidden id="original-price" value="${buttonName}" />
                              </div>
                          </div>`;

    $(".reminder").hide();
    $("#orders").append(createDivOrders);
    $(this).parent().remove();
    $(".main-category").show();
    getTotal($("[data-price]"));
    storeCategory = [];
  });

  function changeQuantity(button, action) {
    let quantity = button
      .parent()
      .parent()
      .parent()
      .children("section")
      .children("#container-quantity")
      .children("#quantity");

    let originalPrice = button
      .parent()
      .parent()
      .parent()
      .children("#price")
      .children("input")
      .val();

    let staticPrice = button
      .parent()
      .parent()
      .parent()
      .children("#price")
      .children("span");

    if (isNaN(quantity.val())) {
      quantity.val("0");
    } else if (quantity.val() == 0) {
      checkZeroValue(button, quantity);
    } else {
      if (action == "increase") {
        let newPrice =
          parseFloat(staticPrice.html()) + parseFloat(originalPrice);
        staticPrice.text(newPrice.toFixed(2));
        quantity.val(parseFloat(quantity.val()) + 1);
        getTotalPrice();
      } else if (action == "decrease") {
        if (quantity.val() <= 1) {
          checkZeroValue(button, quantity);
        } else {
          let newPrice =
            parseFloat(staticPrice.html()) - parseFloat(originalPrice);
          staticPrice.text(newPrice.toFixed(2));
          quantity.val(parseFloat(quantity.val()) - 1);
        }
        getTotalPrice();
      } else {
        if (quantity.val() <= 0) {
          quantity.val(1);
          let newPrice = parseFloat(quantity.val()) * parseFloat(originalPrice);
          staticPrice.text(newPrice.toFixed(2));
        } else {
          let newPrice = parseFloat(quantity.val()) * parseFloat(originalPrice);
          staticPrice.text(newPrice.toFixed(2));
        }
        getTotalPrice();
      }
    }
  }

  // Notify user that product quantity is zero and subject for delete!
  function checkZeroValue(button, quantity) {
    let motherDiv = button.parent().parent().parent();
    if (confirm("Do you want to delete this order?") == true) {
      motherDiv.remove();
      if($(".your-order").length == 0){
        $(".reminder").show();
        getTotalPrice();
      } else{
        $(".reminder").hide();
        getTotalPrice();
      }
    } else {
      quantity.val(1);
    }
  }

  // change totalPrice when changing or adding products / quantity
  function getTotalPrice() {
    let defaultValue = 0;

    if($(".your-order").length == 0){
      $('#total-price').html("0.00");
    } else {

      for (let i = 0; i < $("[data-price]").length; i++) {
        defaultValue += parseFloat($("[data-price]")[i].innerText);
      }
      $("#total-price").html(defaultValue.toFixed(2));
    }
  }

  //Onchange event for product quantity
  $(document).on("change", "#quantity", function () {
    changeQuantity($(this), "change");
  });

  $(document).on("click", "#decrease", function () {
    changeQuantity($(this), "decrease");
  });

  $(document).on("click", "#increase", function () {
    changeQuantity($(this), "increase");
  });

  // remove element when button remove clicked!
  $(document).on('click', ".remove", function(){
    $(this).parent().parent().parent().remove();
    if($(".your-order").length == 0){
      $(".reminder").show();
      getTotalPrice();
    } else {
      getTotalPrice();
    }
  });

  //function to create data for create orders

  let successOrder = '';
  function createOrders(addOrders){
    $.ajax({
      type: "POST",
      url: "./includes/createOrder.inc.php",
      data: {
        "request-status": addOrders
      },
      success: function(data){
      if(data == "true"){
        successOrder = "success";
      } else {
        successOrder = "failed";
      }
      console.log(data)
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  // construct orders
  let placedOrders = [];

  function constructOrders(productName,productCode,quantity,price,clientId){
    let orders = {
      "product-name": productName,
      "product-code": productCode,
      "quantity": quantity,
      "price":price,
      "client-id":clientId

    };
    placedOrders.push(orders)
  }


  // submit created orders
$(document).on('click', "#submit", function(){
  let orders = $('.your-order');
  
  if(orders.length == 0){
    alert("Please select order first");
    return;
  } else {
    
  orders.each(function() {
    let productName = $(this).children('section').children('#product-name').html()
    let productCode = $(this).children('section').children('#product-code').html()
    let quantity = $(this).children('section').children('#container-quantity').children('#quantity').val()
    let price = $(this).children('#price').children('span').text()
    let clientId = $('#client-id').html()


    constructOrders(productName,productCode,quantity,price,clientId);

    
  })
  createOrders(placedOrders);
  window.location.href = "./index.php";
  }

});

$(document).on("click", "#cancel", function(){
  if(confirm("Redirect to homepage? Order placed will not be saved?") == true){
    window.location.href = "./homePage.php";
  } else {
    return;
  }
})

});

