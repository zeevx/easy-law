<script>
    $(document).ready(function () {
        _formValidation();
        bankOrCash($('#payment_method').val());

        $(document).on('change', '#service_type', function () {
            let service_id = $(this).val();
            if (service_id) {
                var tr = $("#service_row").parent().parent();
                var a = tr.find('.service_ids');
                if (a.length === 0) {
                    getService(service_id);
                } else {
                    var found = true;
                    $(".service_ids").each(function () {
                        if ($(this).val() === service_id) {
                            let id = $(this).data('id');

                            let qty = parseFloat($('#qty_' + id).val());
                            let amount = parseFloat($('#amount_' + id).val());
                            parseFloat($('#qty_' + id).val(qty + 1));
                            let new_qty = parseFloat($('#qty_' + id).val());
                            let amt = new_qty * amount;
                            $("#line_total_" + id).val(amt);
                            calculate();
                            found = false;
                            return false;
                        }
                    })
                    if (found) {
                        getService(service_id)
                    }
                }

            }
        })
    });

    function hideOrShowDefaultRow() {
        if ($('#service_row').find('tr').length > 1) {
            $('#row_0').hide();
        } else {
            $('#row_0').show();
        }
    }

    function getService(service_id) {
        let row = parseInt($("#row").val());
        $.ajax({
            type: 'GET',
            url: SET_DOMAIN+"/invoice/service",
            data: {
                service_id: service_id,
                row: row,
            },
            dateType: 'html',
            success: function (data) {
                $("#service_row").append(data);
                $('#row').val(row + 1);
                calculate();
                hideOrShowDefaultRow();
            }
        });
    }

    $("#service_row").on('click', '.delete_row', function () {
        $(this).closest('tr').remove();
        hideOrShowDefaultRow();
        calculate();
    })

    function calculate() {
        let sub_total = 0;
        let qty = 0;
        $(".line_total").each(function () {
            sub_total = sub_total + ($(this).val() * 1);
        })


        let net_total = 0;
        $("#sub_total").val(sub_total);
        var discount = invoice_discount(sub_total);
        $('#discount_amount').val(discount)

        net_total = sub_total - discount;
        $('#net_total').val(net_total)

        var tax = order_tax(net_total, discount);

        net_total = parseFloat(parseFloat(net_total) + parseFloat(tax)).toFixed(2);

        $("#grand_total").val(net_total);

        var due_amount = calculate_balance_due(net_total);

        $('#due').val(due_amount);

    }

    function calculate_balance_due(total) {
        let paid = parseFloat($('#paid').val());
        paid = isNaN(paid) ? 0 : paid;
        if (paid > total){
            toastr.error('You can not pay more than payable amount', 'Error');
            paid = total;
            $('#paid').val(total);
        }
        return parseFloat(total - paid).toFixed(2);
    }

    $("#service_row").delegate(".amount,.qty", "keyup blur change", function() {
        var tr = $(this).parent().parent().parent();
        var qty =tr.find('.qty');
        tr.find(".line_total").val(qty.val() * tr.find(".amount").val());
        calculate();

    })

    function invoice_discount(total_amount) {
        var calculation_type = $('#discount_type').val();
        var calculation_amount = __read_number($('#discount'));

        var discount = __calculate_amount(calculation_type, calculation_amount, total_amount);

        $('#total_discount').val(discount, false);

        return discount;
    }

    function __read_number(input_element, use_page_currency = false) {
        return input_element.val();
    }

    function __calculate_amount(calculation_type, calculation_amount, amount) {

        var calculation_amount = parseFloat(calculation_amount);
        calculation_amount = isNaN(calculation_amount) ? 0 : calculation_amount;

        var amount = parseFloat(amount);
        amount = isNaN(amount) ? 0 : amount;

        switch (calculation_type) {
            case 'flat':
                return parseFloat(calculation_amount).toFixed(2);
            case 'percentage':
                return parseFloat((calculation_amount / 100) * amount).toFixed(2);
            default:
                return 0;
        }
    }

    function order_tax(price_total, discount) {
        var calculation_type = 'percentage';
        let tax = $('#tax_id').val();
        let calculation_amount = 0;
        if (tax){
            calculation_amount = parseFloat(tax.split("-")[1]);
        }

        var order_tax = __calculate_amount(calculation_type, calculation_amount, price_total);

        $('#tax_amount').val(order_tax);
        return order_tax;
    }

    $("#discount, #discount_type, #tax_calculation_amount, #paid, #tax_id").on('keyup blur change', function () {
        calculate();
    });

    $(document).on('change', '#clientable_id', function(){
        let client_id = $(this).val();
        let invoice_type = $('#invoice_type').val();
        console.log(invoice_type)
        if (invoice_type === 'income'){
            $.ajax({
                type: 'GET',
                url: SET_DOMAIN + "/invoice/case",
                data: {
                    client_id: client_id
                },
                dateType: 'json',
                success: function (data) {
                    $("#case_column").html(data.html);
                    $('.select_case').niceSelect()
                },
                error: function(data){
                    ajax_error(data);
                }
            });
        }

    });
</script>
