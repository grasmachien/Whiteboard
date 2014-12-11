module.exports = (function(){

	var url = getUrlVars()["name"];

	function Ajax() {

		getJSON();

	}

	//image op schermkrijgen met ajax
		function getJSON() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {
			  console.log(posts.images);
			  placeImages(posts.images);
			  // var html = tpl(posts);
			  // $('.main').prepend(html);
			});
		}

		function getUrlVars() {
		    var vars = {};
		    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		        vars[key] = value;
		    });
		    return vars;
		}

		function placeImages(images){
			var templateImagesSrc = $("#template-images").text();
			console.log(templateImagesSrc);
			var templateImages = Handlebars.compile( templateImagesSrc );
			var data = images;
			var resultImages = templateImages(data);

			$('.bord-veld').append($(resultImages));

		}

	return Ajax;

})();