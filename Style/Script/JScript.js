$( "#btn" ).click(function() {
				var v = $("#var").val();
				alert("JS in - var: " + v );
			});

$('#var').each(function () {
	$(this).keypress(function() {
		$('#var_error').fadeOut("slow");
		$('#div_warnings').fadeOut("slow");
	});
});
$('#cont').each(function () {
	$(this).keypress(function() {
		$('#cont_error').fadeOut("slow");
		$('#div_warnings').fadeOut("slow");
	});
});
			
			
$('#submit').click(function (e) {
	$('#var_error').hide();
	$('#cont_error').hide();
	$('#div_warnings').hide();
	$('#div_required').hide();
	$('#div_alerts').hide();
	var isValid = true;
	var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	
	$('#var').each(function () {
		if ($.trim($(this).val()) == '') {
			isValid = false;
			$('#var_error').html(" *").css({
				"color": "red"
			}).show();
			$('#div_warnings').show();
			$('#div_required').show();
		}else if(!numericReg.test($.trim($(this).val()))) {
		isValid = false;
		$('#var_error').html(" *").css({
				"color": "red"
			}).show();
		$('#div_warnings').show();
		$('#div_alerts').show();
		}		
	});
	
	$('#cont').each(function () {
		if ($.trim($(this).val()) == '') {
			isValid = false;
			$('#cont_error').html(" *").css({
				"color": "red"
			}).show();
			$('#div_warnings').show();			
			$('#div_required').show();
			
		}else if(!numericReg.test($.trim($(this).val()))) {
		isValid = false;
		$('#cont_error').html(" *").css({
				"color": "red"
			}).show();
		$('#div_warnings').show();
		$('#div_alerts').show();
		}
	});
	if (isValid == false)
		e.preventDefault();

});