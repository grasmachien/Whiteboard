module.exports = (function(){

	var DragDrop = require('../classes/DragDrop');
	var url = getUrlVars()["name"];

	function Ajax() {

		if(getUrlVars()["page"] === "board"){
			boardJSONGet();
		}

		var searchform = document.getElementById("searchForm");

		if (searchform) {
			searchResult();
		}

	}

	function searchResult(){

	var searchForm = document.getElementById('searchForm');
		if(searchForm) {

			var searchInput = searchForm.querySelector('input[type=search]');

			searchForm.addEventListener('submit', doSearch);
			searchInput.addEventListener('input', doSearch);
			
			function doSearch(event) {
				event.preventDefault();
				var req = new XMLHttpRequest();
				req.onload = function() {
					
					var result = document.createElement('div');
					
					result.innerHTML = req.responseText;

					var updatedResultDiv = result.querySelector('.projecten');
					
					var resultDiv = document.querySelector(".result");
					otherprojects = document.querySelectorAll(".project-th");
					resultDiv.parentNode.replaceChild(updatedResultDiv, resultDiv);
					console.log(resultDiv);
					
				}
				req.open('get', searchForm.getAttribute('action') + '&q=' + searchInput.value, true);
				req.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
				req.send();
			}
		}

	}

		function boardJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {
				console.log(posts);

			//users template
			console.log(posts);
			var templateSrc = $('#users-template').text();
			var template = Handlebars.compile( templateSrc );

			var result = template(posts);		
			$('.users-list').append($(result));

			//positits template

			var postTemplateSrc = $('#postit-template').text();
			var postTemplate = Handlebars.compile( postTemplateSrc );

			var postResult = postTemplate(posts);		
			$('.postit-list').append($(postResult));

			//video template

			var vidTemplateSrc = $('#video-template').text();
			var vidTemplate = Handlebars.compile( vidTemplateSrc );

			var vidResult = vidTemplate(posts);		
			$('.video-list').append($(vidResult));

			//image template

			var imgTemplateSrc = $('#img-template').text();
			var imgTemplate = Handlebars.compile( imgTemplateSrc );

			var imgResult = imgTemplate(posts);		
			$('.img-list').append($(imgResult));

			new DragDrop();


			});
		}

		function getUrlVars() {
		    var vars = {};
		    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		        vars[key] = value;
		    });
		    return vars;
		}

	return Ajax;

})();