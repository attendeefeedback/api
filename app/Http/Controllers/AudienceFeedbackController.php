<?php

namespace App\Http\Controllers;

use App\Models\AudienceFeedback;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class AudienceFeedbackController extends Controller
{

    /**
     * @var ResponseServices
     */
    private $responseServices;

    public function __construct(ResponseServices $responseServices)
    {
        $this->responseServices = $responseServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFeedback(Request $request)
    {
        //
        $params = $request->input();
        $validator = Validator::make($params, ['feedback_response' => 'required','event_id' => 'required']);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $data = $this->questionServices->addQueAns($params);
        return $this->sendSuccess($data); 
    }
    
}
