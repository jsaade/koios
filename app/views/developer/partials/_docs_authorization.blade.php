<div class="section no-mt" id="auth">
	<h3>Authorization & Authentication</h3>
	<p>
		The Koios API is the primary way to get data in and out of its created apps.<br/>
		It's a low-level HTTP-based API that you can use to query data, subscribe users, <br/>
		create profiles and a variety of other tasks that an app might need to do.
	</p>
	<p>
		Every request is secured with an HTTP Header <strong>X-Auth-Token</strong>, in which the application 
		secret key is encrypted to md5.
	</p>

<pre>
<code class="http">GET /api/app/{api-key}/news HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<p>
		Any POST request related to the subscriber needs authentication verification, therefore an access_token should be passed.<br/>The access token is sent upon creating the subscriber or can be queried with a specific request.
	</p>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber_id}/create-profile?access_token={token-here} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


</div>