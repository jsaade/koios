<div class="section no-mt" id="news-list">
	<h3>List News</h3>
	<p>
		Full list of the news:
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/news';

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



<div class="section no-mt" id="news-show">
	<h3>Single news info</h3>
	<p>
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/news/{news-id}/show';

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


<div class="section no-mt" id="news-categories">
	<h3>News Categories</h3>
	<p>
		List the news categories available.
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/news-categories';

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


<div class="section no-mt" id="news-by-category">
	<h3>List news by category</h3>
	<p>
		List the news for a specific category.
		<pre>
<code class="php">$url = 'http://koios.mercury.me/api/app/{api-key}/news/category/{category-id}';

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