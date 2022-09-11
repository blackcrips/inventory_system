$(document).ready(function(){
    $("#data-table").DataTable({
    //   "serverSide": true,
      "fnDrawCallback": function(){
        $('.edit').each(function(){
            $(this).on('click', () => {
              let orderId = $(this).parent().parent().children('.order-id').html();
              let orderStatus = $(this).parent().parent().children('.status').html();

            $.ajax({
              type: "POST",
              url: "./includes/lendingSingleView.inc.php",
              data: {
                "request-product": orderId
              },
              success: function(data){
                let callBackData = JSON.parse(data);

                let previewDetails = `<div class="preview-order">
                                  
                                  <div class="preview-orders">
                                  
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
                      checkOrderStatus(orderStatus,orderId);
                      previewOrderTotalPrice();
                      addModalTitle(orderId);
                    }
              });
          })
       })
        
    $(document).on('click', "#save-changes", () => {
      $('#form-update').submit();
      });

      $('.delete').each(function(){
        $(this).on('click', function(){
          let id = $(this).parent().parent().children('.order-id').html();
        
          if(confirm('Deleting record cannot be undone? Do you want to continue?') == true){
            $.ajax({
              method: "POST",
              url: './includes/deleteLendingRecord.inc.php',
              data: {
                "request-id": id
              },
              success: function(data){
                if(data == 'true'){
                  alert("Record deleted!");
                  location.reload(true);
                } else {
                  alert('Error deleting record. Please contact your admin.');
                }
              }
            });
          } else {
            return;
          }
        });
      });
  
      }
    }); //end of data tables
    

    function appendPreviewOrder(orders){
        for(let i = 0; i < orders.length; i++){
            let createOrders = `<div class="preview-order-details">
            <form action='./includes/saveBorrowChanges.inc.php' method='POST' id='form-update'>
              <table>
                <tr>
                  <td><label for='borrower-name'>Borrowers name:</label></td>
                  <td><input type='text' id='borrower-name'name='borrower-name' class='details' value='${orders[i].borrower_name}' /></td>
                </tr>
                <tr>
                  <td><label for='borrow-date'>Borrowed date:</label></td>
                  <td><input type='date' id='borrow-date' name='borrow-date' class='details' value='${orders[i].borrow_date}' /></td>
                </tr>
                <tr>
                  <td><label for='borrowed-amount'>Borrowed amount:</label></td>
                  <td><input type='text' id='borrowed-amount' name='borrowed-amount' class='details' value='${orders[i].borrow_amount}' /></td>
                </tr>
                <tr>
                  <td><label for='amount-to-pay'>Remaining balance:</label></td>
                  <td><input type='test' id='amount-to-pay' name='amount-to-pay' class='details' value='${orders[i].amount_to_pay}' /></td>
                </tr>
                <tr>
                  <td><label for='total-balance'>Balance w/ interest:</label></td>
                  <td><input type='test' id='total-balance' name='total-balance' class='details' value='${orders[i].  total_with_interest}' /></td>
                </tr>
                <tr>
                    <td><input type='text' hidden id='form-id' name='order-id' value='${orders[i].id}' /></td>
                    <td  id='checkBox'></td>                
                  </tr>
                <tr id='container-paid'>
                  <td><label for='amount-paid'>Amount paid:</label></td>
                  <td><input type='text' id='amount-paid' name='amount-paid' class='details' value='' /></td>
              </tr>  
              </table>
            </form>
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
        if(orderStatus == "active" || orderStatus == 'partial'){
          $("#save-changes").text('Save changes')
          $("#save-changes").show()
          addCheckBoxPaid();     
        } else {
          $("#save-changes").text('Save changes');       
          $("#save-changes").hide()
          $('input[type=text], input[type=date]').prop('disabled', true);
        }
      }
      
      function addCheckBoxPaid()
      {
        let checkBox = `<input type="radio" class="check-box" name='order-status' value='paid'>
                        <label for="check-box">Fully paid</label>

                        <input type="radio" class="check-box" name='order-status' value='partial'>
                        <label for="check-box">Partial payment</label>
                        `;

        $('#checkBox').append(checkBox);
      }

      function activateCheckBox()
      {
        $(document).on('change', '.check-box', function(event){
          if($(this).is(":checked")){
            $('#container-paid').fadeIn();
          } else {
            $('#container-paid').fadeOut();
            $('#amount-paid').val('');
          }
        });
      }
      activateCheckBox();
      
});