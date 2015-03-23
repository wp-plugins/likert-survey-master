<div class="wrap">
	<h1><?php _e('Edit Survey', 'likertm');?></h1>
	
	<p><a href="admin.php?page=likertm_surveys"><?php _e('Back to surveys', 'likertm')?></a>
	&nbsp;|&nbsp;
	<a href="admin.php?page=likertm_questions&survey_id=<?php echo $survey->id?>"><?php _e('Manage questions', 'likertm');?></a></p>
	
	<form method="post" onsubmit="return validateLikertmSurvey(this);">
		<p><label><?php _e('Survey title:', 'likertm');?></label> <input type="text" name="title" size="60" value="<?php echo stripslashes($survey->title);?>"></p>
		<p><label><?php _e('Final output:', 'likertm');?></label> <?php echo wp_editor(stripslashes($survey->final_screen), 'final_screen');?></p>
		<h3><?php _e('Usable variables:', 'likertm');?></h3>
		<ul>
			<li>{{num-questions}} - <?php _e('shows the number of questions answered', 'likertm')?></li>
			<li>{{all-answers}} - <?php _e('shows all questions along with the answers given', 'likertm')?></li>
			<li>[likertm-barchart type="global"] - <?php _e('shortcode that generates global bar chart from the answers', 'likertm')?></li>
			<li>[likertm-barchart type="cats"] - <?php _e('shortcode that generates bar chart for each question category', 'likertm')?></li>
		</ul>
		<p><input type="submit" value="<?php _e('Save Survey', 'likertm');?>"></p>
		<input type="hidden" name="ok" value="1">
	</form>
</div>

<script type="text/javascript" >
function validateLikertmSurvey(frm) {
	if(frm.title.value == '') {
		alert("<?php _e('Please enter survey title.', 'likertm')?>");
		frm.title.focus();
		return false;
	}
}
</script>