<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - FOR FORM VALIDATION -->
<script src="{{ asset('public/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/assets/js/form-validation.js') }}" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END FOR FORM VALIDATION -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<script src="{{ asset('public/assets/plugins/autosize/autosize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


<!-- FOR DATEPICKER - START -->
<script src="{{ asset('public/assets/plugins/jquery-ui/smoothness/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/datepicker/js/datepicker.js') }}" type="text/javascript"></script>
<!-- FOR DATEPICKER - END -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START DATATABLE -->
<script src="{{ asset('public/assets/plugins/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END DATATABLE -->


<!-- CORE TEMPLATE JS - START -->
<script src="{{ asset('public/assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->


<!-- General section box modal start -->
<div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog animated bounceInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Section Settings</h4>
            </div>
            <div class="modal-body">

                Body goes here...

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<script type="text/javascript" src="{{ asset('public/js/common.min.js') }}"></script>
@stack('footer')
</body>
<!-- Mirrored from jaybabani.com/crest-admin/demo/app/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2017 16:41:02 GMT -->
</html>