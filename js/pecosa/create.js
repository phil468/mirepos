$(function(){
	$('#pedido_id').on('change', onSelectPedidoChange);

});

function onSelectPedidoChange()
{
	var id_pedido = $(this).val();
	
	onSelectPedido(id_pedido);
}

function onSelectPedido(v_select)
{
	var id_pedido = v_select;
	console.log(id_pedido);
	if(!id_pedido)
	{
		$('#producto_id').html('<option value ="">Seleccione el Producto Solicitado </option>');
		return;
	}

	//AJAX
	$.get('../../api/pedido/'+id_pedido+'/pecosa', function(data){
		var html_select = '<option value ="">Seleccione el Producto Solicitado </option>';
		
		for(var i=0; i<data.length; ++i)
		{
			html_select  += '<option value ="'+data[i].id+'">'+data[i].codigo+' - '+data[i].descripcion+'</option>';
		}
		console.log(html_select);
		$('#producto_id').html(html_select);
		
	});
}
