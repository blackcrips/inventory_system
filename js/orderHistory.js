$(document).ready(function(){
    $("#data-table").DataTable();
    
    $('.container-order-id').each(function(){
        $(this).on('click',() => {
            console.log($(this).children('.order-id').html());
        })
    })

});