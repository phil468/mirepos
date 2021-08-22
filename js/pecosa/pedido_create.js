$(function(){
	$('#producto_id').on('change', onSelectProductoChange);
});

function onSelectProductoChange()
{
	var id_producto = $(this).val();
	pedido_id=$("#pedido_id").val(); 
	console.log(id_producto);
	if(!id_producto)
	{
		$('#um').html('<input type="text" disabled name="um" id="um" class="form-control">');
		
		return;
	}

	//AJAX
	$.get('../../api/producto/'+id_producto+'/'+pedido_id+'/pecosa', function(data){
		
		var html_select = 0;
		var html_select1 = 0;
		var html_select2 = 0;
		var html_select3 = 0;

		for(var i=0; i<data.length; i++)
		{
			html_select = data[i].um;
			html_select1 = data[i].pre_unit;
			html_select2 = data[i].cantidad;
			html_select3 = data[i].stock;
		}
		console.log(html_select);
		$('#um').val(html_select);
		$('#um1').val(html_select);
		$('#pre_unit').val(html_select1);
		$('#cantidad').val(html_select2);
		$('#stock').val(html_select3);		
	});
}