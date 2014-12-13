(function(){

	var Ajax = require('./classes/Ajax');
	
	
	function init() {
		new Ajax();


		var btn = document.querySelector('.txt');
		var btnvid = document.querySelector('.video');
		var btnimg = document.querySelector('.image');
		var btnprs = document.querySelector('.perstoev');

		if(btn) {
			btn.addEventListener("click", function(){
				console.log('click');

				var uploadblock = document.getElementById('pop'); 
				var form = document.getElementById('uploadwrap'); 
				form.classList.add("animform");

				uploadblock.classList.remove("hidden");
				uploadblock.classList.add("uploadblock");

				var txtupload = document.querySelector('#tekstupload');
				txtupload.classList.remove("hideform");

				
			});
		}

		if(btnvid) {
			btnvid.addEventListener("click", function(){
				console.log('click');

				var uploadblock = document.getElementById('pop'); 
				var form = document.getElementById('uploadwrap'); 
				form.classList.add("animform");

				uploadblock.classList.remove("hidden");
				uploadblock.classList.add("uploadblock");

				var videoupload = document.querySelector('#videoupload');
				videoupload.classList.remove("hideform");		
				
			});
		}

		if(btnimg) {
			btnimg.addEventListener("click", function(){
				console.log('click');

				var uploadblock = document.getElementById('pop'); 
				var form = document.getElementById('uploadwrap'); 
				form.classList.add("animform");

				uploadblock.classList.remove("hidden");
				uploadblock.classList.add("uploadblock");

				var imageupload = document.querySelector('#imageupload');
				imageupload.classList.remove("hideform");		
				
			});
		}

		if(btnprs) {
			btnprs.addEventListener("click", function(){
				console.log('click');

				var uploadblock = document.getElementById('pop'); 
				var form = document.getElementById('uploadwrap'); 
				form.classList.add("animform");

				uploadblock.classList.remove("hidden");
				uploadblock.classList.add("uploadblock");

				var persoonupload = document.querySelector('#persoonupload');
				persoonupload.classList.remove("hideform");		
				
			});
		}

		var close = document.querySelector('.close');
		if(close) {
			close.addEventListener("click", function(){
				console.log('close');

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



			});
		}

		var label = document.querySelector('#name');
		var txtform = document.querySelector(".name");
		
		if(label) {
			label.addEventListener("click", function(){

				label.classList.add("labelanim");
				txtform.focus();

				
			});
		}

		var btnsubmit = document.querySelector('#btnsubmit');
		if(btnsubmit) {
			btnsubmit.addEventListener("click", function(){

				if(document.querySelector(".name").value === ""){
				    
					var nameinput = document.querySelector('.name');
					nameinput.classList.add("error");
				
					window.setTimeout(function() {
 		 	 			nameinput.classList.remove("error");
					}, 500);

				}

				if(document.querySelector(".addvideo").value === ""){
				    
					var fileinput = document.querySelector('.addvideo');
					fileinput.classList.add("error");
				
					window.setTimeout(function() {
 		 	 			fileinput.classList.remove("error");
					}, 500);

				}
				
			});
		}

	}

	

	init();
})();
