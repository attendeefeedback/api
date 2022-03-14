<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\AdminServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;


class AdminController extends Controller
{
    
    /**
     * @var AdminServices
     */
    private $AdminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function getAdminDetails(Request $request)
    {
        try {
            $params = $request->headers->all();
            $validator = Validator::make($params, ['email_id' => 'required','password' => 'required']);
            if ($validator->fails()) {
                return $this->validationError($validator->errors());
            }
            $data = $this->adminServices->adminDetails($params);
            return $this->sendSuccess($data);

        } catch (Exception $exception) {
            $this->sendError(['message' => 'Getting Event Failed'], 404);
        }
    }

    public function getAdminLoginEvents(Request $request)
    {
        try {
            $params = $request->input();
            $validator = Validator::make($params, ['email_id' => 'required','password' => 'required']);
            if ($validator->fails()) {
                return $this->validationError($validator->errors());
            }
            $admin = $this->adminServices->adminLoginDetails($params);
            if($admin != null){
                $data = $this->adminServices->adminEvents($admin);
                return $this->sendSuccess($data);
            }else{
                return $this->sendError(['message' => 'Invalid login credentials'], 404);
            }

        } catch (Exception $exception) {
            $this->sendError(['message' => 'Getting Event Failed'], 404);
        }
    }

}
