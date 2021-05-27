<td id="status<?=$id?>">
<?php
if($job_status=='Active'){
?>
<button type="button" class="btn btn-success status_<?=$id?>" onclick="change_status(<?=$id?>)">Active</button>
<?php
}else{
?>
<button type="button" class="btn btn-danger status_<?=$id?>" onclick="change_status(<?=$id?>)">Deactive</button>
<?php
}
?>
</td>

<script>
    function change_status(id){
        $.ajax({
        type:"post",
        url:"api/all_jobs_status.php",
        data:{id:id},
        beforeSend: function() {
        $(".status_"+id).html('Processing...');
        },
        success:function(data){
        $("#status"+id).html(data);
            }
        })
      }
</script>

<?php
include("connection.php");
$id=$_REQUEST['id'];

$sql_match=mysqli_query($conn,"SELECT * FROM `post_job` WHERE `id`='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['job_status'] == 'Active'){
    $sql_updateY=mysqli_query($conn,"UPDATE post_job SET job_status='Inactive' WHERE id='$id'");
    if($sql_updateY){
    ?>
    <button type="button" class="btn btn-danger status_<?=$id?>" onclick="change_status(<?=$id?>)">Deactive</button>
    <?php
	}
}else{
    $sql_updateY=mysqli_query($conn,"UPDATE post_job SET job_status='Active' WHERE id='$id'");
    if($sql_updateY){
	?>
	<button type="button" class="btn btn-success status_<?=$id?>" onclick="change_status(<?=$id?>)">Active</button>
	<?php
	}
}
?>