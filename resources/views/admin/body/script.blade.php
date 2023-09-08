<!-- JAVASCRIPT -->

<script src="{{ asset('/') }}backend/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('/') }}assets/libs/node-waves/waves.min.js"></script>
<!-- apexcharts -->
<script src="{{ asset('/') }}backend/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('/') }}backend/assets/js/pages/dashboard.init.js"></script>

<!-- Required datatable js -->
<script src="{{ asset('/') }}backend/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<!-- Buttons examples -->
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
</script>
<script src="{{ asset('/') }}backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>

<!-- Datatable init js -->
<script src="{{ asset('/') }}backend/assets/js/pages/datatables.init.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/select2/js/select2.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{ asset('/') }}backend/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

<!-- form advanced init -->
<script src="{{ asset('/') }}backend/assets/js/pages/form-advanced.init.js"></script>
<!-- Summernote js -->
<script src="{{ asset('/') }}backend/assets/libs/summernote/summernote-bs4.min.js"></script>

<!-- init js -->
<script src="{{ asset('/') }}backend/assets/js/pages/form-editor.init.js"></script>
<!-- App js -->
<script src="{{ asset('/') }}backend/assets/js/app.js"></script>


<script>
    var purchAddIndex = 500;
    $(document).on('click', '#purchaseItemBtn', function() {
        $.ajax({
            type: 'GET',
            url: "{{ url('get-all-data-for-Purchase') }}",
            data: '',
            dataType: 'json',
            success: function(res) {

                console.log(res);
                var tr = '';
                tr += '<tr>';






                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][supplier]">'
                tr += '<option> -- Select Suppliers  -- </option>';
                $.each(res.suppliers, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';






                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][product]">'
                tr += '<option> -- Select Products -- </option>';
                $.each(res.products, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';




                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][unit]">'
                tr += '<option> -- Select Units -- </option>';
                $.each(res.units, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';




                tr += '<td>';
                tr += '<input type="number" class="form-control purchase-unit-price" data-id="' +
                    purchAddIndex + '" min="1" name="purch[' + purchAddIndex +
                    '][unit_price]" id="unitPrice' + purchAddIndex + '"/>';
                tr += '</td>';


                tr += '<td>';
                tr += '<input type="number" class="form-control purchase_quantity" data-id="' +
                    purchAddIndex + '" min="1" name="purch[' + purchAddIndex +
                    '][quantity]" id="quantity' + purchAddIndex + '"/>';
                tr += '</td>';





                tr += '<td>';
                tr +=
                    '<input type="number" class="form-control purchase-total-amount" readonly name="purch[' +
                    purchAddIndex + '][total_price]" id="totalPrice' + purchAddIndex + '"/>';
                tr += '</td>';

                tr += '<td>';
                tr +=
                    '<button type="button" class="btn btn-danger purchase-remove-btn"> - </button>';
                tr += '</td>';

                tr += '</tr>';

                $('#purchaseTBody').append(tr);
                $('.my-select2').select2({
                    width: '100%',
                    dropdownAutoWidth: true
                });
                purchAddIndex++;
            }
        });
    });

    $(document).on('click', '.purchase-remove-btn', function() {
        $(this).closest('tr').remove();
    });

    $(document).on('keyup', '.purchase_quantity', function() {
        var dataId = $(this).attr('data-id');
        var quantity = $(this).val();
        var unitPrice = $('#unitPrice' + dataId).val();
        var itemTotalPrice = quantity * unitPrice;
        $('#totalPrice' + dataId).val(itemTotalPrice);
    });

    $(document).on('keyup', '.purchase-unit-price', function() {
        var dataId = $(this).attr('data-id');
        var unitPrice = $(this).val();
        var quantity = $('#quantity' + dataId).val();
        var itemTotalPrice = quantity * unitPrice;
        $('#totalPrice' + dataId).val(itemTotalPrice);
    });
</script>

