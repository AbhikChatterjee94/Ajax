<input type="text" id="register_phone" onkeyup="generateotp()">
<label>Your OTP<span id="otp"></span></label>

<script>
    function generateotp(){
    var phone = $("#register_phone").val();
    var str_length = phone.length;
    if(str_length == 10){
        $.ajax({
        url: "api/insert_otp.php",
        type: "POST",
        data: {phone:phone},
        success: function (result){
            if(result == 1){
               swal("Sorry","Your Are Already Registered! Please Login!","error");
               setTimeout(function() {window.location='index.php'}, 3000);
            }
            else{
              $("#otp").html(result);
            }
          }
        })
    }
}
</script>

<?php
include('connection.php');
$phone = $_REQUEST['phone'];
$otp = rand(1111,9999);

$check_phone = mysqli_query($conn, "SELECT * FROM user WHERE phone='$phone'");
$exist_phone = mysqli_num_rows($check_phone);

if($exist_phone == 0){
    $register = mysqli_query($conn, "INSERT INTO user (`phone`, `otp`) VALUES ('$phone', '$otp')");
    $check_otp = mysqli_query($conn, "SELECT * FROM user WHERE phone='$phone'");
    $fetch_otp = mysqli_fetch_assoc($check_otp);
    echo $user_otp = $fetch_otp['otp'];
}
else{
    $user_value_fetch = mysqli_fetch_assoc($check_phone);
    $register_name = $user_value_fetch['register_fname'];
    if($register_name == ""){
        $update_otp = mysqli_query($conn, "UPDATE user SET `otp`='$otp' WHERE phone='$phone'");
        $check_otp = mysqli_query($conn, "SELECT * FROM user WHERE phone='$phone'");
        $fetch_otp = mysqli_fetch_assoc($check_otp);
        echo $user_otp = $fetch_otp['otp'];
    }
    else{
        echo 1;
    }
}
?>