//For the mean time typeahead
$(function() {
    var availableTags = [
     'Section 1',
     'Section 2',
     'All Section'
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
});

function search(val){
	console.log(val);

		$.get(
		'http://localhost/project_api/index.php/portfoliocontroller/listsubject',
		{val: val},
		function(result){
		
			$('#table-tbody').html(result);


	});
}
//For the mean time typeahead


//Handle Key Press enter
$(document).bind('keypress', function(e) {
	if(e.keyCode==13){
		$('input').blur();
	}
});
//Handle Key Press enter

function listStudents(name){
	var student_id = name;
	$.get(
	'http://localhost/project_api/index.php/portfoliocontroller/liststudents',
	{student_id: student_id},
	function(result){
	
		$('#student-table').html(result);


	});
	$( "#dialog" ).dialog( "open" );
}

 $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      height: 300,
      width: 450,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
  });