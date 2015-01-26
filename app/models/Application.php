<?php

class Application extends \Eloquent {
	protected $table = 'application';
	protected $fillable = ['name', 'description', 'image', 'slug', 'api_key', 'api_secret', 'client_id', 'ios_password', 'ios_certificate', 'android_api_key', 'email_from', 'email_value', 'pagination_per_page'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function components()
	{
		return $this->belongsToMany('Component');
	}

	public function newsCategories()
	{
		return $this->hasMany('NewsCategory');
	}

	public function questions()
	{
		return $this->hasMany('Question');
	}

	public function subscribers()
	{
		return $this->hasMany('Subscriber');
	}

	public function contactForms()
	{
		return $this->hasMany('ContactForm');
	}

	public function assets()
	{
		return $this->hasMany('Asset');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'client' => 'required|exists:client,id'
	];

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	/****************
	 * IMAGE UPLOAD *
	 ****************/
	public function getUploadsPath()
	{
		$path = uploads_path().$this->slug."/";
		File::exists($path) or File::makeDirectory($path);

		return $path;
	}

	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->slug."/";
	}

	public function upload_image($uploaded_image)
	{
		$image = Image::make($uploaded_image->getRealPath()); 
		$filename = $uploaded_image->getClientOriginalName();
		$image->save($this->getUploadsPath().$filename)
			  ->resize(128, 128)
			  ->save($this->getUploadsPath()."128-".$filename);

		return $filename;
	}

	/********************
	 * Application Menu *
	 ********************/
	public function renderMenu()
	{
		$view = View::make('application.partials._menu')->withApplication($this);
		$this->hasComponent('News');
		return $view->render();
	}

	public function hasComponent($componentName)
	{
		$components = $this->components->lists('name', 'id');
		if(in_array($componentName, $components))
			return true;

		return false;
	}


	/****************************************************
	 * APP DEVICE METHODS RELATED TO PUSH NOTIFICATIONS *
	 ****************************************************/
	public function getDevices($model = null)
	{
		if($model)
			return Device::whereApplicationId($this->id)->whereModel($model)->get();

		return Device::whereApplicationId($this->id)->get();
	}

	public function getApplicationDeviceTokens($model = "iphone")
	{
		$devices = $this->getDevices($model);
		$tokens_collected = [];
		foreach($devices as $device)
		{
			if($device->model == $model)
			{
				$token = ($model == "iphone")?strtolower($device->token):$device->token;
				array_push($tokens_collected, $token);	
			}
				
		}			
		//get the unique ones only
		$tokens_collected = array_unique($tokens_collected);
		return $tokens_collected;
	}

	/**
	 * Validates the good device tokens with apns/android adapter and deletes the wrong ones
	 * @param  PushNotification $app [description]
	 * @return [type]          [description]
	 */
	public function preparePushDevices($app, $device_tokens)
	{
		$tokens = [];
		foreach($device_tokens as $t)
		{
			if( $app->adapter->supports($t) )
				array_push( $tokens, PushNotification::Device($t));
			else
			{
				$device = Device::whereToken($t)->whereApplicationId($this->id);
				$device->delete();
			}
		}
		$devices = PushNotification::DeviceCollection($tokens);
		return $devices;
	}


	/********************
	 * Application Cert *
	 ********************/
	public function upload_certificate($uploaded_cert)
	{
		$destinationPath = $this->getUploadsPath();
		$filename = $uploaded_cert->getClientOriginalName();
		
		$uploaded_cert->move($destinationPath, $filename);
		return $filename;
	}
	
	public function updateCertificatesConfig()
	{
		$config_file = app_path() . "/config/packages/davibennun/laravel-push-notification/config.php";
		$contents = File::get($config_file);
		//skip the '<?php' and eval the array
		$contents = substr($contents, 5);
		$cf = eval($contents);
		//update the ios config in the array
		$cf[$this->slug."_IOS"] = [
			'environment' => 'production',
			'passPhrase'  => $this->ios_password,
			'service'     =>'apns',
			'certificate' => $this->getUploadsPath().$this->ios_certificate
		];
		//update the android config in the array 
		$cf[$this->slug."_ANDROID"] = [
			'environment' => 'production',
			'apiKey'      => $this->android_api_key,
			'service'     =>'gcm'
		];
		//convert the array to a writable string as we know the structure of the config file
		$str = "<?php \r\n";
		$str .= "	return array(\r\n";
		$str .= "\r\n";
		foreach($cf as $key => $val)
		{
			$str .= "		'".$key."' => array(\r\n";
			foreach($val as $setting => $value)
				$str .= "			'".$setting."' => '".$value."',\r\n";
			//remove last comma inside the array
			$str  = trim($str, "\r\n,");
			$str .= "\r\n";	
			$str.= "		),\r\n";
			$str .= "\r\n";	
		}
		//remove last comma inside the array
		$str  = trim($str, "\r\n,");
		$str .= "\r\n";	
		$str.= ");";
			
		$bytes_written = File::put($config_file, $str);
		if ($bytes_written === false)
		{
		    die("Error writing to the config file");
		}
	}
}