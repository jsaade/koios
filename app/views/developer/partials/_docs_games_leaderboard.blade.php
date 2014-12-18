<div class="section no-mt" id="leaderboard">
	<h3>Games Leaderboard</h3>

	<!-- Level -->
	<h5>Leaderboard by score</h5>
	<p>To get the leaderboard by score between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/score?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<h5>Leaderboard by level</h5>
	<p>To get the leaderboard by level between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/level?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<h5>Leaderboard by meta</h5>
	<p>To get the leaderboard by meta_key between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/meta/{meta_key}?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<p>
	by default the meta's are casted as integer when sorted, you can add a query string param <strong>?cast=char</strong> to treat
	them as string
</p>

<h5>Leaderboard with current rank</h5>
<p>
	For all the leaderboard, adding ?subscriber_id={id} will return the subscriber's rank in the leaderboard.
</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/score?subscriber_id={id} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>
</div>