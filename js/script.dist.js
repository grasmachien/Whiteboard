(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
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

		// var btnsubmit = document.querySelector('#btnsubmit');
		// if(btnsubmit) {
		// 	btnsubmit.addEventListener("click", function(){

		// 		if(document.querySelector(".name").value === ""){
				    
		// 			var nameinput = document.querySelector('.name');
		// 			nameinput.classList.add("error");
				
		// 			window.setTimeout(function() {
 	// 	 	 			nameinput.classList.remove("error");
		// 			}, 500);
		// 		}

		// 		if(document.querySelector(".addvideo").value === ""){
				    
		// 			var fileinput = document.querySelector('.addvideo');
		// 			fileinput.classList.add("error");
				
		// 			window.setTimeout(function() {
 	// 	 	 			fileinput.classList.remove("error");
		// 			}, 500);

		// 		}
				
		// 	});
		// }

	}

	

	init();
})();

},{"./classes/Ajax":2}],2:[function(require,module,exports){
module.exports = (function(){

	var DragDrop = require('../classes/DragDrop');
	var url = getUrlVars()["name"];
	var postitbtn = document.querySelector('.postitbtn');
	var videobtn = document.querySelector('.videobtn');
	var imgbtn = document.querySelector('.imgbtn');

	function Ajax() {


		if(getUrlVars()["page"] === "board"){
			boardJSONGet();
		}

		//AJAX POSTIT

		if(postitbtn){
			postitbtn.addEventListener('click', function(){
				event.preventDefault();

				var postitinput = document.querySelector('.txtarea').value;
				var projectnaamhash = getUrlVars()["name"];
				projectnaam = projectnaamhash.substring(0, projectnaamhash.length - 1);

				$.post( "index.php?page=postpostit", { 
					tekst: postitinput,
					project: projectnaam
				})
				.done(function( data ) {
			    console.log(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    document.querySelector('.txtarea').value = " ";
			    closeWindow();
			    boardJSONGet();

			  });

			});
		}

		//AJAX IMAGE

		$('#imageupload').submit(function(event){
			event.preventDefault();

			$.ajax({
			  url: 'index.php?page=uploadimg',
			  type: 'POST',
			  data: new FormData(this),
			  processData: false,
			  contentType: false,
			  cache: false,
			  success: function(data){
			    // alert(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    closeWindow();
			    boardJSONGet();
			  }
			});	

		});

		//AJAX VIDEO

		$('#videoupload').submit(function(event){
			event.preventDefault();

			$.ajax({
			  url: 'index.php?page=uploadvideo',
			  type: 'POST',
			  data: new FormData(this),
			  processData: false,
			  contentType: false,
			  cache: false,
			  success: function(data){
			    // alert(data);

			    $('.postit-list').empty();
			    $('.users-list').empty();
			    $('.video-list').empty();
			    $('.img-list').empty();

			    closeWindow();
			    boardJSONGet();
			  }
			});	

		});


		var searchform = document.getElementById("searchForm");

		if (searchform) {
			searchResult();
		}

	}

	function searchResult(){

	var searchForm = document.getElementById('searchForm');
		if(searchForm) {

			var searchInput = searchForm.querySelector('input[type=search]');

			searchForm.addEventListener('submit', doSearch);
			searchInput.addEventListener('input', doSearch);
			
			function doSearch(event) {
				event.preventDefault();
				var req = new XMLHttpRequest();
				req.onload = function() {
					
					var result = document.createElement('div');
					result.innerHTML = req.responseText;

					var updatedResultDiv = result.querySelector('.projecten-overzicht');
					// if (!updatedResultDiv.querySelectorAll(".project-th")) {};
					var resultDiv = document.querySelector(".projecten-overzicht");
					otherprojects = updatedResultDiv.querySelectorAll(".project-th");
					resultDiv.parentNode.replaceChild(updatedResultDiv, resultDiv);	
					
			
					
				}
				req.open('get', searchForm.getAttribute('action') + '&q=' + searchInput.value, true);
				req.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
				req.send();
			}
		}



	}

		function boardJSONGet() {

			$.get( "index.php?page=invites&name="+ url, function( posts ) {

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

			new DragDrop();


			});
		}

		function getUrlVars() {
		    var vars = {};
		    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		        vars[key] = value;
		    });
		    return vars;
		}

		function closeWindow(){

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

		}

	return Ajax;

})();
},{"../classes/DragDrop":3}],3:[function(require,module,exports){
module.exports = (function(){
	var hoogte = 0;
	function Dragdrop() {
		var elements = document.querySelectorAll(".dragdrop");
		var deletes = document.querySelectorAll(".deletebtn");

		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element = new DraggableBlock(element);
		}

		for (var j = 0; j < deletes.length; j++) {
			var deletebtn = deletes[j];
			deletebtn = new Deletepost(deletebtn);
		}

	}

	function DraggableBlock(element){

		this.el = element;
		this.el.addEventListener('mousedown', this.mouseDownHandler.bind(this));

	}

	function Deletepost(deletebtn){

		this.del = deletebtn;
		this.del.addEventListener('click', this.clickDeleteHandler.bind(this));	

	}

	Deletepost.prototype.clickDeleteHandler = function(event) {

		$.post( "index.php?page=deletepostit", { 
			id: this.del.dataset.id,
			tabel: this.del.dataset.tabel
		})
		.done(function( data ) {
	    console.log(data);

	    });

	    var postit = this.del.parentNode;
	    console.log(postit);

	    $(postit).remove();
	};

	DraggableBlock.prototype.mouseDownHandler = function(event) {
		event.preventDefault();
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;
		this.el.style.zIndex = hoogte;
    hoogte ++;
		this._mousemoveHandler = this.mousemoveHandler.bind(this);
		this._mouseupHandler = this.mouseupHandler.bind(this);
		window.addEventListener('mousemove', this._mousemoveHandler);
		window.addEventListener('mouseup', this._mouseupHandler);
		
    
	};

	DraggableBlock.prototype.mousemoveHandler = function(event) {
        this.el.style.left = (event.pageX - this.offsetX) + "px";
        this.el.style.top = (event.pageY - this.offsetY) + "px";

	};

	DraggableBlock.prototype.mouseupHandler = function(event) {
		window.removeEventListener('mousemove', this._mousemoveHandler);
    window.removeEventListener('mouseup', this._mouseupHandler);
    $.post( "index.php?page=postxy", { 
    	
			x: this.el.offsetLeft,
			y: this.el.offsetTop,
			id: this.el.dataset.id,
			tabel: this.el.dataset.tabel
		})
		.done(function( data ) {

	  }
	  
	)};


	return Dragdrop;

})();




},{}]},{},[1]);
