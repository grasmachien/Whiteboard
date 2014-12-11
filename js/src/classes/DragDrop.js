module.exports = (function(){
	var hoogte = 0;
	function Dragdrop() {
		var elements = document.querySelectorAll(".dragdrop");

		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element = new DraggableBlock(element);
		}

	}

	function DraggableBlock(element){

		this.el = element;
		console.log(this.el);
		this.el.addEventListener('mousedown', this.mouseDownHandler.bind(this));

	}

	DraggableBlock.prototype.mouseDownHandler = function(event) {
		event.preventDefault();
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;
		console.log(this);
		this._mousemoveHandler = this.mousemoveHandler.bind(this);
		this._mouseupHandler = this.mouseupHandler.bind(this);
		window.addEventListener('mousemove', this._mousemoveHandler);
		window.addEventListener('mouseup', this._mouseupHandler);
		
    
	};

	DraggableBlock.prototype.mousemoveHandler = function(event) {
		    // this.el.style.zIndex = hoogte;
    		this.el.style.zIndex = hoogte;
    		hoogte ++;
        this.el.style.left = (event.pageX - this.offsetX) + "px";
        this.el.style.top = (event.pageY - this.offsetY) + "px";

	};

	DraggableBlock.prototype.mouseupHandler = function(event) {
		// console.log(this.el);
		window.removeEventListener('mousemove', this._mousemoveHandler);
    window.removeEventListener('mouseup', this._mouseupHandler);
	};

	return Dragdrop;

})();