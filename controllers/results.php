<?php
// view results on survey
class LikertmResults {
	static function view() {
		global $wpdb;
		
		// select survey
		$survey = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".LIKERTM_SURVEYS." WHERE id=%d", $_GET['survey_id']));
		
		// select questions
		$questions = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".LIKERTM_QUESTIONS." 
			WHERE survey_id=%d ORDER BY sort_order,id", $survey->id));
		
		// select takings limit 20
		$offset = empty($_GET['offset']) ? 0 : intval($_GET['offset']);
		$limit = 10;
		$takings = $wpdb->get_results($wpdb->prepare("SELECT SQL_CALC_FOUND_ROWS tT.*, tU.user_nicename as user_nicename 
			FROM ".LIKERTM_TAKINGS." tT LEFT JOIN {$wpdb->users} tU ON tU.ID = tT.user_id 
			WHERE survey_id=%d ORDER BY tT.id DESC LIMIT $offset,$limit", $survey->id));
			
		$cnt_takings = $wpdb->get_var("SELECT FOUND_ROWS()");
		
		$tids = array(0);
		foreach($takings as $taking) $tids[] = $taking->id;
		$tid_sql = implode(",", $tids);	
		
		// select all answers on the takings listed on the page
		$answers = $wpdb->get_results("SELECT tA.*, tC.answer as answer_text 
			FROM ".LIKERTM_USER_ANSWERS." tA JOIN ".LIKERTM_CHOICES." tC ON tC.id = tA.answer
			WHERE taking_id IN ($tid_sql)");
		
		// match answers & questions to takings
		foreach($takings as $cnt => $taking) {
			$user_answers = array();
			foreach($answers as $answer) {
				if($answer->taking_id == $taking->id) $user_answers[] = $answer;
			}
			
			$takings[$cnt]->answers = $user_answers;
		} // end foreach;
		
		$dateformat = get_option('date_format');
		include(LIKERTM_PATH."/views/view-results.html.php");
	} // end view()
}