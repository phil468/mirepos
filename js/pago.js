
$(function(){
	$('#sales_id').on('change', onSelectDetalleChange);
});

function onSelectDetalleChange()
{
	var id_detalle = $(this).val();
	onSelectDetalle(id_detalle);
	
}

function onSelectDetalle(v_select)
{
	var id_detalle = v_select;
	
	//console.log(id_detalle);
	
	
	if(!id_detalle)
	{
		
		$('#total_amount').hmtl('<input type="number" disabled name="total_amount" id="total_amount" class="form-control" placeholder="Saldo...">');
		$('#amount_paid').hmtl('<input type="number" disabled name="amount_paid" id="amount_paid" class="form-control" placeholder="Saldo...">');
		return;
	}

	//AJAX
	$.get('../api/payment/'+id_detalle+'/sales', function(data){
		console.log(data);
		var v_total_amount = 0;
		var v_amount_paid = 0;
		for(var i=0; i<data.length; i++)
		{
			v_total_amount = data[i].total_amount;
			v_amount_paid = data[i].amount_paid;
		}
		
		$('#total_amount').val(v_total_amount);
		$('#amount_paid').val(v_amount_paid);
	});
}