<script>
$("#staff_id").change(function (){
var id = $("#staff_id").val();
	$.ajax({
	url:'api/page_name.php',
	type:'post',
	data:{id:id},
	success:function(response){
	var jsonObj = JSON.parse(response);
	var mobile = jsonObj.mobile;
	var email = jsonObj.email;
	var address = jsonObj.address;

	$("#mobile").val(mobile);
	$("#email").val(email);
	$("#address").val(address);
	}
  })
})
</script>

<?php
include "connection.php";
$var = array();
$id = $_REQUEST['id'];

$sql = mysqli_query($conn,"SELECT * FROM staff WHERE id='$id'");
$sql_fetch = mysqli_fetch_assoc($sql);

$phone = $sql_fetch['mobile'];
$email = $sql_fetch['email'];
$address = $sql_fetch['address'];

$var = array("mobile"=>$phone, "email"=>$email, "address"=>$address);
echo json_encode($var);
?>