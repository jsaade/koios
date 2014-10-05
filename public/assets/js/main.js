$(document).ready(function(){
	//bind ajax forms
	handleRemoteForms();
	
})

function handleRemoteForms()
{
	$('form[data-remote]').on('submit', function(e){
		e.preventDefault();
		var form = $(this);
		var method = form.find('input[name="_method"]').val() || "POST";
		var url = form.prop('action');
		var callback = form.data('callback');

		$.ajax({
			method: method,
			url: url,
			data: form.serialize(),
			success: function(response){
				if(callback)
					window[callback](response);
			}
		})
	})
}

function updateNewsCategoriesList(response)
{
	if(response.errors)
	{
		var html = "";
		for(var key in response.errors)
			html += "<li>" + response.errors["name"] + "</li>";
		$("#frm-add-alert ul").html(html);
		$("#frm-add-alert").show();
		return;
	}

	$("#news-category-list").html(response.data);
	$('input[name="name"]').val('');
}