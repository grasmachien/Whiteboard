fallback.load({
	jQuery: '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
	'script.dist.js' : 'js/script.dist.js'
}, {
	shim: {
		'app.js': ['jQuery']
	}
});

fallback.ready(function() {
});