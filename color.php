<label>Color Name</label>
<select id="color_id" onchange="get_color()">
    <option value="">Choose Color</option>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM color");
    while($colors = mysqli_fetch_assoc($sql)){ 
    ?>
    <option value="<?=$colors['clr_id']?>"> <?=$colors['clr_name']?> </option>
    <?php 
	}
    ?>
</select>

<label>Color Display</label>
<input type="text" id="hex_code" readonly>

<script>
function get_color(){
 	var color_id=$('#color_id').val();
 	$.ajax({
	    url:"api/getcolor.php",
	    type:"POST",
		data:'color_id='+color_id,
	    success:function(data){
            $("#hex_code").css("background-color",data);
	    }
	})
}
</script>

<?php
$color_id = $_REQUEST['color_id'];
$sql = mysqli_query($conn,"SELECT * FROM color WHERE clr_id='$color_id'");
$sql_fetch = mysqli_fetch_assoc($sql);
echo $sql_fetch['clr_name'];
?>