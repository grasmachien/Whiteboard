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