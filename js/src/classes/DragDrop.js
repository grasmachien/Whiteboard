module.exports = (function(){
	var hoogte = 0;
	function Dragdrop() {
		var elements = document.querySelectorAll(".dragdrop");

		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element = new DraggableBlock(element);
		}
	}

	function DraggableBlock($el){

		this.el = $el;
		
		if (this.el.addEventListener('mousedown', this.mouseDownHandler.bind(this))) {

			window.addEventListener('mousemove', this._mousemoveHandler);
		window.addEventListener('mousemove', this._mousemoveHandler);	
		}	
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