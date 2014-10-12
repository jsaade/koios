$(document).ready(function(){
	initDeveloperConsole();
	//bind ajax forms
	handleRemoteForms();
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

/********************
 * QUESTIONS MODULE *
 ********************/

 function removeQuestion(response, form)
{
	$(form).closest('tr').fadeOut(750);
}

/*********************
 * DEVELOPER CONSOLE *
 *********************/

function initDeveloperConsole()
{
	$("input[name='console-url']").on("keypress", function(e){
		var input = $(this);
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == 13) 
			getApiResponse(input.val());
	})

	$("body").on("click", "#response a", function(e){
		e.preventDefault();
		var url = $(this).text();
		url = url.replace(/\"/g, ""); //remove quotes returned from json
		var index = url.indexOf('app/') + 4;
		var uri = url.substr(index);
		getApiResponse(uri);
		$("input[name='console-url']").val(uri);
	})
}

function getApiResponse(uri)
{
	var action = $("input[name='action']").val();
	$.ajax({
			method: "POST",
			url: action,
			data: {"uri": uri},
			success: function(data){
				//prettify the json request
				//var jsonObj = JSON.parse(data);
				//var jsonPretty = JSON.stringify(jsonObj, null, '\t');

				//$("#response").html("<pre class='naked'>"+jsonPretty+"</pre>");
				$("#response").JSONView(data);
			}
		})
}