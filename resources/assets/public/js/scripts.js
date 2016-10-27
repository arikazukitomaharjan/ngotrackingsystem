$(document).ready(function(){

$('#row-view-select').change(function(){
	var url = $(this).val();
	window.location.assign(url);
});

var curUrl = $(document).href;
alert(curUrl);

});

