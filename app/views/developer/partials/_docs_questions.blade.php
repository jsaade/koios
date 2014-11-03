<div class="section no-mt" id="quiz">
	<h3>Quiz</h3>

		<!-- list questions -->
	<p>Full list of questions of the application's quiz:</p>
<pre>
<code class="http">GET /api/app/{api-key}/questions HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- single question -->
	<p>Displaying everything about one single question and its answers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/questions/{question-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<!-- Subscriber answering a question -->
	<p>
		A subscriber can answer to any question of the quiz by submitting the a POST request with the following parameters.
		<ul type="square">
			<li>answer_id <code class="tip">required</code></li>
		</ul>
		The request will return the <code class="tip">QuestionSubscriberId</code>.		
	<p>
<pre>		
<code class="http">POST /api/app/{api-key}/subscribers/{subscriber-id}/questions/{question-id}/answer?access_token={token} HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>


	<!-- Subscriber's answers -->
	<p>Displaying all the answers submitted by a subscriber on a quiz questions:</p>
<pre>
<code class="http">GET /api/app/{api-key}/subscribers/{subscriber-id}/answers HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>