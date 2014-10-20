<div class="section" id="limit-pagination">
	<h3>Limits and pagination</h3>
	<p>
		Adding the <code class="tip">limit</code> will paginate any <code class="tip">GET</code> request.<br/>
		By default, the limit is set to 25, and the response will have the next and prev links if applicable.
		<pre class="html">
<code>http://koios.mercury.me/api/app/{api-key}/news/{news-id}/show?limit=5</code>
		</pre>
		
	</p>	
</div>


<div class="section" id="http-status-codes">
	<h3>HTTP Status Codes</h3>
	<p>
		When a request is made to your server for a page on your site (for instance, when a user accesses your page in a browser or when Googlebot crawls the page), your server returns an HTTP status code in response to the request
This status code provides information about the status of the request.
	</p>

	<table class="listing">
		<tr>
			<th>Status Code</th>
			<th>Message</th>
		</tr>
		<tbody>
			<tr>
				<td class='status-code'>200</td>
				<td>Response is OK!</td>
			</tr>
			<tr>
				<td class='status-code'>401</td>
				<td>Unauthorized | You don't have permission to perform this request.</td>
			</tr>
			<tr>
				<td class='status-code'>403</td>
				<td>Forbidden | The specified {model} does not belong to this application</td>
			</tr>	
			<tr>
				<td class='status-code'>404</td>
				<td>Invalid Request URL</td>
			</tr>
			<tr>
				<td class='status-code'>405</td>
				<td>HTTP method not allowed for this request</td>
			</tr>
			<tr>
				<td class='status-code'>409</td>
				<td>Retry with valid parameters</td>
			</tr>
			<tr>
				<td class='status-code'>500</td>
				<td>Internal server error</td>
			</tr>										
		</tbody>
	</table>
</div>
