<div class="section no-mt" id="authorization">
	<h3>Authorization</h3>
	<p>
		The Koios API is the primary way to get data in and out of its created apps.<br/>
		It's a low-level HTTP-based API that you can use to query data, subscribe users, <br/>
		create profiles and a variety of other tasks that an app might need to do.
	</p>
	<p>
		Every request is secured with an HTTP Header <strong>X-Auth-Token</strong>, in which the application 
		secret key is stored.<br/>The below examples demontsrate how to send the token header via CURL and PHP.
	</p>

	<h5>Sending headers with CURL</h5>
	
	<pre>
		<code class="python">curl -X GET -H "X-Auth-Token: {api-secret-here}" http://koios.mercury.me/api/app/{api-key}/news</code>
	</pre>

	<h5>Sending headers with PHP</h5>
	
	<pre>
<code class="php">$opts = array(
'http'=> ['method'=>"GET", 'header'=>"X-Auth-Token: {api-secret-here}\r\n"]
);

$context = stream_context_create($opts);
$file = file_get_contents('http://koios.mercury.me/api/app/{api-key}/news', false, $context);
</code>
	</pre>



</div>