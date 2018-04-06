$(function(){

    getMonthlyInvoice(1);

});

function getMonthlyInvoice(month){
    $.post("php/getMonthlyInvoices.php", {month: month}, function(result)
    {
        $('#monthlyInvoice').html(result);
        
        $('#tableInvoices').DataTable({
            responsive: true,
            fixedHeader: true,
            "columns": [
                {"data":"date",           className:"all" },
                {"data":"invoiceCount",   className:"all" },
                {"data":"totalSale",      className:"desktop" },
                {"data":"totalShipping",  className:"desktop" },
                {"data":"totalTax",       className:"desktop" },
                {"data":"totalInvoice",   className:"tablet-p tablet-l desktop" },
                {"data":"totalCost",      className:"tablet-p tablet-l desktop" },
                {"data":"totalGross",     className:"tablet-p tablet-l desktop" },
            ],
            dom: '<lf<t>ipB>',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
        
        //declare variables
        var totalInvoice = 0.00;
        var totalCost = 0.00;
        var totalGross = 0.00;
    
        //loop through the table and sum up totals.
    	$('#tableInvoices tbody tr').each(function(){
    		totalInvoice += parseFloat($('#' + $(this).attr('id') + ' .totalInvoice').html());
    		totalCost += parseFloat($('#' + $(this).attr('id') + ' .totalCost').html());
    		totalGross += parseFloat($('#' + $(this).attr('id') + ' .totalGross').html());
    	});
    
    	//set "sum" variables to the assigned Total column.
    	$('.summaryContainer .totalInvoice').html('$' + Math.round(totalInvoice * 100) / 100);
    	$('.summaryContainer .totalCost').html('$' + Math.round(totalCost * 100) / 100);
    	$('.summaryContainer .totalGross').html('$' + Math.round(totalGross * 100) / 100);
    	
    	$('.container').css('position', 'initial');
    	
    });
}

function showModal(rowid){
    var date = $('#rowNum'+rowid).find('.date').html();
    $.post("php/getInvoice.php", {date: date}, function(result){
        $('#reportModal .modal-title').html('Invoice(s) for ' + date);
       	$('#modalContent').html(result);
       	$('#tableModal').DataTable({
            responsive: true,
            fixedHeader: true,
            "columns": [
                {"data":"invoiceID",      className:"all" },
                {"data":"orderID",        className:"tablet-l desktop" },
                {"data":"customerName",   className:"tablet-l desktop" },
                {"data":"sales",          className:"none" },
                {"data":"shipping",       className:"none" },
                {"data":"tax",            className:"none" },
                {"data":"totalInvoice",   className:"tablet-p tablet-l desktop" },
                {"data":"cost",           className:"tablet-p tablet-l desktop" },
                {"data":"gross",          className:"tablet-p tablet-l desktop" },
            ]
        });
       	$('#reportModal').modal('toggle');
    });
}