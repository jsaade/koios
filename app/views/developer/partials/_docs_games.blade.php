<div class="section no-mt" id="games">
	<h3>Games</h3>

	<h5>Update scode and level</h5>
	<p>Every game application, have very common fields (level and fields), and maybe some other attributes that differs from a game to another one.</p>
	<!-- Subscriber answering a question -->
	<p>
		A subscriber can update his score and level by submitting the a POST request with the following parameters.
		<ul type="square">
			<li>score <code class="tip">required</code></li>
			<li>level <code class="tip">required</code></li>
		</ul>
		The request will return the <code class="tip">subscriberId</code>.		
	<p>
<pre>		
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/update?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- Subscriber's add meta -->
	<h5>create meta</h5>
	<p>
		Sometimes additioanl fields are needed in a specific game, for example, health, gold etc ...These fields are called meta(s).
	</p>
	<p>
		To create a new game meta for a subscriber, submit a post request with following parameters:
		<ul type="square">
			<li>meta_key<code class="tip">required</code></li>
			<li>meta_value<code class="tip">required</code></li>
		</ul>
		The request will return the <code class="tip">subscriberId</code> and the <code class="tip">GameMetaId</code>.
	</p>

<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/add-game-meta?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<!-- update meta -->
	<h5>Update meta</h5>
	<p>
		To update a subscriber's meta, submit a post request as follows:
		<ul type="square">
			<li>meta_value<code class="tip">required</code></li>
		</ul>
	</p>
<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/update-game-meta/{meta-key}?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- delete meta -->
	<h5>delete meta</h5>
	<p>To remove a subscriber's meta, submit a post request as follows:</p>
<pre>
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/delete-game-meta/{meta-key}?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- Game info -->
	<h5>list (subscriber) game info</h5>
	<p>To get the subscriber's score, level and custom metas, submit a GET request as follows:</p>
<pre>
<code class="http">GET /api/app/{api-key}/subscribers/{subscriber-id}/game-info HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>