<input type="text" id="register_phone" onkeyup="generateotp()">
<label>Your OTP<span id="otp_span"></span></label>

<script>
    function generateotp(){
    var contact_no = $("#register_phone").val();
    var str_length = contact_no.length;
    if(str_length == 10){
        $.ajax({
        url: "api/insert_otp.php",
        type: "POST",
        data: {contact_no:contact_no},
        success: function (result){
            if(result == 1){
               swal("Sorry","Your Are Already Registered! Please Login!","error");
               setTimeout(function() {window.location='index.php'}, 3000);
            }
            else{
              $("#otp_span").html(result);
            }
          }
        })
    }
}
</script>

<?php
include('connection.php');
$contact_no = $_REQUEST['contact_no'];
$otp = rand(1111,9999);

$check_phone = mysqli_query($conn, "SELECT * FROM user WHERE phone='$contact_no'");
$exist_phone = mysqli_num_rows($check_phone);

if($exist_phone == 0){
    $register = mysqli_query($conn, "INSERT INTO user (`phone`, `otp`) VALUES ('$contact_no', '$otp')");
    $check_otp = mysqli_query($conn, "SELECT * FROM user WHERE phone='$contact_no'");
    $fetch_otp = mysqli_fetch_assoc($check_otp);
    echo $user_otp = $fetch_otp['otp'];
}
else{
    $user_value_fetch = mysqli_fetch_assoc($check_phone);
    $register_name = $user_value_fetch['register_fname'];
    if($register_name == ""){
        $update_otp = mysqli_query($conn, "UPDATE user SET `otp`='$otp' WHERE phone='$contact_no'");
        $check_otp = mysqli_query($conn, "SELECT * FROM user WHERE phone='$contact_no'");
        $fetch_otp = mysqli_fetch_assoc($check_otp);
        echo $user_otp = $fetch_otp['otp'];
    }
    else{
        echo 1;
    }
}
?>