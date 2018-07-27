$('#schoolName').on({
	'keyup' : function(){
		$.ajax({
			url : find,
			type : 'post',
			data : {'find' : this.value},
			success : function(e){
				var op = [];
				$.each(e, function(k,v){
					op.push('<li onclick = "setValue('+v.school_id+', \''+v.school_name+'\');">'+v.school_name+'</li>');
				});
				// op.push('<li onclick="addNew();">Other</li>');
				$('#schoolBox').show();
				$('#schoolBox ul').html(op);
			}
		});
	},	
});
// $('#schoolName, #schoolBox').on({
// 	'blur' : function(){
// 		$('#schoolBox').hide();
// 	}
// })
function setValue(i,v){
	$('#schoolBox').hide();
	$('#schoolName').val(v);
	$('#school-name').val(i);
}

function addNew(){
	$('#schoolBox').hide();	
	$('#addSchool').show();
}

$('#newSchool').on({
	'click' : function(e){
		e.preventDefault();
		$.ajax({
			url : schoolUrl,
			type : 'post',
			data : {'name' : $('#school_name').val(),'fetch' : 'yes'},
			success : function(e){				
				setValue(e.school_id,e.school_name);
				$('#addSchool').hide();
			}
		});		
	}
})