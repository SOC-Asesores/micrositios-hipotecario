$(document).ready(function() {
   $(".close").click(function(e){
   	e.preventDefault();
   	$(".registro-section").addClass('hide');
   });
   $(".button-help").click(function(e){
	e.preventDefault();
	e.stopPropagation();
	$(".modal-contact").toggleClass('show-help');
   });
   $(".modal-contact").click(function(e){
	e.stopPropagation();
   });
   $("body").click(function(e){
	$(".modal-contact").removeClass('show-help');
   });

   $("#showAll_1").click(function(e){
   	e.preventDefault();
   	$("#show_row_1").toggleClass("all");
   });

   $("#showAll_2").click(function(e){
   	e.preventDefault();
   	$("#show_row_2").toggleClass("all");
   });

   $("#files").change(function(e){
   	$("#file_label").html("Archivos cargados...");
   });

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function formatDate(date) {
	     var d = new Date(date),
	         month = '' + (d.getMonth() + 1),
	         day = '' + d.getDate(),
	         year = d.getFullYear();

	     if (month.length < 2) month = '0' + month;
	     if (day.length < 2) day = '0' + day;

	     return [year, month, day].join('-');
	 }

	 $(".copy").click(function(e) {
	    e.preventDefault();
	    navigator.clipboard.writeText(e.target.getAttribute('href')).then(() => {
      
	    }, () => {
	      
	    });
	});

	
   $('.download').click(function(e) {
	    e.preventDefault();
	    var files = $(this).attr('files');
	    var base = $(this).attr('base');
	    var files_array = files.split(',');
	    $.each(files_array, function(index, val) {
	    	 window.open(base+val);
	    });
	});
   var url = window.location.href;
   var url_split = url.split('carpeta')[1];
   if(typeof(url_split) != "undefined" && url_split !== null) {
	    $(".registro-section").removeClass('hide');
	}else{
		console.log("Es nulo");
	}
});