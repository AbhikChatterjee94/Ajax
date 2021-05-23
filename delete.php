<tr id="row<?=$fetch['product_id']?>">
<a href="#" class="dltbtn" onclick="delete_product('<?=$fetch['product_id']?>')"></a>
<tr>

<script>
function delete_product(id){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
    .then((willDelete)=>{
        if(willDelete){
            $.ajax({
                url: "delete_product.php",
                type: "POST",
                data: {id:id},
                dataType: "html",
                success: function(){
                swal("Done!","Succesfully deleted!","success");
                $("#row"+id).remove();
                }
            })
    	}
        else{
            swal("Your file is unchanged!");
        }
    })
}
</script>

<?php
include("connection.php");
$id = $_REQUEST['id'];
$del_data = mysqli_query($conn,"DELETE FROM `product` WHERE `product_id`='$id'");
echo "success";
?>