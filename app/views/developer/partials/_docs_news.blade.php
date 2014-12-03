<div class="section no-mt" id="news">
	<h3>News and Categories</h3>

	<!-- list news -->
	<h5>List all news</h5>
	<p>Full list of the application's news:</p>
<pre>
<code class="http">GET /api/app/{api-key}/news HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<p>
	the returned fields can be filtered simply by passing <strong>?fields=</strong> query string.<br/>
	For example, <strong>?fields=id,name,category</strong> will only return the 3 fields set.<br/>
	The available options for the fields parameter are:
	<ul>
		<li>id</li>
		<li>name</li>
		<li>category</li>
		<li>caption</li>
		<li>description</li>
		<li>thumb</li>
		<li>image</li>
		<li>created_at</li>
		<li>api_url</li>
	</ul>
</p><br/>

	<!-- single news -->
	<h5>List single news</h5>
	<p>Displaying everything about one single news:</p>
<pre>
<code class="http">GET /api/app/{api-key}/news/{news-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- news categories -->
	<h5>List news categories</h5>
<pre>
<code class="http">GET /api/app/{api-key}/news-categories HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- news by category -->
	<h5>list all news by category</h5>
<pre>
<code class="http">GET /api/app/{api-key}/news/category/{category-id} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

		
</div>