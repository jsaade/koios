$(document).ready(function(){
	console.log('s');
	//bind ajax forms
	handleRemoteForms();
	//bind ajax links
	handleRemoteLinks();
	//application menu
	$('#application-menu-btn').sidr({
		source: '#application-side-menu-content'
	});
})

function handleRemoteForms()
{
	$('body').on('submit', 'form[data-remote]', function(e){
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
					window[callback](response, form);
			}
		})
	})
}

function handleRemoteLinks()
{
	$('body').on('click', 'a[data-remote]', function(e){
		e.preventDefault();
		var anchor = $(this);
		var url = anchor.prop('href');
		var callback = form.data('callback');

		$.ajax({
			method: method,
			url: url,
			success: function(response){
				if(callback)
					window[callback](response);
			}
		})
	});
}


/**************************
 * NEWS CATEGORIES MODULE *
 **************************/

function updateNewsCategoriesList(response, form)
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

function removeNewsCategory(response, form)
{
	$(form).closest('tr').fadeOut(750);
}

/***************
 * NEWS MODULE *
 ***************/

 function removeNews(response, form)
{
	$(form).closest('tr').fadeOut(750);
}