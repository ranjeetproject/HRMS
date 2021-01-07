</div>
<!-- cPwd  Modal -->
<div id="changePassword" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">
                    Change Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="kt-form" id="changePasswordForm" method="post">
                    @csrf
                    <p class="text-danger" id="errorMesasage"></p>
                    <p class="text-success" id="successMesasage"></p>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Enter old Password <span
                                        style="color:#ed0f12;">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" value=""
                                           placeholder="Enter Old Password"
                                           id="old_password" name="old_password">
                                    <span id="error_old_password" style="color:#ed0f12;padding:10px;"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Enter new Password <span
                                        style="color:#ed0f12;">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" value=""
                                           placeholder="Enter New Password"
                                           id="new_password" name="new_password">
                                    <span id="error_new_password" style="color:#ed0f12;padding:10px;"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Enter confirm Password <span
                                        style="color:#ed0f12;">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" value=""
                                           placeholder="Enter Confirm Password"
                                           id="confirm_password" name="confirm_password">
                                    <span id="error_confirm_password" style="color:#ed0f12;padding:10px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-bold btn-upper btn-font-sm" data-dismiss="modal">Close
                </button>
                <button type="button" class="btn btn-primary btn-bold btn-upper btn-font-sm" id="changePasswordSubmit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
{{--<script src="{{asset('js/daterangepicker.js')}}"></script>--}}
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/tempusdominus-bootstrap-4.min.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
{{--<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>--}}
{{--<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/js/fileinput.js"></script>
<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#changePasswordSubmit").click(function () {
        if ($("#old_password").val().length === 0) {
            $("#error_old_password").html('Please enter your old password');
            $("#old_password").focus();
            return false;
        } else {
            $("#error_old_password").html('');
        }

        if ($("#new_password").val().length === 0) {
            $("#error_new_password").html('Please enter your password');
            $("#new_password").focus();
            return false;
        } else {
            $("#error_new_password").html('');
        }

        if ($("#confirm_password").val().length === 0 || ($("#confirm_password").val() != $("#new_password").val())) {
            $("#error_confirm_password").html('Please enter your confirm password same as password');
            $("#confirm_password").focus();
            return false;
        } else {
            $("#error_confirm_password").html('');
        }
        var baseUrl = '';
        $.ajax({
            type: 'post',
            url: baseUrl,
            data: $('#changePasswordForm').serialize(),
            success: function (data) {
                if (data.success == false) {
                    $("#error_old_password").html(data.message);
                } else {
                    $("#successMesasage").html(data.message);
                    $('#changePasswordForm').trigger("reset");
                    setTimeout(function () {
                        $("#changePassword").modal("hide");
                        $("#successMesasage").html('');
                    }, 2000);
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    if (value.old_password && value.old_password.length > 0) {
                        $("#error_old_password").html(value.old_password[0]);
                    }
                    if (value.new_password && value.new_password.length > 0) {
                        $("#error_new_password").html(value.new_password[0]);
                    }
                    if (value.confirm_password && value.confirm_password.length > 0) {
                        $("#error_confirm_password").html(value.confirm_password[0]);
                    }
                });
            }
        });
    });
</script>
@yield('customJsInclude')
</body>
</html>
