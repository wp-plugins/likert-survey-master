var LikertSurvey = {};

LikertSurvey.submit = function(surveyID) {
	// check for unanswered required questions
	if(jQuery('.likertm-required-' + surveyID).length) {
		jQuery('.likertm-required-' + surveyID).each(function(i, val){
			var qID = val.value;
			// now check if it's answered
			var isAnswered = false;			
			var frmID = val.form.id;
			var firstInput = null; // create this to store the first radio button so we can focus on it
			
			jQuery('#' + frmID + ' input[name=question-' + qID + ']').each(function(j, inp) {
				if(j == 0) firstInput = inp;
				if(inp.checked) isAnswered = true;
			});
			
			if(!isAnswered) {
				alert(likertm_i18n.answering_required);
				if(firstInput) firstInput.focus();
				return false;
			}
		});
	}	
	
	jQuery('#likertm-survey-action-' + surveyID).attr('disabled', 'disabled');	
		
	// submit the answer by ajax
	data = jQuery('#likertm-survey-form-'+surveyID).serialize();
	data += '&action=likertm_ajax';
	data += '&likertm_action=submit';
	
	// console.log(data);
	jQuery.post(likertm_i18n.ajax_url, data, function(msg) {
			if(jQuery('body').scrollTop() > 250) {				
				jQuery('html, body').animate({
			   		scrollTop: jQuery('#likertm-survey-wrap-'+surveyID).offset().top -100
			   }, 500);   
			}		  
			
		  jQuery('#likertm-survey-action-' + surveyID).removeAttr('disabled');
		  
		  jQuery('#likertm-survey-div-'+surveyID).html(msg);
	});
}