<script>
    var purchAddIndex = 500;
    $(document).on('click', '#purchaseItemBtn', function() {
        $.ajax({
            type: 'GET',
            url: "{{ url('branches/branch-get-all-data-for-Purchase') }}",
            data: '',
            dataType: 'json',
            success: function(res) {

                console.log(res);
                var tr = '';
                tr += '<tr>';






                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][supplier]">'
                tr += '<option> -- Select Suppliers  -- </option>';
                $.each(res.suppliers, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';






                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][product]">'
                tr += '<option> -- Select Products -- </option>';
                $.each(res.products, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';




                tr += '<td>';
                tr += '<select class="form-control" name="purch[' + purchAddIndex + '][unit]">'
                tr += '<option> -- Select Units -- </option>';
                $.each(res.units, function(key, value) {
                    tr += '<option value="' + value.id + '">' + value.name +
                        '</option>';
                });
                tr += '</select>'
                tr += '</td>';




                tr += '<td>';
                tr += '<input type="number" class="form-control purchase-unit-price" data-id="' +
                    purchAddIndex + '" min="1" name="purch[' + purchAddIndex +
                    '][unit_price]" id="unitPrice' + purchAddIndex + '"/>';
                tr += '</td>';


                tr += '<td>';
                tr += '<input type="number" class="form-control purchase_quantity" data-id="' +
                    purchAddIndex + '" min="1" name="purch[' + purchAddIndex +
                    '][quantity]" id="quantity' + purchAddIndex + '"/>';
                tr += '</td>';





                tr += '<td>';
                tr +=
                    '<input type="number" class="form-control purchase-total-amount" readonly name="purch[' +
                    purchAddIndex + '][total_price]" id="totalPrice' + purchAddIndex + '"/>';
                tr += '</td>';

                tr += '<td>';
                tr +=
                    '<button type="button" class="btn btn-danger purchase-remove-btn"> - </button>';
                tr += '</td>';

                tr += '</tr>';

                $('#purchaseTBody').append(tr);
                $('.my-select2').select2({
                    width: '100%',
                    dropdownAutoWidth: true
                });
                purchAddIndex++;
            }
        });
    });

    $(document).on('click', '.purchase-remove-btn', function() {
        $(this).closest('tr').remove();
    });

    $(document).on('keyup', '.purchase_quantity', function() {
        var dataId = $(this).attr('data-id');
        var quantity = $(this).val();
        var unitPrice = $('#unitPrice' + dataId).val();
        var itemTotalPrice = quantity * unitPrice;
        $('#totalPrice' + dataId).val(itemTotalPrice);
    });

    $(document).on('keyup', '.purchase-unit-price', function() {
        var dataId = $(this).attr('data-id');
        var unitPrice = $(this).val();
        var quantity = $('#quantity' + dataId).val();
        var itemTotalPrice = quantity * unitPrice;
        $('#totalPrice' + dataId).val(itemTotalPrice);
    });

    $(document).ready(function() {
        $('.course').on('change', function() {
            var id = $('#course_title_id option:selected').val();
            //    console.log(course_title_id)
            // var courseOfferPrice = $('#courseOfferPrice'+course_title_id).val();
            // var coursePrice = $('#coursePrice'+course_title_id).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('student.course.price') }}",
                data: {
                    id: id
                },
                dataType: 'json',

                success: function(response) {

                    $('#offer_price').val(response.offer_price);
                    $('#price').val(response.price);
                },
            });
        });

        $('#batch_id').on('change', function() {
            var id = $('#batch_id option:selected').val();
            //console.log(id);
            // Use For Get Class Wise Group
            $('#schedule_id').html('');
            $.ajax({
                url: '{{ route('batch.wish.schedule') }}?id=' + id,
                type: 'get',
                success: function(res) {
                    $('#schedule_id').html(
                        '<option value="">Select schedule ... </option>');
                    $.each(res, function(key, value) {
                        $('#schedule_id').append('<option value="' + value
                            .id + '">' + value.day + '</option>');
                    });
                }
            });
        });
    });



    calculate = function() {
        var resources = document.getElementById('offer_price').value;
        var minutes = document.getElementById('pay_amount').value;
        document.getElementById('due_amount').value = parseInt(resources) - parseInt(minutes);

    }

    $('#branch_id').on('change', function() {
        var branch_id = $('#branch_id option:selected').val();

        // console.log(id);
        // Use For Get Class Wise Group
        $('#course_title_id').html('');
        $.ajax({
            url: '{{ route('branchWishCourse') }}?branch_id=' + branch_id,
            type: 'get',
            success: function(res) {
                $('#course_title_id').html(
                    '<option value="">Select Your Course ... </option>');
                $.each(res, function(key, value) {
                    $('#course_title_id').append('<option value="' + value.id +
                        '">' + value.title + '</option>');
                });
            }
        });
    });

    $('#course_title_id').on('change', function() {
        var course_title_id = $('#course_title_id option:selected').val();
        // console.log(course_title_id);
        // Use For Get Class Wise Group
        $('#batch_id').html('');
        $.ajax({
            url: '{{ route('courseWishBatchGet') }}?course_title_id=' + course_title_id,
            type: 'get',
            success: function(res) {
                $('#batch_id').html('<option value="">Select Batch ... </option>');
                $.each(res, function(key, value) {
                    $('#batch_id').append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script>

@yield('script')
