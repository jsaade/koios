<div class="section no-mt" id="subscribers">
	<h3>Subscribers</h3>
	
	<!-- create -->
	<h5>Create</h5>
	<p>
		To create a subscriber, send a POST request with the following parameters:
		<ul type="square">
			<li>username <code class="tip">required</code></li>
			<li>email <code class="tip">required</code></li>
			<li>password Or facebook_id <code class="tip">required</code></li>
		</ul>
		The request will return the subscriber's<code class="tip">access_token</code> and the <code class="tip">subscriberId</code>.
	<p>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/create HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<p>
	If the password is passed instead of the facebook id, the subscriber will recieve an activation link to be verified.<br/>
		To resend the activation link again:
<pre>
<code class="http">GET /api/app/{api-key}/resend-activation-email?email=example@domain.com HTTP/1.1
</code>
</pre>
</p>


<p>
	Also, for password recovery, the subscriber will receive an email with a link to update his password by requesting:
<pre>
<code class="http">GET /api/app/{api-key}/send-password-email?email=example@domain.com HTTP/1.1
</code>
</pre>
</p> 		
	<!-- create-profile -->
	<h5>Create profile</h5>
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
		</ul>
		The request will return the <code class="tip">subscriberId</code> and the <code class="tip">subscriberProfileId</code>.
	</p>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber_id}/create-profile?access_token={token-here} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<!-- register -->
<h5>Register</h5>
<p>You can create a subscriber and its profile in one request, with the following paramters.</p>
<ul type="square">
	<li>first_name <code class="tip">required</code></li>
	<li>last_name <code class="tip">required</code></li>
	<li>username <code class="tip">required</code></li>
	<li>email <code class="tip">required</code></li>
	<li>password or facebook_id <code class="tip">required</code></li>
</ul>
<pre>
<code class="http">POST /api/app/{api-key}/subscribers/register HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>
<p>The request will return the <code class="tip">subscriberId</code> and the <code class="tip">subscriberProfileId</code> and the 
<code class="tip">access_token</code>.</p>


	<!-- add-device -->
	<h5>Add device</h5>
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
	</p>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber_id}/add-device?access_token={token-here} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<!-- delete device -->
	<h5>remove device</h5>
	<p>To remove a subscriber's device, submit a post request with the following parameters:</p>
	<ul type="square">
		<li>token <code class="tip">required</code></li>
	</ul>
<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/remove-device?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- list all the subscribers -->
	<h5>List all subscribers</h5>
	<p>List the (verified) subscribers of the application:</p>

<pre>
<code class="http">GET /api/app/{api-key}/subscribers HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- single subscriber -->
	<h5>list single subscriber</h5>
	<p>Full info about a single subscriber (with profile and devices):</p>
<pre>
<code class="http">GET /api/app/{api-key}/subscribers/{subscriber-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>



