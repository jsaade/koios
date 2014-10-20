<div class="section no-mt" id="subscribers-create">
	<h3>Create a subscriber</h3>
	<p>
		To create a subscribers, send a POST request with the following parameters:
		<ul type="square">
			<li>username <code class="tip">required</code></li>
			<li>email <code class="tip">required</code></li>
			<li>is_verified</li>
			<li>password</li>
		</ul>
		The request will return the <code class="tip" class="tip">subscriberId</code>.
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/subscribers/create';
$data = array('username' => 'johnsnow', 'email' => 'john.snow@mercury.me', 'is_verified' => 1, 'password' => '12345678');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "X-Auth-Token: {api-secret}\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
</code>			
	<p>
</div>



<div class="section no-mt" id="subscribers-create-profile">
	<h3>Create a subscriber profile</h3>
	<p>
		A subscriber profile represents all the additional info of a subscriber:<br/>
		Weither it is a sign up form with first and last name, or a login via facebook with additional info such as profile picture, facebook id, likes ...
	</p>
	<p>
		To create a subscriber profile, send a POST request with the following parameters:
		<ul type="square">
			<li>first_name <code class="tip">required</code></li>
			<li>last_name <code class="tip">required</code></li>
			<li>image</li>
			<li>facebook_id</li>
		</ul>
		The request will return the <code class="tip">subscriberId</code> and the <code class="tip">subscriberProfileId</code>.
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/subscribers/{subscriber-id}/create-profile';
$data = ['first_name' => 'john', 'last_name' => 'snow', 'image' => 'http://john-image-url', 'facebook_id' => '789456132'];

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "X-Auth-Token: {api-secret}\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
</code>			
	<p>
</div>



<div class="section no-mt" id="subscribers-add-device">
	<h3>Add a subscriber device</h3>
	<p>
		A subscriber can have mutliple devices: mobiles, tablets ...<br/>
		To add a subscriber device, send a POST request with the following parameters:
		<ul type="square">
			<li>model <code class="tip" class="tip">required</code></li>
			<li>version</li>
			<li>os <code class="tip">required</code></li>
			<li>token <code class="tip">required</code></li>
		</ul>
		The request will return the <code class="tip">subscriberId</code> and the <code class="tip">deviceId</code>.
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/subscribers/{subscriber-id}/add-device';
$data = ['model' => 'iphone', 'os' => 'ios 8', 'version' => '5s', 'token' => '7913789456132'];

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "X-Auth-Token: {api-secret}\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
</code>			
	<p>
</div>


<div class="section no-mt" id="subscribers-list">
	<h3>List subscribers</h3>
	<p>
		List the (verified) subscribers of the application:
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/subscribers/';

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "X-Auth-Token: {api-secret}\r\n",
        'method'  => 'GET'
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
</code>			
	<p>
</div>


<div class="section no-mt" id="subscribers-show">
	<h3>subscriber Info</h3>
	<p>
		Full info about a subscriber:
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/subscribers/{subscriber-id}/show';

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "X-Auth-Token: {api-secret}\r\n",
        'method'  => 'GET'
        ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
</code>			
	<p>
</div>



