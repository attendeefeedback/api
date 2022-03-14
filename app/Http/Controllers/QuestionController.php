<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Services\QuestionServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;


class QuestionController extends Controller
{

    /**
     * @var QuestionServices
     */
    private $questionServices;

    public function __construct(QuestionServices $questionServices)
    {
        $this->questionServices = $questionServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeQueAns(Request $request)
    {
        //
        $params = $request->input();
        $validator = Validator::make($params, ['admin_id' => 'required','event_que_ans' => 'required','event_id' => 'required']);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $data = $this->questionServices->addQueAns($params);
        return $this->sendSuccess($data); 
    }

    public function getCannedQuestions(Request $request){

        return json_encode($this->questionServices->getCannedQuestions());
    }

    public function deleteQue(Request $request){
        $params = $request->input();
        $validator = Validator::make($params, ['admin_id' => 'required','id' => 'required']);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $data = $this->questionServices->deleteQueAns($params);
        return $this->sendSuccess($data);
    }

    public function updateQue(Request $request){
        $params = $request->input();
        $validator = Validator::make($params, ['admin_id' => 'required','id' => 'required','event_que_ans' => 'required','update_flag' => 'required']);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $data = $this->questionServices->updateQueAns($params);
        return $this->sendSuccess($data);
    }
}
