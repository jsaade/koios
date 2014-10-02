@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		 <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</div>
@endif 