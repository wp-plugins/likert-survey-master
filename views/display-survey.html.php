<div class="likertm-survey" id="likertm-survey-div-<?php echo $survey->id?>">
<form method="post" id="likertm-survey-form-<?php echo $survey->id?>">
	<div class="likertm-survey-area" id="likertm-survey-wrap-<?php echo $survey->id?>">
		<?php foreach($questions as $question):?>	
			<div class="likertm-survey-question">
				<?php echo $_question->display_question($question);?>
			</div>
			
			<div class="likertm-survey-choices">
					<?php echo $_question->display_choices($question, $question->choices);?>
			</div>
		<?php endforeach;?>
	
		<div class="likertm-survey-action">
			<input type="button" id="likertm-survey-action-<?php echo $survey->id?>" value="<?php _e('Submit Survey', 'likertm')?>" onclick="LikertSurvey.submit(<?php echo $survey->id?>, '<?php echo admin_url('admin-ajax.php')?>');">
		</div>	
		<input type="hidden" name="survey_id" value="<?php echo $survey->id?>">
	</div>
</form>