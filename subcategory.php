<label>Category</label>
<select id="category" onchange="get_subcat()">
	<option value="">Select Category</option>
	<?php 
	$category = mysqli_query($conn, "SELECT * FROM service_category");
	while($category_fetch = mysqli_fetch_assoc($category)){
	?>
	<option value="<?=$category_fetch['id']?>"><?=$category_fetch['name']?></option>
	<?php } ?>
</select>

<label >Sub Category</label>
<select id="subcategory">
	<option value="">Select Sub-Category</option>
</select>

<script>
  function get_subcat(){
    var category_id = $('#category').val();
      $.ajax({
        url: "api/getsubcategory.php",
        type: "POST",
        data: {category_id:category_id},
        success: function (result){
        $("#subcategory").html(result);
      }
    })
  }
</script>

<?php
include('connection.php');
$category_id = $_REQUEST['category_id'];
$sql = mysqli_query($conn,"SELECT * FROM subcategory WHERE category_id='$category_id'");
?>

<option value=''>Select Sub-Category</option>
<?php
while($sql_fetch = mysqli_fetch_assoc($sql)) { ?>
<option value='<?=$sql_fetch['id']?>'><?=$sql_fetch['name']?></option>
<?php }
?>