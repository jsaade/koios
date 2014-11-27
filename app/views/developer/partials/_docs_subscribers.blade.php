<div class="section no-mt" id="subscribers">
	<h3>Subscribers</h3>
	
	<!-- create -->
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


	<!-- create-profile -->
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


	<!-- add-device -->
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


	<!-- list all the subscribers -->
	<p>List the (verified) subscribers of the application:</p>

<pre>
<code class="http">GET /api/app/{api-key}/subscribers HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- single subscriber -->
	<p>Full info about a single subscriber (with profile and devices):</p>
<pre>
<code class="http">GET /api/app/{api-key}/subscribers/{subscriber-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>



