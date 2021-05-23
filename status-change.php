<?php
if($row['status'] == 'Y'){
?>
<td><button type="button" class="btn btn-success status_<?=$row['id']?>" onclick="change_status(<?=$row['id']?>)">Approve</td>
<?php
} else {
?>
<td><button type="button" class="btn btn-danger status_<?=$row['id']?>" onclick="change_status(<?=$row['id']?>)">Disapprove</td>
<?php
}
?>

<script>
    function change_status(id){
        $.ajax({
        type:"post",
        url:"category_status.php",
        data:{id:id},
        beforeSend: function() {
            $(".status_"+id).html('Processing...');
        },
        success:function(data)
        {
            var jsonObj = JSON.parse(data);
            if(jsonObj.status == 'in'){
                $(".status_"+id).html('Approve');
                $(".status_"+id).css('background-color','#15ca20');
                $(".status_"+id).css('border','1px solid #15ca20');
            }
            else if(jsonObj.status == 'a'){
                $(".status_"+id).html('Disapprove');
                $(".status_"+id).css('background-color','#bd2130');
                $(".status_"+id).css('border','1px solid #bd2130');
            }
        }
    })
}
</script>