<div class="section no-mt" id="questions-list">
	<h3>List News</h3>
	<p>
		Full list of the questions:
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/questions';

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



<div class="section no-mt" id="questions-show">
	<h3>Single question info</h3>
	<p>
		Retrieves the question info with the answers list (including the correct one)
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/questions/{question-id}/show';

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