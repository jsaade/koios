<div class="section" id="limit-pagination">
	<h3>Limits and pagination</h3>
	<p>
		Adding the <code class="tip">limit</code> will paginate any <code class="tip">GET</code> request.<br/>
		By default, the limit is set to 25, and the response will have the next and prev links if applicable.
	</p>
<pre>
<code class="http">GET /api/app/{api-key}/news?limit=5  HTTP/1.1</code>
</pre>	
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
				<td class='status-code'>201</td>
				<td>Created | a record is created in the database</td>
			</tr>
			<tr>
				<td class='status-code'>204</td>
				<td>No Content | when deleting a record from the databse</td>
			</tr>
			<tr>
				<td class='status-code'>400</td>
				<td>Bad Request | the meta key doesn't exist.</td>
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
				<td class='status-code'>449</td>
				<td>Retry with valid parameters</td>
			</tr>
			<tr>
				<td class='status-code'>498</td>
				<td>Invalid Token</td>
			</tr>
			<tr>
				<td class='status-code'>499</td>
				<td>Required Token</td>
			</tr>
			<tr>
				<td class='status-code'>500</td>
				<td>Internal server error</td>
			</tr>										
		</tbody>
	</table>
</div>
