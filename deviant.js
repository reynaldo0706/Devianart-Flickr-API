$(document).ready(function(){
  var s = $("#s");
  var wrap = $("#content");
  var delay = 1500;
  var keycode;
  var timer;
  
  $(s).keydown(function(e){
  	// clear old page content and reset timer
    $(wrap).empty();  	
  	clearTimeout(timer);
  });
	
	$(s).keyup(function(){
	  $("#loader").css("display", "block");
  	timer = setTimeout(deviantSearch, delay); // end timeout() function  
  }); // end keyup() event function
  
  function deviantSearch() {
    $.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  data: "q="+$(s).val(),
		  success: function(data){
		  	// hide the loader and blur focus away from input
		  	$("#loader").css("display", "none");
		  	$(s).blur();
		  	
			  var code = "<span class=\"results\">Total Results: "+data['total']+"</span>";
			
			  $.each(data, function(i, item) {
			    if(typeof(data[i].title) !== 'undefined') { // check if data is undefined before setting more variables
				    code = code + '<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="'+data[i].full+'">   <img class="img-responsive" src="'+data[i].thumb+'" alt=""></a></div>';	
			    } 
			  });
			  $(wrap).html(code);
		  },
		  error: function(xhr, type, exception) { 
		    $("#loader").css("display", "none");
			  $(wrap).html("Error: " + type); 
		  }
	  }); // end ajax call  
  }
}); // end ready() function
