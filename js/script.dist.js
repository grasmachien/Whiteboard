(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function(){

	var Dragdrop = require('./classes/Dragdrop');
	function init() {
		new Dragdrop();

		var btn = document.querySelector('.txt');
		var btnvid = document.querySelector('.video');
		var btnimg = document.querySelector('.image');

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

					txtupload.classList.add("hideform");

					videoupload.classList.add("hideform");

					imageupload.classList.add("hideform");



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

},{"./classes/Dragdrop":2}],2:[function(require,module,exports){
module.exports = (function(){
	var hoogte = 0;
	function Dragdrop() {
		var elements = document.querySelectorAll(".dragdrop");

		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element = new DraggableBlock(element);
		};

	}

	function DraggableBlock($el){

		this.el = $el;
		
		if (this.el.addEventListener('mousedown', this.mouseDownHandler.bind(this))) {

			window.addEventListener('mousemove', this._mousemoveHandler);
		window.addEventListener('mousemove', this._mousemoveHandler);	
		};

		
	}


	DraggableBlock.prototype.mouseDownHandler = function(event) {
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;

		this._mousemoveHandler = this.mousemoveHandler.bind(this);
		this._mouseupHandler = this.mouseupHandler;
		window.addEventListener('mousemove', this._mousemoveHandler);
		window.addEventListener('mouseup', this._mouseupHandler);
		
    
	};

	DraggableBlock.prototype.mousemoveHandler = function(event) {
			// console.log(this.el);
		    // this.el.style.zIndex = hoogte;
    		this.el.style.zIndex = hoogte;
    		hoogte ++;
        this.el.style.left = (event.x - (this.offsetX*2)) + "px";
        this.el.style.top = (event.y - this.offsetY) + "px";

	};

	DraggableBlock.prototype.mouseupHandler = function(event) {
		console.log("mouseup");
		window.removeEventListener('mousemove', this.mousemoveHandler);
    window.removeEventListener('mouseup', this.mouseupHandler);
	};

	return Dragdrop;

})();
},{}]},{},[1]);
