<?php

use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class DriveController extends AppController
{
    
	/** ********************************************** DRIVE APIS ********************************************************** **/
    
    /** Rit
     * API for sending the booking request for the driver.
     * POST /sendBookingRequest
     * @param input 
     * @return Response
     * @internal param $drive_request_id
     */
    public function sendBookingRequest()
    {
    	try {
    		/* $inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		
    		$generatedDriveCode = "VDR".bin2hex(openssl_random_pseudo_bytes(2));//16
    		$returnStatus = DB::table('drive_request')->insert(array(
    				'drive_code' 		=> $generatedDriveCode,
    				'customer_name' 	=> $inputs_array['customername'],
    				'customer_phone' 	=> $inputs_array['phonenumber'],
    				'email_id'		 	=> $inputs_array['email_id'],
    				'pickup_point' 		=> $inputs_array['pickuppoint'],
    				'drop_point' 		=> $inputs_array['droppoint'],
    				'device_id' 		=> $inputs_array['deviceid'],
    				'status' 			=> "Requested"
    		)); */
    		
    		//Test
    		$generatedDriveCode = "VDR".bin2hex(openssl_random_pseudo_bytes(2));//16
    		$returnStatus = DB::table('drive_request')->insert(array(
    				'drive_code' 		=> $generatedDriveCode,
    				'customer_name' 	=> 'customername',
    				'customer_phone' 	=> 1111111,
    				'email_id'		 	=> 'email_id',
    				'pickup_point' 		=> 'pickuppoint',
    				'drop_point' 		=> 'droppoint',
    				'device_id' 		=> 'deviceid',
    				'status' 			=> "Requested"
    		));
    		
    		$drive_request_id = DB::getPdo()->lastInsertId();
    	
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $drive_request_id;
    }
    
    
    /** Rit
     * API for accepting the driver request and assigning the driver for the requested customer.
     * POST /assignDriverForRide
     * @param input
     * @return Response
     * @internal param $drive_request_id
     */
    public function assignDriverForRide()
    {
    	try {
    		/* $inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		$driveId = $inputs_array['driveId'];
    		
    		$driveDetails = DriverRequest::find($driveId);
    		$driveDetails->driver_id = $inputs_array['driverId'];
    		
    		$driveDetails->save(); */
    		
    		//TEST
    		
    		$driveDetails = DriveRequest::find(3);
    		$driveDetails->driver_id = 1;
    		
    		$driveDetails->save();
    		
    	} catch (Exception $e) {
    		return $e;
    		//return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $driveDetails;
    }
    
    /** Rit
     * API for showing the latest status to the customer after booking.
     * GET /showBookingStatusForCustomer
     * @param input
     * @return Response
     * @internal param $driveDetails
     */
    public function showBookingStatusForCustomer()
    {
    	try {
    		$inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		$driveId = $inputs_array['driveId'];
    	
    		$driveDetails = DriverRequest::find($driveId);
    		
    		
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $driveDetails;
    }
    
    /** Rit
     * API for showing the latest status to the driver about the customer.
     * GET /showBookingStatusForDriver
     * @param
     * @return Response
     * @internal param $driveDetails
     */
    public function showBookingStatusForDriver()
    {
    	try {
    		$inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		$driveId = $inputs_array['driveId'];
    		 
    		$driveDetails = DriverRequest::find($driveId);
    
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $driveDetails;
    }  
    
    /** Rit
     * API for setting the start time for the drive.
     * GET /startDrive
     * @param input
     * @return Response
     * @internal param $driveDetails
     */
    public function startDrive()
    {
    	try {
    
    /* 		$inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		$driveId = $inputs_array['driveId'];
    		
    		$driveDetails = DriverRequest::find($driveId);
    		$driveDetails->drive_start_time = date("D M j G:i:s");    		
    		$driveDetails->save(); */
    		
    		
    		// TEST
    		$driveDetails = DriveRequest::find(3);
    		$dt = new DateTime();
    		$dt->format('Y-m-d H:i:s');
    		$driveDetails->drive_start_time =   $dt;
    		$driveDetails->save();
    
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $driveDetails;
    }
    
    /** Rit
     * API for setting the end time for the drive.
     * GET /endDrive
     * @param input
     * @return Response
     * @internal param $driveDetails
     */
    public function endDrive()
    {
    	try {
    		$inputs = Input::all();
    		$inputs_array = $inputs['data'];
    		$driveId = $inputs_array['driveId'];
    		
    		$driveDetails = DriverRequest::find($driveId);
    		$driveDetails->drive_end_time = date("D M j G:i:s");
    		
    		$driveDetails->save();
    		
    		$totalCalcAmount = calculateTotalDriveRate($driveDetails->drive_start_time,$driveDetails->drive_end_time);
    		
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $driveDetails;
    }
    
    /** Rit
     * API for calculating the total drive rate based on various criteria.
     * GET /calculateTotalDriveRate
     * @param $driveDetails
     * @return Response
     * @internal param $driveDetails
     */
    public function calculateTotalDriveRate($starttime,$endtime)
    {
    	try {
    		
    		//TODO
    		
    		
    		//$totalCalculatedAmount = calculateCharges($firstHourCharge,$totalMinutes,$ratePerMinutes);
    		
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $totalCalculatedAmount;
    }
    
    /** Rit
     * API for calculating the total charges.
     * GET /calculateCharges
     * @param
     * @return Response
     * @internal param $totalCalculatedAmount
     */
    public function calculateCharges($firstHourCharge,$totalMinutes,$ratePerMinutes)
    {
    	try {
    		$balanceMinute=0;
    		if($totalMinutes > 60){
    			$balanceMinute = $totalMinutes-60;
    		}
    		
    		$totalCalculatedAmount = $firstHourCharge + ($balanceMinute * $ratePerMinutes);
    
    	} catch (Exception $e) {
    
    		return $this->setStatusCode(500)->respondWithError($e);
    	}
    	return $totalCalculatedAmount;
    }
   
 
}