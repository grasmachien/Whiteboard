module.exports = (function(){

	var url = getUrlVars()["name"];

	function Ajax() {

		if(getUrlVars()["page"] === "board"){
			boardJSONGet();
		}

	}

		function boardJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {
				// console.log(posts);

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