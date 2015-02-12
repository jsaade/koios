<?php namespace Acme\Observers;
use Input;
use Device;

class DeviceObserver  
{
	
	public function created($device)
	{
		$input = Input::all();
		$uid = $device->uid;
		$subscriber_id  = $device->subscriber_id;
		$application_id = $device->application_id;

		//delete a device with the same uid if it ever exists (case for android)
		$d = Device::whereApplicationId($application_id)->whereSubscriberId($subscriber_id)->whereUid($uid)->get();

		if($d->count() > 1)
		{
			$d[0]->delete();
		}
	}	

	
}