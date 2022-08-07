$(document).ready(function(){
    $("#data-table").DataTable({
      // "serverSide": true,
      "fnDrawCallback": function(){
        $('[data-bs-toggle]').each(function(){
          $(this).on('click', () => {
              let orderId = $(this).children('.order-id').html();
              let orderStatus = $(this).children('.order-status').html();

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
  
                      checkOrderStatus(orderStatus,orderId);
                      appendPreviewOrder(callBackData);
                      previewOrderTotalPrice();
                      addModalTitle(orderId);
                    }
              });
          })
       })
  
        $(document).on('click', '#preview-delete', () => {
          let orderId = $('#order-id').val();
            $.ajax({
              type: "POST",
              url: "./includes/deleteOrder.inc.php",
              data: {
                'order-id': orderId
              },
              success: function(data){
                if(!data){
                  alert('There was a problem deleting the record.')
                } else {
                  alert('Success');
                  location.reload();
                }
              }, 
              error: function(error){
                console.log(error)
              }
            });
        })

        
    $(document).on('click', "#save-changes", () => {
      let orderId = $('#order-id').val();
        $.ajax({
          type: "POST",
          url: './includes/changeOrderStatus.inc.php',
          data: {
            'order-id': orderId
          },
          success: function(data){
            if(data){
              alert('Order status updated');
              location.reload(true);
            }else{
              alert('Error updating order status');
            }
          }
        });
      })
  
      }
    }); //end of data tables
    

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

      function checkOrderStatus(orderStatus,orderId){
        if(orderStatus == "pending"){
          $("#save-changes").text('Delivered')
          $("#save-changes").show()  
          checkDeleteButton(orderStatus,orderId);        
        } else {
          $("#save-changes").text('Save changes')          
          $("#save-changes").hide()          
          checkDeleteButton(orderStatus);        
        }
      }
      
      function checkDeleteButton(status,orderId){
        if(status == 'pending'){
          if($('#preview-delete').length > 0){
            return;
          } else {
            let deleteButton = `<button type="button" class="btn btn-danger" id="preview-delete">Delete</button>
            <input type='hidden' id='order-id' value="${orderId}">`;
            $('.modal-footer').append(deleteButton)
          }
        } else {
          $('#preview-delete').remove();
        }
      }

      
    

});