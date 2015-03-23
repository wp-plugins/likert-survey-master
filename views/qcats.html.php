<div class="wrap">
	<h1><?php _e('Manage Question Categories', 'likertm');?></h1>
	
	<form method="post" onsubmit="return validateQcat(this);">
		<p><?php _e('Category name:', 'likertm');?> <input type="text" name="name" size="30"> <input type="submit" name="add" value="<?php _e('Add new category');?>"></p>
	</form>
	
	<?php foreach($qcats as $qcat):?>
		<form method="post" onsubmit="return validateQcat(this);">
			<input type="hidden" name="id" value="<?php echo $qcat->id?>">
			<p><?php _e('Category name:', 'likertm');?> <input type="text" name="name" size="30" value="<?php echo stripslashes($qcat->name);?>"> <input type="submit" name="save" value="<?php _e('Save');?>">
			<input type="button" value="<?php _e('Delete', 'likertm');?>" onclick="likertmConfirmDelete(<?php echo $qcat->id?>);"></p>
		</form>
	<?php endforeach;?>
</div>

<script type="text/javascript" >
function validateQcat(frm) {
	if(frm.name.value == '') {
		alert("<?php _e('Please enter category name', 'likertm');?>");
		frm.name.focus();
		return false;
	}
}

function likertmConfirmDelete(id) {
	if(confirm("<?php _e('Are you sure?', 'likertm');?>")) {
		window.location = 'admin.php?page=likertm_qcats&del=1&id=' + id;	
	}
}
</script>