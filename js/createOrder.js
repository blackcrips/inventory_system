$(document).ready(function () {
  let slideIndex = 1;
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
  let categoryOrder = ''; // store order description here per click of category button
  let remarksPerProduct = [];

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

                                <div! class='show-price'></div>
                              </div>
                        </div>
                        <hr>
                          <div class='images-content'>
                            <div class='container-image'>
                            
                            </div>
                          </div>
                        <hr>
                          <div class="order-lists">
                              
                          </div>
                          <div class="manual-price">
                              <label for="input-price">Input price:</label>
                              <input type="text" id="input-price" name="input-price">
                              <textarea name="remarks" id="remarks" cols="30" rows="10" placeholder="Remarks here"></textarea>
                          </div>
                          
                          <div id='add-order'>
                            <button id='add' class='btn btn-primary'> Add </button>
                            <button id='back' class='btn btn-danger'> Back </button>
                          </div>`;
    $('#container-description').append(orderDetails);
    getProductDescription(array);
  }

  // store product details upon choosing products
  let storeProductDescription;

  $(document).on('click', "[data-product-description]", function() {
    storeProductDescription.forEach(element => {
      if($(this).html() == element['product_description']){
        $('.show-price').html("P " + element['price']);
        let checkfolderName = [element['category'],element['product_name'],element['product_description']];
        checkFolderNames(checkfolderName.join("-"));
        categoryOrder = $(this).html();
        storeCategory[2] = categoryOrder;
        storeCategory[3] = element['product_code'];
        storeCategory[4] = element['price'];
        storeCategory.splice(5,1);
        $('#input-price').val('');
      }
    });
    
    // checkActiveProductDescription();
    $(this).addClass('active');
  });

  //getting images folder content names
  function checkFolderNames(folderName){
    $.ajax({
      type: "POST",
      url: "./includes/getImagesContent.inc.php",
      data: {"folder-name" : folderName},
      success: function(data){
        let parseData = JSON.parse(data);
        checkExistingImageView(parseData);
      },
      error: function(error){
        console.log(error);
      }
    });
  }
  
// slides images jsScript

function checkExistingImageView(description)
{
  if($('.mySlides').length > 0){
    $('.container-image').remove();
    $('.images-option').remove();
    let containerImages = `<div class='container-image'></div>`;
    $('.images-content').append(containerImages);
    getProductImages(description);
  } else {
    getProductImages(description);
  }
}

function getProductImages(description)
{
  for (let index = 0; index < description['photo-count']; index++) {
    let mySlides = `<div class="mySlides">
                      <div class="numbertext">${index + 1} / ${description['photo-count']}</div>
                      <div class='background-image' style="background-image: url('./images/products/${description['folder-name']}/Photo${index}.jpeg')"></div>
                    </div>`;

    $('.container-image').append(mySlides);
  }

  let prev = `<a class="prev">❮</a>`;
  let next = `<a class="next">❯</a>`;
  let rowImages = `<div class='row'></div>`;
  let imagesOption = `<div class='images-option'></div>`;
  $('.images-content').append(imagesOption);
  $('.container-image').append(prev);
  $('.container-image').append(next);
  $('.images-option').append(rowImages);

  rowImagesShow(description);
 
  showSlides(slideIndex); 
}

$(document).on('click', '.prev', function(){
  plusSlides(-1);
});

$(document).on('click', '.next', function(){
  plusSlides(1);
});

function rowImagesShow(description)
{
  for (let index = 0; index < description['photo-count']; index++) {
    let rowImagesOption = `<div class="column">
                            <img class="demo cursor" src="./images/products/${description['folder-name']}/Photo${index}.jpeg" style="width:100%" alt="Photo">
                            <input type='text' hidden id='image-count' value='${index + 1}'>
                          </div>`;
    $('.row').append(rowImagesOption);
  }
}


$(document).on('click', '.demo', function(){
  let imageCount = $(this).parent().children('#image-count').val();
  currentSlide(parseInt(imageCount));
});

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

   // store order selected to storeCategory
$(document).on('click', '#add', function(){
  checkInputPrice();
});

function storeOrderRemarks(prouctId,price,remarks)
{
  let storeRemarks = {
    'productId':prouctId,
    'price': price,
    'remarks': remarks,
  }

  remarksPerProduct.push(storeRemarks);
}

function checkInputPrice()
{
  let matchThis = /^[0-9]+$/;
  let inputPrice = $('#input-price').val();
  let showPrice = $('.show-price').html();

  if(inputPrice == '' && showPrice == ''){
    alert('Please selece order');
  } else if(inputPrice == '' && showPrice != ''){
    addToCart();
  } else {
    if(!inputPrice.match(matchThis)){
      alert('This is not a number');
    } else {
      storeCategory[4] = inputPrice;
      let remarks = $('#remarks').val();
      if(remarks != ''){
        storeOrderRemarks(storeCategory[3],storeCategory[4],remarks);
      }
      addToCart();
    }
  }
}

  function getProductDescription(array)
  {
    array.forEach(element => {
      let productDescription = `<button data-product-description class='button-description'>${element['product_description']}</button>`;
      $('.order-lists').append(productDescription);
    });
    
    let enterPrice = `<button id='enter-price'>Enter Price</button>`;
    $('.order-lists').append(enterPrice);
  }

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

  function addToCart (){
    let createDivOrders = `<div class="your-order">
                              <section>
                                  <div class="product-name" id="product-name">${
                                    storeCategory[1] + " " + storeCategory[2]
                                  }</div>
                                  <div hidden class="product-code" id="product-code">${storeCategory[3]}</div>
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
                                    storeCategory[4]
                                  ).toFixed(2)}</span>
                                  <input type"text" hidden id="original-price" value="${storeCategory[4]}" />
                              </div>
                          </div>`;

    $(".reminder").hide();
    $("#orders").append(createDivOrders);
    getTotal($("[data-price]"));
  }

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

  function constructOrders(productName,productCode,quantity,price,clientId,remarks){
    let orders = {
      "product-name": productName,
      "product-code": productCode,
      "quantity": quantity,
      "price":price,
      "client-id":clientId,
      'remarks': remarks

    };
    placedOrders.push(orders);
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
    let remarks = saveRemarks(productCode,price);


    constructOrders(productName,productCode,quantity,price,clientId,remarks);
  })
  
  createOrders(placedOrders);
  alert('Order successfully created');
  window.location.href = "./index.php";
  }

});

function saveRemarks(productId,price)
{
  for (let index = 0; index < remarksPerProduct.length; index++) {
    if(remarksPerProduct[index].productId == productId){
      if(remarksPerProduct[index].price == price.slice(0,-3)){
        let remarks = remarksPerProduct[index].remarks;
        return remarks;
      } else {        
        let remarks = "";
        return remarks;
      }
    }
  }
}

$(document).on("click", "#cancel", function(){
  if(confirm("Redirect to homepage? Order placed will not be saved?") == true){
    window.location.href = "./homePage.php";
  } else {
    return;
  }
})

$(document).on('click', '#back', function(){
  $('#main-category').remove();
  $('#container-description').children().remove();
  $('#container-description').hide();
  $('.main-category').show();
  console.log(storeCategory);
});

});