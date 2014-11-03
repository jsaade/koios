<div class="section no-mt" id="leaderboard">
	<h3>Games Leaderboard</h3>

	<!-- Level -->
	<p>To get the leaderboard by score between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/score?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<p>To get the leaderboard by level between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/level?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<p>To get the leaderboard by meta_key between all subscribers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/leaderboard/meta/{meta_key}?sort=desc HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>