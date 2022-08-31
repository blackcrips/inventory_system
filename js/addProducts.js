// let fileCount = $(this).files.length;

$('#upload-files').change(function(){
    $fileCount = this.files.length;
    
    if($fileCount > 5){
        $('#upload-files').val('');
        alert("Maximum of 5 files allowed!");
    }
});