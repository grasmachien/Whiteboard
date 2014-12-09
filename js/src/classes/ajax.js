module.exports = (function(){

	var url = getUrlVars()["name"];

	function Ajax() {

		voorbeeldJSONGet();

	}

	//image op schermkrijgen met ajax
		function voorbeeldJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {
			  console.log(posts);
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

	return Ajax;

})();