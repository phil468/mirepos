$(function(){
	$('#producto_id').on('change', onSelectProductoChange);
});

function onSelectProductoChange()
{
	var id_producto = $(this).val();
	console.log(id_producto);
	if(!id_producto)
	{
		$('#um').html('<input type="text" disabled name="um" id="um" class="form-control">');
		
		return;
	}

	//AJAX
	$.get('../../api/producto/'+id_producto+'/pedido', function(data){
		var html_select = " ";
		for(var i=0; i<data.length; i++)
		{
			html_select = data[i].UM;
		}
		console.log(html_select);
		$('#um').val(html_select);
		
	});
}

