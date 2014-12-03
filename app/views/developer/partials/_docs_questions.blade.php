<div class="section no-mt" id="quiz">
	<h3>Quiz</h3>

	<!-- list questions -->
	<h5>list all questions</h5>
	<p>Full list of questions of the application's quiz:</p>
	<p>Note: adding the <strong>?rand=1</strong> query string will select random rows</p>
<pre>
<code class="http">GET /api/app/{api-key}/questions HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

<p>
	the returned fields can be filtered simply by passing <strong>?fields=</strong> query string.<br/>
	For example, <strong>?fields=id,description,image</strong> will only return the 3 fields set.<br/>
	The available options for the fields parameter are:
	<ul>
		<li>id</li>
		<li>description</li>
		<li>thumb</li>
		<li>image</li>
		<li>answers</li>
		<li>api_url</li>
	</ul>
</p>

<p>Note: Adding <strong>?rand=1</strong> will select random questions</p>

	<!-- single question -->
	<h5>list single question</h5>
	<p>Displaying everything about one single question and its answers:</p>
<pre>
<code class="http">GET /api/app/{api-key}/questions/{question-id}/show HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

	<!-- Subscriber answering a question -->
	<h5>(subscriber) Answer question</h5>
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
	<h5>List subsriber's answers</h5>
	<p>Displaying all the answers submitted by a subscriber on a quiz questions:</p>
<pre>
<code class="http">GET /api/app/{api-key}/subscribers/{subscriber-id}/answers HTTP/1.1

X-Auth-Token: {md5(api-secret-here)}
Host: koios.mercury.me
Content-Type: application/json; charset=utf-8
</code>
</pre>

</div>