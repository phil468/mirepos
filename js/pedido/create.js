$(function(){
	$('#sede_id').on('change', onSelectSedeChange);
	//alert("Script Agregado");
});

function onSelectSedeChange()
{
	var id_sede = $(this).val();
	
	if(!id_sede)
	{
		$('#oojj_id').html('<option value ="">Seleccione Órgano Jurisdiccional </option>');
		return;
	}

	//AJAX
	$.get('api/oojj/'+id_sede+'/pedido', function(data){
		var html_select = '<option value ="">Seleccione Órgano Jurisdiccional </option>';
		
		for(var i=0; i<data.length; ++i)
		{
			html_select  += '<option value ="'+data[i].id+'">'+data[i].nombre+'</option>';
		}
		
		$('#oojj_id').html(html_select);
		
	});
}