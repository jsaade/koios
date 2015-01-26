@if (Session::has('flash_notification.message'))
   

	<script type="text/javascript">
		window.onload = function() {
		  
		  		$.growl({
					icon: "icon icon-comment-alt",
					message: " {{ Session::get('flash_notification.message') }}"
				}, {
					delay: 3000,
					type: "success"
				});
		};
	</script>
@endif