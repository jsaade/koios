<div class="section no-mt" id="news">
	<h3>News and Categories</h3>

	<!-- list news -->
	<p>Full list of the application's news:</p>
<pre>
<code class="http">GET /api/app/{api-key}/news HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- single news -->
	<p>Displaying everything about one single news:</p>
<pre>
<code class="http">GET /api/app/{api-key}/news/{news-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- news categories -->
	<p>List the news categories available.</p>
<pre>
<code class="http">GET /api/app/{api-key}/news-categories HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- news by category -->
	<p>List the news of a specific category.</p>
<pre>
<code class="http">GET /api/app/{api-key}/news/category/{category-id} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

		
</div>