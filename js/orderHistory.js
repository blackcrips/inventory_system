$(document).ready(function(){
    $("#data-table").DataTable();
    
    $('[data-bs-toggle]').each(function(){
        $(this).on('click',() => {
            let orderId = $(this).children('.order-id').html();
          $.ajax({
            type: "POST",
            url: "./includes/viewOrders.inc.php",
            data: {
              "request-product": orderId
            },
            success: function(data){
              let callBackData = JSON.parse(data);
              let previewDetails = `<div class="preview-order">
                                
                                <div class="preview-orders">
                                
                                </div>
                                <div class="preview-total">
                                    <label>TOTAL</label>
                                    <label id='total-price'></label>
                                </div>
                              </div>`;                
                    let modalBody = $('.modal-body');
                
                
                    if(modalBody.children().length < 1){
                      modalBody.append(previewDetails)
                    }else{
                      modalBody.children().remove();
                      modalBody.append(previewDetails);    
                    }

                    appendPreviewOrder(callBackData);
                    previewOrderTotalPrice();
                    addModalTitle(orderId);
                  }
      });
    })
})

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
            
        previewPrice.each(function(index,element) {
          price += parseInt($(this).children().last().text())
        })
        $('#total-price').html(price);
      }

      function addModalTitle(orderId){
        $('#exampleModalLabel').text(orderId + " History")
      }

      
    $(document).on('click', "#save-changes", () => {
    $('#form-edit').submit();
    })

});