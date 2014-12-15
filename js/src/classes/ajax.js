module.exports = (function(){

	var DragDrop = require('../classes/DragDrop');
	var url = getUrlVars()["name"];
	var postitbtn = document.querySelector('.postitbtn');
	var videobtn = document.querySelector('.videobtn');
	var imgbtn = document.querySelector('.imgbtn');

	function Ajax() {


		if(getUrlVars()["page"] === "board"){
			boardJSONGet();
		}

		//AJAX POSTIT

		if(postitbtn){
			postitbtn.addEventListener('click', function(){
				event.preventDefault();

				var postitinput = document.querySelector('.txtarea').value;
				var projectnaamhash = getUrlVars()["name"];
				projectnaam = projectnaamhash.substring(0, projectnaamhash.length - 1);

				$.post( "index.php?page=postpostit", { 
					tekst: postitinput,
					project: projectnaam
				})
				.done(function( data ) {
			    console.log(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    document.querySelector('.txtarea').value = " ";
			    closeWindow();
			    boardJSONGet();

			  });

			});
		}

		//AJAX IMAGE

		$('#imageupload').submit(function(event){
			event.preventDefault();

			$.ajax({
			  url: 'index.php?page=uploadimg',
			  type: 'POST',
			  data: new FormData(this),
			  processData: false,
			  contentType: false,
			  cache: false,
			  success: function(data){
			    // alert(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    closeWindow();
			    boardJSONGet();
			  }
			});	

		});

		//AJAX VIDEO

		$('#videoupload').submit(function(event){
			event.preventDefault();

			$.ajax({
			  url: 'index.php?page=uploadvideo',
			  type: 'POST',
			  data: new FormData(this),
			  processData: false,
			  contentType: false,
			  cache: false,
			  success: function(data){
			    // alert(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    closeWindow();
			    boardJSONGet();
			  }
			});	

		});


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

					var updatedResultDiv = result.querySelector('.projecten-overzicht');
					// if (!updatedResultDiv.querySelectorAll(".project-th")) {};
					var resultDiv = document.querySelector(".projecten-overzicht");
					otherprojects = updatedResultDiv.querySelectorAll(".project-th");
					resultDiv.parentNode.replaceChild(updatedResultDiv, resultDiv);	
					
			
					
				}
				req.open('get', searchForm.getAttribute('action') + '&q=' + searchInput.value, true);
				req.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
				req.send();
			}
		}



	}

		function boardJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {

			//users template

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

		function closeWindow(){

			var uploadblock = document.getElementById('pop');
				var form = document.getElementById('uploadwrap'); 
				var label = document.querySelector('#name');

				uploadblock.classList.remove("uploadblock");
				form.classList.remove("animform");
				uploadblock.classList.add("hidden");

				var txtupload = document.querySelector('#tekstupload');
				var videoupload = document.querySelector('#videoupload');
				var imageupload = document.querySelector('#imageupload');
				var persoonupload = document.querySelector('#persoonupload');

					txtupload.classList.add("hideform");
					videoupload.classList.add("hideform");
					imageupload.classList.add("hideform");
					persoonupload.classList.add("hideform");

		}

	return Ajax;

})();