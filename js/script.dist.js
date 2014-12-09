(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function(){

	var Dragdrop = require('./classes/Dragdrop');
	var Ajax = require('./classes/Ajax');
	function init() {
		new Dragdrop();
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

},{"./classes/Ajax":2,"./classes/Dragdrop":3}],2:[function(require,module,exports){
module.exports = (function(){

	function Ajax() {

		//image op schermkrijgen met ajax
		// $('#imageupload').submit(function(event) {
		// 	event.preventDefault();
		// 		$.ajax({
		// 			type:"POST",
		// 			url:"index.php?page=dboard&name=" + document.URL.split("name=")[1], 
		// 			data: "image=" + $('#addImageImage').val() + "&action=" + "upload image",
		// 			success:function(response){ 
		// 				var imagesplit = response.split("<br />")[1];
		// 				var imagespliter = imagesplit.split("<script")[0];
						
		//     			$(".whiteboard").html(imagespliter);
		//     			new App(document.querySelector('.whiteboard'));
		//     		}
		// 		}); 
		// });

	}

	return Ajax;

})();
},{}],3:[function(require,module,exports){
module.exports = (function(){
	var hoogte = 0;
	function Dragdrop() {
		console.log($("body"));
		var elements = document.querySelectorAll(".dragdrop");
		console.log(elements);
		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element = new DraggableBlock(element);
		}
	}

	function DraggableBlock(element){

		this.el = element;
		// console.log($el);
		this.el.addEventListener('mousedown', this.mouseDownHandler.bind(this));


	}

	DraggableBlock.prototype.mouseDownHandler = function(event) {
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;
		
		this._mousemoveHandler = this.mousemoveHandler.bind(this);
		this._mouseupHandler = this.mouseupHandler.bind(this);
		this.el.addEventListener('mousemove', this._mousemoveHandler);
		this.el.addEventListener('mouseup', this._mouseupHandler);
		
    
	};

	DraggableBlock.prototype.mousemoveHandler = function(event) {
		    // this.el.style.zIndex = hoogte;
    		this.el.style.zIndex = hoogte;
    		hoogte ++;
    		console.log(event.x - this.offsetX*2);
        this.el.style.left = (event.x - this.offsetX*2) + "px";
        this.el.style.top = (event.y - this.offsetY*2) + "px";

	};

	DraggableBlock.prototype.mouseupHandler = function(event) {
		console.log(this.el);
		this.el.removeEventListener('mousemove', this._mousemoveHandler);
    this.el.removeEventListener('mouseup', this._mouseupHandler);
	};

	return Dragdrop;

})();
},{}]},{},[1]);
