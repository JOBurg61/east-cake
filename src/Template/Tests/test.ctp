<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
This is a test of bigint insertion

<script>
	var r = {};
	r.id = 1475881942413;
	r.description = "This better be a big damn int.";
	
	$.post( "/east/tests/add", r, function(data){console.log(data)} ,'json');

</script>
