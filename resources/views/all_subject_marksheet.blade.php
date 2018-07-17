@extends('layouts.master')
@section('page-title')
    View Single Students complete Marksheet
@endsection

@section('content')
    <div class="col-lg-12">
        <section class="box " style="background-color:#9ddac0;">
            <br>
            <div class="content-body" style="background-color:#9ddac0;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="enquiry-table" >
                                <thead style="background-color:#fff;">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Parent</th>
                                    <th>Parent No.</th>
                                    <th>School</th>
                                    <th>Standard</th>                                    
                                    <th>ACTION</th>
                                    <th>Print</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General section box modal start -->
    <div class="modal" id="testModal" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg animated bounceInDown">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Section Settings</h4>
                </div>
                <div class="modal-body" style="background-color:#9ddac0;" >

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="mrt">
                                    <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Test1</th>
                                        <th>Test2</th>
                                        <th>Test3</th>
                                        <th>Test4</th>
                                        <th>Test5</th>
                                        <th>Test6</th>
                                        <th>Test7</th>
                                        <th>Test8</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                   


                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- END CONTAINER -->
@endsection

@push('footer')
    <script type="text/javascript">
        $(function(){
            $('#enquiry-table').DataTable({
                processing: true,
                //serverSide: true,
                searching: true,
                ajax: '{!! route('admission.data') !!}',          
                columns: [
                {data : 'stu_uid' , name : 'stu_uid'},
                {data : 'stu_name' , name : 'stu_name'},
                {data: 'stu_mobile', name: 'stu_mobile'},
                {data: 'parent_first_name', name: 'parent_first_name'},
                {data: 'parent_mobile', name: 'parent_mobile'},
                {data: 'ad_school', name: 'ad_school'},
                {data: 'std_name', name: 'std_name'},
                {},
                {},
                {
                    data: 'created_at', name: 'created_at'
                },
                
                ],
                'columnDefs': [
                {
                    'targets': 7,
                    'searchable': false,
                    'orderable': false,             
                    'render': function (data, type, full, meta){
                        return '<a href = "javascript:void(0);" class="btn btn-success" onclick="getTestData('+full.stu_id+');" onclick = "l();">Marksheet</a>';                    
                    }
                },{
                'targets': 9,
                'searchable': true,
                'orderable': false,
                'render': function (data, type, full, meta){
                    // return full.created_at.split(' ')[0];
                    var date = new Date(full.created_at.split(' ')[0]);
                    var c =  date.getDate() + "-"+date.getMonth()+"-" + date.getFullYear();
                    return c;
                }
                },{
                'targets': 4,
                'visible': false,
                "searchable": false
                },{
                'targets': 8,
                'render': function (data, type, full, meta){ 
                                                       
                    return '<a class="btn btn-warning"  href = "'+pr(full.stu_id)+'">Print</a>';
                    }
                }
                ],"order": [[ 8, "desc" ]]
            });

            
        });
        var v = '{{ url('invoice/') }}';
        function redA(id){
            return v+'/'+id+'/edit';
        }
        function pr(id){
        return "download-marksheet/"+id;

    }
        function getTestData(id){
            $.ajax({
                url : '{{ route('marksheet-get') }}',
                type : 'post',
                data : {'id' : id},
                success : function(d){
                    var val = [];
                    if(d.length > 0){

                        $.each(d, function(k,v){
                            var total = v.mark_test_1+v.mark_test_2+v.mark_test_3+v.mark_test_4+v.mark_test_5+v.mark_test_6+v.mark_test_7+v.mark_test_8;
                            val.push('<tr><td>'+v.subject.sub_name+'</td><td>'+v.mark_test_1+'</td><td>'+v.mark_test_2+'</td><td>'+v.mark_test_3+'</td><td>'+v.mark_test_4+'</td><td>'+v.mark_test_5+'</td><td>'+v.mark_test_6+'</td><td>'+v.mark_test_7+'</td><td>'+v.mark_test_8+'</td><td>'+total+'</td></tr>');
                            $("#print").removeAttr('disabled');
                        });
                    }else{
                        val.push('<tr><td colspan="10">No Marksheet Found</td></tr>');
                        $("#print").prop("disabled", true);
                    }

                    $('#testModal').modal('toggle');

                    $('#testModal tbody').html(val);
                }
            });
        }
        function l() {
            $('.loader').show();
            window.setTimeout(function(){
                $('.loader').hide();
            },2000);
        }
     $(function() {
    $('#mrt').DataTable( {
                searching: false,
                paginate:false,
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
            title : 'Vidhyabhusan ',
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
    } );
} );
    </script>
@endpush