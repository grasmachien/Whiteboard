(function(){


	function init(){

		fallback.load({
			jQuery: ['//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
			'js/vendor/jquery/dist/jquery.min.js'],
			'script.dist.js' : 'js/script.dist.js',
			Handlebars: [
			'js/vendor/handlebars/handlebars.min.js']
		}, {
			shim: {
				'script.dist.js': ['jQuery']
			}
		});

		fallback.ready(function() {

			// Execute my code here!
		});
	}


	init();

})();
