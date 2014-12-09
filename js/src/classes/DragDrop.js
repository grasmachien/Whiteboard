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
    		console.log(event.x - this.offsetX*2);s
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