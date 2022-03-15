<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{

    /**
     * @var EventServices
     */
    private $eventServices;

    public function __construct(EventServices $eventServices)
    {
        $this->eventServices = $eventServices;
    }

    public function store(Request $request)
    {
        //
        try {
            // $getInput = app('securityServices')->decrypt($request['inedge_input']);
            // $params = (array)json_decode($request);
            $params = $request->input();
            $validator = Validator::make($params, ['event_title' => 'required', 'admin_id' => 'required|exists:admins,id', 'event_status' => 'required']);
            if ($validator->fails()) {
                return $this->validationError($validator->errors());
            }

            $data = $this->eventServices->storeEventDetails($params);
            return $this->sendSuccess($data);

        } catch (Exception $exception) {
            $this->sendError(['message' => 'Adding Event Failed'], 404);
        }
    }

    public function edit(Event $event)
    {
        //
        try {
            $params = $request->input();
            $validator = Validator::make($params, ['event_title' => 'required', 'admin_id' => 'required|exists:admins,id', 'event_status' => 'required', 'unique_id' => 'required']);
            if ($validator->fails()) {
                return $this->validationError($validator->errors());
            }

            $data = $this->eventServices->editEventDetails($params);
            return $this->sendSuccess($data);

        } catch (Exception $exception) {
            $this->sendError(['message' => 'Updating Event Failed'], 404);
        }
    }

    public function updateEventStatus(Event $event)
    {
        //
        try {
            $params = $request->input();
            $validator = Validator::make($params, ['admin_id' => 'required|exists:admins,id', 'event_status' => 'required', 'unique_id' => 'required']);
            if ($validator->fails()) {
                return $this->validationError($validator->errors());
            }

            $data = $this->eventServices->updateEventStatus($params);
            return $this->sendSuccess($data);

        } catch (Exception $exception) {
            $this->sendError(['message' => 'Updating Event Status Failed'], 404);
        }
    }
}
