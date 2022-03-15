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
	use App\Models\Event;
	use App\Models\EventStatusTracking;
	use Illuminate\Support\Str;

	class EventServices
	{
		
		private $event;

	    /**
	     * EventServices constructor.
	     * @param event $event
	     */
	    public function __construct(Event $event,EventStatusTracking $eventStatusTracking)
	    {
	        $this->event = $event;
	    }

		/**
	     * @return string
	     */
	    public function storeEventDetails($param)
	    {
	    	$event = new Event();
	    	$event->event_title = $param['event_title'];
            $event->event_desc = @$param['event_desc'];
            $event->event_img = @$param['event_img'];
            $event->event_location = @$param['event_location'];
            $event->event_time = @$param['event_time'];
            $event->is_published = @$param['is_published'];
            $event->event_code = Str::random(6);
            $event->unique_id = Str::orderedUuid();
            $event->admin_id = $param['admin_id'];
            $event->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $event->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $event->save();
            $logData = ['id' => $event->id,'event_status' => 'created']; 
            $this->addEventLog($logData);
	    }

	    /**
	     * @return string
	     */
	    public function editEventDetails($param)
	    {
	    	
            $data = [
                'event_title' => $param['event_title'],
                'event_desc' => @$param['event_desc'],
                'event_img' => @$param['event_img'],
                'event_location' => @$param['event_location'],
                'event_time' => @$param['event_time'],
                'is_published' => @$param['is_published'],
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $this->event->where('unique_id', $param['unique_id'])->where('admin_id',$param['admin_id'])->where('id',$param['id'])->update($data);
            $logData = ['id' => $param['id'],'event_status' => 'updated']; 
            $this->addEventLog($logData);
	    
	    }

	    /**
	     * @return string
	     */
	    public function deleteEvent($param)
	    {
	    	$data = [
                'active_flag' => 0,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            $this->event->where('unique_id', $param['unique_id'])->where('admin_id',$param['admin_id'])->where('id',$param['id'])->update($data);

            $logData = ['id' => $param['id'],'event_status' => 'deleted']; 
            $this->addEventLog($logData);
	    }

	    /**
	     * @return string
	     */
	    public function updateEventStatus($param)
	    {
	    	
            $data = [
                'event_status' => $param['event_status'],
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $this->event->where('unique_id', $param['unique_id'])->where('admin_id',$param['admin_id'])->where('active_flag',1)->where('id',$param['id'])->update($data);

            $logData = ['id' => $param['id'],'event_status' => $param['event_status']]; 
            $this->addEventLog($logData);
	    }

	    /**
	     * @return string
	     */
	    public function addEventLog($param)
	    {
	    	$log = new EventStatusTracking();
	    	$log->event_id = $param['id'];
	    	$log->event_status = $param['event_status'];
			$log->created_at = Carbon::now()->format('Y-m-d H:i:s');
	    	$log->updated_at = Carbon::now()->format('Y-m-d H:i:s');
	    	$log->save();
	    }

	}