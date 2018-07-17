@extends('layouts.master')
@section('page-title')
Balance Sheet
@endsection
@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<center>
							<p id="date_filter">
								<span id="date-label-from" class="date-label">From:</span><input class="date_range_filter date" type="text" id="datepicker_from" />
								&ensp;&ensp;&ensp;<span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
							</p>
						</center>	
						<table class="table table-striped table-bordered" id="balance-table" >
							<thead style="background-color:#ffffff;">
								<tr>
									<th>#</th>
									<th>Particulars</th>
									<th>Purpose</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Debit</th>
									<th>Credit</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th colspan="3" style="text-align:left">Total:</th>
									<th></th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

</div>
<!-- END CONTAINER -->
@endsection

@push('footer')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>


<script type="text/javascript">
	$(function(){

		var table = $('#balance-table').DataTable({
			select: true,
			processing: true,
			//serverSide: true,
			ajax: '{!! route('balance.data') !!}',
			columns: [
			{},
			{data: 'bs_particular', name: 'bs_particular'},
			{data: 'bs_purpose', name: 'bs_purpose'},
			{},
			{},
			{data: 'bs_debit', name: 'bs_debit', visible:false},
			{data: 'bs_credit', name: 'bs_credit', visible:false},
			],
			columnDefs: [{
				'targets': 0,
				'searchable': true,
				'orderable': false,
				'render': function (data, type, full, meta){
					return full.bs_created_at.split(' ')[0];
					// var date = new Date(full.bs_created_at.split(' ')[0]);
					// var c =  date.getDate() + "-"+date.getMonth()+"-" + date.getFullYear();
					// return c;
				}
			},{
				'targets': 3,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					return (full.bs_debit == 0) ? '-' : full.bs_debit;
				}
			},{
				'targets': 4,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					return (full.bs_credit == 0) ? '-' : full.bs_credit;
				}
			}],
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(),data,api2 = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
            	return typeof i === 'string' ?
            	i.replace(/[\-,]/g, '')*1 :
            	typeof i === 'number' ?
            	i : 0;
            };

            // Total over all pages
            total = api.column(5).data().reduce(function (a, b){
            	return intVal(a) + intVal(b);
            },0);



            // Total over this page
            pageTotal = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $(api.column(3).footer()).html('Total: ( ₹'+ total +')');
            // Total over all pages
            total2 = api2.column(6).data().reduce(function (a, b){
            	return intVal(a) + intVal(b);
            },0);

            // Total over this page
            pageTotal2 = api2.column( 6, { page: 'current'} ).data().reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $(api2.column(4).footer()).html('Total: ( ₹'+ total2 +' )');

						// remaining total
						total3 = total2 - total;
						$(api.column(2).footer()).html('Final balance: ( ₹'+ total3 +' )');


        },
			dom: 'Bfrtip',
			buttons: [
			{
				text: 'Print',
				extend: 'pdfHtml5',
				message: '',
				orientation: 'portrait',
				exportOptions: {
					columns: ':visible'
				},
				title : 'VIDYA BHUSHAN ACADEMY - Balance Sheet',
				customize: function (doc) {

					doc.defaultStyle.fontSize = 12;
					doc.styles.tableHeader.fontSize = 14;
					doc.styles.title.fontSize = 14;

			        // // Remove spaces around page title
			        doc.content[1].table.widths = [ '*', '*', '*','*','*'];
			        // doc.content[1].table.body  = {alignment:'center'};
			        // doc.content[1].table.alignment = [ 'center', 'center', 'center','center','center' ];
			        // doc.styles.table['body'].alignment = 'center';

			        doc.content[0].text = doc.content[0].text.trim();

			        // Styling the table: create style object

			    }
			}
			]

    });

	});

 
$(document).ready(function() {
    var otable = $('#balance-table').DataTable();
     

          $("#datepicker_from").datepicker({
		    showOn: "button",
		    autoclose: true,
		    yearRange: "-40:+10",
            changeYear: true,
            changeMonth: true,

		    // buttonImage: "images/calendar.gif",
		    buttonImageOnly: false,
		    "onSelect": function(date) {
		      minDateFilter = new Date(date).getTime();
		      otable.draw();
		    }
		  }).change(function() {
		    minDateFilter = new Date(this.value).getTime();
		    otable.draw();
		  });

		   $("#datepicker_to").datepicker({
		    showOn: "button",
		    autoclose: true,
		    yearRange: "-40:+10",
            changeYear: true,
            changeMonth: true,

		    // buttonImage: "images/calendar.gif",
		    buttonImageOnly: false,
		    "onSelect": function(date) {
			maxDateFilter = new Date(date).getTime();
		      otable.draw();
		    }
		  }).change(function() {
			var day = 60 * 60 * 24 * 1000;
		    maxDateFilter = new Date(new Date(this.value).getTime()+day);
		    otable.draw();
		  });


} );

// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, data, iDataIndex) {
    if (typeof data._date == 'undefined') {
      // data._date = new Date(data[1]).getTime();
      a = data[0];
	  data._date = new Date(a).getTime();
    //   console.log(data._date);
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (data._date < minDateFilter) {
        return false;
        console.log(data._date);
      }
    }

	if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (data._date > maxDateFilter) {
        return false;
      }
    }


    return true;
    // console.log(data._date);
   

  }
);



</script>
@endpush
