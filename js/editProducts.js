$(document).ready(function(){
  $("#data-table").DataTable({
    'fnDrawCallback': function(){
      $('[data-bs-toggle]').each(function(){
        $(this).on('click', () => {
          let productId = $(this).parent().children("#product-code").val(); 
          $.ajax({
            type: "POST",
            url: "./includes/getSingleProduct.inc.php",
            data: {
              "request-product": productId
            },
            success: function(data){
              let callBackData = JSON.parse(data);
              let editModal = `<div class="container-edit">
              <form id='form-edit' action="./includes/editProducts.inc.php" method="POST">
              <table>
                  <tbody>
                      <tr>
                          <td>Category:</td>
                          <td><input type="text" name="category" value="${callBackData['category']}"></td>
                      </tr>
                      <tr>
                          <td>Produt name:</td>
                          <td><input type="text" name="product-name" value="${callBackData['product_name']}"></td>
                      </tr>
                      <tr>
                          <td>Product description:</td>
                          <td><input type="text" name="product-description" value="${callBackData['product_description']}"></td>
                      </tr>
                      <tr>
                          <td>Supplier price:</td>
                          <td><input type="text" name="supplier-price" value="${callBackData['supplier_price']}"></td>
                      </tr>
                      <tr>
                          <td>Retail price:</td>
                          <td><input type="text" name="retail-price" value="${callBackData['price']}"></td>
                      </tr>
                      <tr>
                          <td>Reseller price:</td>
                          <td><input type="text" name="reseller-price" value="${callBackData['reseller_price']}"></td>
                      </tr>
                      <tr>
                          <td>Quantity:</td>
                          <td><input type="text" name="quantity" value="${callBackData['quantity']}"></td>
                      </tr>
                      <tr><td><input name='product-code' hidden  value='${callBackData['product_code']}'></td></>
                      </tbody>
                      </table>
                      </form>
          </div>`;
      
          let modalBody = $('.modal-body');
      
      
          if(modalBody.children().length < 1){
            modalBody.append(editModal)
          }else{
            modalBody.children().remove();
            modalBody.append(editModal);    
          }
            }
          });
        })
       });

       $(document).on('click', '#delete', () => {
        if(confirm("Deleting this product cannot be undone") == true){
          let productCode = $('#product-code').val();
          $.ajax({
            type: "POST",
            url: "./includes/deleteProduct.inc.php",
            data: {
              'product-code': productCode
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
        }
   
      })
      
    }


  });

 $(document).on('click', "#save-changes", () => {
  $('#form-edit').submit();
 })
});