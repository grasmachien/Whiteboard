module.exports = (function(){

	var DragDrop = require('../classes/DragDrop');
	var url = getUrlVars()["name"];
	var postitbtn = document.querySelector('.postitbtn');

	function Ajax() {


		if(getUrlVars()["page"] === "board"){
			boardJSONGet();
		}


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

			    boardJSONGet();


			  });


			});
		}
	

	}

		function boardJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {
				console.log(posts);

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

			console.log('ik verlaat ajax');

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