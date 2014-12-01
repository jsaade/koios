<div class="section no-mt" id="tokens">
	<h3>Access Token</h3>

	<!-- via facebook -->
	<h5>Login with facebook</h5>
	<p>
		To get the access token, the subscriber has to be logged in (via email or facebook)<br/>
		To login through facebook, send a POST request with the following parameter(s):
	</p>
	<ul type="square">
		<li>facebook_user_token <code class="tip">required</code></li>
	</ul>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/login-via-facebook HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<!-- via email -->
<h5>Login with email</h5>
<p>
	To login through email, send a POST request with the following parameter(s):
</p>
<ul type="square">
	<li>email <code class="tip">required</code></li>
	<li>password <code class="tip">required</code></li>
</ul>
<pre>
<code class="http">POST /api/app/{api-key}/subscribers/login-via-email HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

Both requests will return the <code class="tip">subscriberId</code> and the <code class="tip">access_token</code>.
		
</div>