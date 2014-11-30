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
