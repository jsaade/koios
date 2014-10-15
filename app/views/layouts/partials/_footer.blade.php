<div class="container">
	<div class="row">
		<div class="col-md-12" id="footer-container">
			<div id="footer">
				<ul id='footer-list'>
					<li><a href="#">About</li>
					<li>
						{{ HTML::linkAction('DeveloperController@api', 'API') }}
					</li>
					<li>
						{{ HTML::linkAction('DeveloperController@console', 'Console') }}
					</li>
					<li><a href="#">Analytics</a></li>
					<li><a href="#">Roadmap</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>