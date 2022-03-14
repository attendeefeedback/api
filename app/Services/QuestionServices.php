<?php

	namespace App\Services;
	use Exception;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Carbon;
	use Illuminate\Support\Facades\Config;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Log;
	use Illuminate\Support\Facades\Queue;
	use App\Models\Question;
	use App\Models\Answer;

	class QuestionServices
	{

		/**
	     * @return string
	     */
	    public function getCannedQuestions()
	    {
	        return Question::where('canned_que','1')->with('answer')->get();
	    }

	    /**
	     * @return string
	     */
	    public function addQueAns($param)
	    {
	    	$data =  json_decode($param['event_que_ans'],true);
	    	$question = new Question();
	    	$question->event_question = @$data[0]['event_question'];
	    	$question->event_id = @$param['event_id'];
	    	$question->sort_order = @$param['sort_order']; 
	    	$question->admin_id = @$param['admin_id'];
            $question->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $question->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $question->save();
           	$answerData = ['admin_id'=>$param['admin_id'] ,'question_id' => $question->id,'answers' => $data[0]['answer']]; 
            $this->addAnswer($answerData);
            return true;
	    }

	    public function addAnswer($data){
	    	if(count($data['answers'])>0){
	    		foreach ($data['answers'] as $key => $value) {
	    			$insert = ['question_answer' => @$value['question_answer'],
	    						'admin_id' => $data['admin_id'],
	    						'question_id' => $data['question_id'],
	    						'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	    						'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];
	    			Answer::create($insert);
	    		}
	    	}
	    	return true;
	    }

	    public function deleteQueAns($data){

	    	Question::where('id', $data['id'])->update(
            				['active_flag' => 0]);
	    	$this->deleteAns($data['id']);
            return true;
	    }

	    public function updateQueAns($param){

	    	$data =  json_decode($param['event_que_ans'],true);
	    	Question::where('id', $param['id'])->update(
            				['event_question' => @$data[0]['event_question'],
            				 'sort_order' => @$data[0]['event_question'],
            				 'event_question' => @$data[0]['event_question'],
            				 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
	    	$this->deleteAns($param['id']);	    	
           	$answerData = ['admin_id'=>$param['admin_id'] ,'question_id' => $param['id'],'answers' => $data[0]['answer']]; 
            $this->addAnswer($answerData);
            return true;
	    }

	    public function deleteAns($question_id){

	    	Answer::where('question_id', $question_id)->update(
            				['active_flag' => 0]);
	    	return true;
	    }

	}

