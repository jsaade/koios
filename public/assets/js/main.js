$(document).ready(function(){
	
	$(".main").fullPageHeight();
	$(window).resize(function(){
 		$(".main").fullPageHeight();
 	});

	initDeveloperConsole();
	
	//bind ajax forms
	handleRemoteForms();

	//application menu
	$('#application-menu-btn').sidr({
		source: '#application-side-menu-content'
	});

	//docs api nav
	if($(".sidebar-nav").length)
	{
		$('body').scrollspy({ target: '.sidebar-nav' });
	}

	//news category nested sets 
	initNestedNewsCategories();

	//news category filter
	if($("#news_category_filter").length)
	{
		$("#news_category_filter").change(function(){
			var url;
			if($(this).val() == "0")
				url = $("#news-url").val();
			else
			    url = $("#news-url").val() + "?category=" + $(this).val();
			
			window.location.href=url;
		})
	}

	//bootstrap tooltip 
	$('[data-toggle="tooltip"]').tooltip({'placement': 'left'});
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

// add a category
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
	initNestedNewsCategories();
}

function removeNewsCategory(response, form)
{
	$(form).closest('li').fadeOut(750);
}

function initNestedNewsCategories()
{
	if($("#nestable").length)
	{
		$('#nestable').nestable({
			'expandBtnHTML': '-',
			'collapseBtnHTML': '+',
			'group': 1,
			'listNodeName': 'ul' 
		})
	    .on('change', sortCategories);
	}	
}

function sortCategories(e)
{
   var str = window.JSON.stringify($('#nestable').nestable('serialize'));
   var request_url = $("#sort-url").val();
   console.log(str);
   $.ajax({
		url: request_url,
		type: "POST",
		data: { "json_string" : str},
		success: function(data){
			// ...
		}
	})
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


/***********************
 * CONTACT FORM MODULE *
 ***********************/

 function removeContactForm(response, form)
{
	$(form).closest('tr').fadeOut(750);
}

/*********************
 * DEVELOPER CONSOLE *
 *********************/

function initDeveloperConsole()
{
	//Submit request
	$("input[name='console-url']").on("keypress", function(e){
		var input = $(this);
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == 13) 
		{
			var api_home_url = $("input[name='_api_home_url']").val(); 
			var method = $("select[name='method'] option:selected").val();
			var request_url = api_home_url + input.val();
			getApiResponse(request_url, method);
		}
	})

	//bind the inside links in the response 
	$("body").on("click", "#response a", function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var index = url.indexOf('app/') + 4;
		var uri = url.substr(index);
		$("input[name='console-url']").val(uri);
		getApiResponse( url, 'GET');
	})
	//generate post params
	$("input[name='post_key[]']").on("blur", function(e){
		var new_params = $(".params-container:last").clone(true);
		new_params.find("input[name='post_key[]']").val('');
		$("#post-params").append(new_params);
	})

	//remove a post param row
	$("body").on("click", ".params-container .remove-row", function(){
		$(this).closest('.params-container').remove();
	})

	//toggle post params container
	$("select[name='method']").change(function(e)
	{
		if($(this).val() == "POST")
		{
			$("div#post-params input").val('');
			$("div#post-params").show();
		}
		else
			$("div#post-params").hide();
	})
}

function getApiResponse(request_url, method)
{
	var _data = "";

	if(method == "POST")
	{
		$("input[name='post_key[]']").each(function(){
		  key = $(this).val();
		  value = $(this).closest('.params-container').find("input[name='post_value[]']").val();
		  _data += key + "=" + value + "&";
		})
		_data = _data.substring(0, _data.length - 1);
	}

	$.ajax({
		url: request_url,
		type: method,
		data: _data,
		beforeSend: function(xhr){
			xhr.setRequestHeader('X-Auth-Token', 'console');
			$("#response").empty();
			$("#response").addClass('with-loader');
		},
		success: function(data){
			setTimeout(
			  function() 
			  {
				 $("#response").JSONView(data);
				 $("#response").removeClass('with-loader');
			  }, 1000);
		}
	})
}

$.fn.fullPageHeight = function(){
	
	
	_content_height = $("html").height(); 
	_viewport_height = $(document).height();
	_fill_height = _viewport_height - _content_height;

	if(_fill_height > 0)
	{
		$(".main").height( ($(".main").height() + _fill_height) );
	}
}