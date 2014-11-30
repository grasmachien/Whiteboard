(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function(){

	var App = require('./classes/App');
	function init() {
		new App();

		var txt = document.querySelector('.txt');
		if(txt) {
			txt.addEventListener("click", function(){
				
				makeTextArea();
				
			});
		}


		// ------ click for textfield to p tag ---------

		window.document.addEventListener("click", function(){
			var textfield = document.createElement('textarea');

			if(textfield){

				var txtareas = document.querySelectorAll('textarea');
				var getal = txtareas.length;


				for(i=0; i<getal; i++){
					console.log(i);
					var value = txtareas[i].value;

					if(value){
						console.log(value);

						//change
					}	
				}
			}
				
		});

	}

	function makeTextArea(){

		var textfield = document.createElement('textarea');
		textfield.style.position = "absolute";
		textfield.style.left = 400 + 'px';
		textfield.style.top = 200 + 'px';
		document.body.appendChild(textfield);
	} 

	init();
})();

},{"./classes/App":2}],2:[function(require,module,exports){
module.exports = (function(){

	function App() {
		console.log('[App] constructor');
	}

	return App;

})();
},{}]},{},[1]);
