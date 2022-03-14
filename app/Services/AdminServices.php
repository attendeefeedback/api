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
	use App\Models\Admin;

	class AdminServices
	{

	    /**
	     * @return string
	     */
	    public function adminEvents($unique_id)
	    {
	    	return Admin::where('unique_id',$unique_id)->where('active_flag',1)->with('events')->get();
		}

		/**
	     * @return string
	     */
	    public function adminLoginDetails($param)
	    {
	    	$data = Admin::where('email_id',$param['email_id'])->where('password',$param['password'])->where('active_flag',1)->get('unique_id')->toarray();
	    	return @$data[0]['unique_id'];
		}

	}

