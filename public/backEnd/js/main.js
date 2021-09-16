	'use strict';

	// metisMenu
	var metismenu = $("#sidebar_menu");
	if(metismenu.length){
		metismenu.metisMenu();
	}

	$(".open_miniSide").on("click", function () {
		$(".sidebar").toggleClass("mini_sidebar");
		$("#main-content").toggleClass("mini_main_content");
	  });


	  $(document).on("click", function(event){
        if (!$(event.target).closest(".sidebar,.sidebar_icon  ").length) {
            $("body").find(".sidebar").removeClass("active");
        }
    });

	function slideToggle(clickBtn, toggleDiv) {
		clickBtn.on('click', function () {
			toggleDiv.stop().slideToggle('slow');
		});
	}
	$(document).ready(function(){
		$(".Earning_add_btn").on("click", function(){
			$(".single_earning_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
		});
	});
	$(document).ready(function(){
		$(".deductions_add_btn").on("click", function(){
			$(".single_deductions_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
		});
	});
	function removeDiv(clickBtn, toggleDiv) {
		"use strict";
		clickBtn.on('click', function () {
			toggleDiv.hide('slow', function () {
				toggleDiv.remove();
			});
		});
	}

	slideToggle($('#barChartBtn'), $('#barChartDiv'));
	removeDiv($('#barChartBtnRemovetn'), $('#incomeExpenseDiv'));
	slideToggle($('#areaChartBtn'), $('#areaChartDiv'));
	removeDiv($('#areaChartBtnRemovetn'), $('#incomeExpenseSessionDiv'));

	/*-------------------------------------------------------------------------------
         Start Primary Button Ripple Effect
	   -------------------------------------------------------------------------------*/
	$('.primary-btn').on('click', function (e) {
		// Remove any old one
		$('.ripple').remove();

		// Setup
		var primaryBtnPosX = $(this).offset().left,
			primaryBtnPosY = $(this).offset().top,
			primaryBtnWidth = $(this).width(),
			primaryBtnHeight = $(this).height();

		// Add the element
		$(this).prepend("<span class='ripple'></span>");

		// Make it round!
		if (primaryBtnWidth >= primaryBtnHeight) {
			primaryBtnHeight = primaryBtnWidth;
		} else {
			primaryBtnWidth = primaryBtnHeight;
		}

		// Get the center of the element
		var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
		var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

		// Add the ripples CSS and start the animation
		$('.ripple')
			.css({
				width: primaryBtnWidth,
				height: primaryBtnHeight,
				top: y + 'px',
				left: x + 'px'
			})
			.addClass('rippleEffect');
	});

	// for form popup
    $('.pop_up_form_hader').click( function(){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        } else {
            $('.pop_up_form_hader.active').removeClass('active');
            $(this).addClass('active');
        }
	});
	$(document).click(function(event){
        if (!$(event.target).closest(".company_form_popup").length) {
            $("body").find(".pop_up_form_hader").removeClass("active");
        }
    });
	jQuery(document).ready(function($) {
		$('.small_circle_1').circleProgress({
			value: 0.75,
			size: 60,
			lineCap: 'round',
			emptyFill: '#F5F7FB',
			thickness:'5',
			fill: {
			  gradient: [["#7C32FF", .47], ["#C738D8", .3]]
			}
		  });
		});
	jQuery(document).ready(function($) {
		$('.large_circle').circleProgress({
			value: 0.75,
			size: 228,
			lineCap: 'round',
			emptyFill: '#F5F7FB',
			thickness:'5',
			fill: {
			  gradient: [["#7C32FF", .47], ["#C738D8", .3]]
			}
		  });
		});

	jQuery(document).ready(function($) {
        $(".entry-content").hide('slow');
        $(".entry-title").click(function() {
            $(".entry-content").hide();
        $(this).parent().children(".entry-content").slideToggle(600); });
        });




	/*-------------------------------------------------------------------------------
         Start Add Deductions
	   -------------------------------------------------------------------------------*/
	$('#addDeductions').on('click', function () {
		$('#addDeductionsTableBody').append(
			'<tr>' +
			'<td width="80%" class="pr-30 pt-20">' +
			'<div class="input-effect mt-10">' +
			'<input class="primary-input form-control" type="text" id="searchByFileName">' +
			'<label for="searchByFileName">Type</label>' +
			'<span class="focus-border"></span>' +
			'</div>' +
			'</td>' +
			'<td width="20%" class="pt-20">' +
			'<div class="input-effect mt-10">' +
			'<input class="primary-input form-control" type="text" id="searchByFileName">' +
			'<label for="searchByFileName">Value</label>' +
			'<span class="focus-border"></span>' +
			'</div>' +
			'</td>' +
			'<td width="10%" class="pt-30">' +
			'<button class="primary-btn icon-only fix-gr-bg close-deductions">' +
			'<span class="ti-close"></span>' +
			'</button>' +
			'</td>' +
			'</tr>'
		);
	});

	$('#addDeductionsTableBody').on('click', '.close-deductions', function () {
		$(this).closest('tr').fadeOut(500, function () {
			$(this).closest('tr').remove();
		});
	});


	/*-------------------------------------------------------------------------------
         End Add Earnings
	   -------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
         Start Upload file and chane placeholder name
	   -------------------------------------------------------------------------------*/
	var fileInput = document.getElementById('browseFile');
	if (fileInput) {
		fileInput.addEventListener('change', showFileName);
		function showFileName(event) {
			"use strict";
			var fileInput = event.srcElement;
			var fileName = fileInput.files[0].name;
			document.getElementById('placeholderInput').placeholder = fileName;
		}
	}

	if ($('.multipleSelect').length) {
		$('.multipleSelect').fastselect();
	}

	/*-------------------------------------------------------------------------------
         End Upload file and chane placeholder name
	   -------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
         Start Check Input is empty
	   -------------------------------------------------------------------------------*/
	$('.input-effect input').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}

		$(this).on('keyup', function () {
			if ($(this).val().length > 0) {
				$(this).siblings('.invalid-feedback').fadeOut('slow');
			} else {
				$(this).siblings('.invalid-feedback').fadeIn('slow');
			}
		});
	});

	$('.input-effect textarea').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}
	});

	/*-------------------------------------------------------------------------------
         End Check Input is empty
	   -------------------------------------------------------------------------------*/
	$(window).on('load', function () {
		$('.input-effect input, .input-effect textarea').focusout(function () {
			if ($(this).val() != '') {
				$(this).addClass('has-content');
			} else {
				$(this).removeClass('has-content');
			}
		});
	});

	/*-------------------------------------------------------------------------------
         End Input Field Effect
	   -------------------------------------------------------------------------------*/
	// Search icon
	$('#search-icon').on('click', function () {
		$('#search').focus();
	});

	$('#start-date-icon').on('click', function () {
		$('#startDate').focus();

	});

	$('#end-date-icon').on('click', function () {
		$('#endDate').focus();
	});

	$('.primary-input.date').datetimepicker({
        format : 'YYYY-MM-DD'
	});


    $('.primary-input.datetime').datetimepicker({
        format : 'YYYY-MM-DD H:mm'
    });




	/*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});
	$('#close_sidebar').on('click', function () {
        $('#sidebar').removeClass('active');
    })

	// setNavigation();
	/*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
	   -------------------------------------------------------------------------------*/
	$(window).on('load', function () {

		$('.dataTables_wrapper .dataTables_filter input').on('focus', function () {
			$('.dataTables_filter > label').addClass('jquery-search-label');
		});

		$('.dataTables_wrapper .dataTables_filter input').on('blur', function () {
			$('.dataTables_filter > label').removeClass('jquery-search-label');
		});
	});

	// Student Details


	$('.single-cms-box .btn').on('click', function () {
		$(this).fadeOut(500, function () {
			$(this).closest('.col-lg-2.mb-30').hide();
		});
	});

	/*----------------------------------------------------*/
	/*  Magnific Pop up js (Image Gallery)
    /*----------------------------------------------------*/
	$('.pop-up-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	/*-------------------------------------------------------------------------------
         Jquery Table
	   -------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
         Nice Select
	   -------------------------------------------------------------------------------*/
	if ($('.niceSelect').length) {
		$('.niceSelect').niceSelect();
	}
    //niceselect select jquery
    $('.nice_Select').niceSelect();
    //niceselect select jquery
    $('.nice_Select2').niceSelect();
    $('.primary_select').niceSelect();
	/*-------------------------------------------------------------------------------
       Full Calendar Js
	-------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
       Moris Chart Js
	-------------------------------------------------------------------------------*/
	$(document).ready(function () {
		if ($('#commonAreaChart').length) {
			barChart();
		}
		if ($('#commonAreaChart').length) {
			areaChart();
		}
		if ($('#donutChart').length) {

			donutChart();
		}
	});



	function donutChart() {
		var total_collection = document.getElementById("total_collection").value;
		var total_assign = document.getElementById("total_assign").value;

		var due = total_assign - total_collection;


		window.donutChart = Morris.Donut({
			element: 'donutChart',
			data: [{ label: 'Total Collection', value: total_collection }, { label: 'Due', value: due }],
			colors: ['#7c32ff', '#c738d8'],
			resize: true,
			redraw: true
		});
	}


	// for MENU notification
	$('.bell_notification_clicker').on('click', function () {
		$('.Menu_NOtification_Wrap').toggleClass('active');
	});

	$(document).on("click", function(event){
        if (!$(event.target).closest(".bell_notification_clicker ,.Menu_NOtification_Wrap").length) {
            $("body").find(".Menu_NOtification_Wrap").removeClass("active");
        }
	});

	// OPEN CUSTOMERS POPUP
	$('.pop_up_form_hader').on('click', function () {
		$('.company_form_popup').toggleClass('Company_Info_active');
		$('.pop_up_form_hader').toggleClass('Company_Info_opened');
	});

	$(document).on("click", function(event){
        if (!$(event.target).closest(".pop_up_form_hader ,.company_form_popup").length) {
            $("body").find(".company_form_popup").removeClass("Company_Info_active");
            $("body").find(".pop_up_form_hader").removeClass("Company_Info_opened");
        }
	});


	// CHAT_MENU_OPEN
    $('.CHATBOX_open').on('click', function() {
        $('.CHAT_MESSAGE_POPUPBOX').toggleClass('active');
    });
    $('.MSEESAGE_CHATBOX_CLOSE').on('click', function() {
        $('.CHAT_MESSAGE_POPUPBOX').removeClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".CHAT_MESSAGE_POPUPBOX, .CHATBOX_open").length) {
            $("body").find(".CHAT_MESSAGE_POPUPBOX").removeClass("active");
        }
    });


	// add_action
    $('.add_action').on('click', function() {
        $('.quick_add_wrapper').toggleClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".quick_add_wrapper, .add_action").length) {
            $("body").find(".quick_add_wrapper").removeClass("active");
        }
    });


	// filter_text
    $('.filter_text span').on('click', function() {
        $('.filterActivaty_wrapper').toggleClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".filterActivaty_wrapper , .filter_text span").length) {
            $("body").find(".filterActivaty_wrapper").removeClass("active");
        }
    });


 //active courses option
 $(".leads_option_open").on("click", function() {
    $(this).parent(".dots_lines").toggleClass("leads_option_active");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest(".dots_lines").length) {
		  $("body")
			.find(".dots_lines")
			.removeClass("leads_option_active");
		}
	  });
// ######  inbox style icon ######
$('.favourite_icon i').on('click', function(e) {
    $(this).toggleClass("selected_favourite"); //you can list several class names
    e.preventDefault();
  });


// ######  copyTask style #######
$(".CopyTask_clicker").on("click", function() {
    $(this).parent("li.copy_task").toggleClass("task_expand_wrapper_open");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest("li.copy_task").length) {
		  $("body")
			.find("li.copy_task")
			.removeClass("task_expand_wrapper_open");
		}
	});

// ######  copyTask style #######
$(".Reminder_clicker").on("click", function() {
    $(this).parent("li.Set_Reminder").toggleClass("task_expand_wrapper_open");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest("li.Set_Reminder").length) {
		  $("body")
			.find("li.Set_Reminder")
			.removeClass("task_expand_wrapper_open");
		}
	  });

// Crm_table_active
if ($('.Crm_table_active').length) {
    $('.Crm_table_active').DataTable({
        bLengthChange: false,
        "bDestroy": true,
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: trans('js.Quick Search'),
            lengthMenu: trans('js.Show')+" _MENU_ " + trans('js.entries'),
            zeroRecords: trans('js.No data available in table'),
            info: trans('js.Showing page')+" _PAGE_ "+trans('js.of')+" _PAGES_",
            infoEmpty: trans('js.No records available'),
            infoFiltered: "( "+ trans('js.filtered from')+" _MAX_ "+trans('js.total records')+")",
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        columnDefs: [{
            visible: false
        }],
        responsive: true,
        searching: false,
    });
}

// Crm_table_active 2
  if ($('.Crm_table_active2').length) {
    $('.Crm_table_active2').DataTable({
        bLengthChange: false,
        "bDestroy": false,
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: trans('js.Quick Search'),
            lengthMenu: trans('js.Show')+" _MENU_ " + trans('js.entries'),
            zeroRecords: trans('js.No data available in table'),
            info: trans('js.Showing page')+" _PAGE_ "+trans('js.of')+" _PAGES_",
            infoEmpty: trans('js.No records available'),
            infoFiltered: "( "+ trans('js.filtered from')+" _MAX_ "+trans('js.total records')+")",
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        columnDefs: [{
            visible: false
        }],
        responsive: true,
        searching: false,
        paging: false,
        info: false
    });
}


// CRM TABLE 3
if ($('.Crm_table_active3').length) {
	startDatatable();
}


// TABS DATA TABLE ISSU
    // data table responsive problem tab
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
               .columns.adjust()
               .responsive.recalc();
        });
	});


    $(document).ready(function () {
		$(document).ready(function(){
			$(".Add_note").click(function(){
				$(".note_add_form").slideToggle(900);
			});
		});
    });


$(document).on('click', '.remove', function () {
    $(this).parents('.row_lists').fadeOut();
});
$(document).ready(function(){
	$('.add_single_row').click(function() {
		$('.row_lists').parent("tbody").prepend('<tr class="row_lists"> <td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"> <textarea class="placeholder_invoice_textarea" placeholder="-" ></textarea> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0 pr-0 remove" style="border:0"> <div class="items_min_icon "><i class="fas fa-minus-circle"></i></div></td></tr>');
	});
})
// nestable for drah and drop
$(document).ready(function(){
    $('#nestable').nestable({
        group: 1
    })

});

// METU SET UP
$(".edit_icon").on("click", function(e){
    var target = $(this).parent().find('.menu_edit_field');
    $(this).toggleClass("expanded");
    target.slideToggle();
    $('.menu_edit_field').not( target ).slideUp();
});

// SCROLL NAVIGATION
$(document).ready(function(){
	// scroll /
	$('.scroll-left-button').click(function() {
	  event.preventDefault();
	  $('.scrollable_tablist').animate({
		scrollLeft: "+=300px"
	  }, "slow");
	});

	 $('.scroll-right-button ').click(function() {
	  event.preventDefault();
	  $('.scrollable_tablist').animate({
		scrollLeft: "-=300px"
	  }, "slow");
	});
});

// FOR CUSTOM TAB
$(function() {
    $('#theme_nav li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.Settings_option').hide();
    });
    $('#sms_setting li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.sms_ption').hide();
    });
});



function deleteId() {
	"use strict";
    var id = $('.deleteStudentModal').data("id")
   $('#student_delete_i').val(id);

}

function bankOrCash(val){
    "use strict";
    var field =  $('#bank_account_id');
    let method_column = $('#method_column');
    if (val === 'bank'){

        if (method_column.length){
            method_column.removeClass(method_column.data('old_class')).addClass(method_column.data('new_class'))
        }

        $('#bank_column').show();
        $("label[for='bank_account_id']").addClass('required');
        field.attr('disabled', false).attr('required', true).niceSelect('update');
    } else{
        if (method_column.length){
            method_column.removeClass(method_column.data('new_class')).addClass(method_column.data('old_class'))
        }
        $('#bank_column').hide();
        $("label[for='bank_account_id']").removeClass('required');
        field.attr('disabled', true).attr('required', false).niceSelect('update');
    }
}


$(document).ready(function(e) {
	$('.hide_row').click(function() {
		$(this).parent().parent().hide();
		return false;
	});
});

$(document).ready(function(e) {
	$('.minus_single_role').click(function() {
		$(this).parent(".single__role_member").hide(400);
		return false;
	});
});



    $(document).on('change', '#payment_method', function(){
        let val = $(this).val();
        bankOrCash(val);
    });

    $(document).on('keypress', 'input.input_number', function(event) {
        var is_decimal = $(this).data('decimal');

        if (is_decimal == 0) {
            if (__currency_decimal_separator == '.') {
                var regex = new RegExp(/^[0-9,-]+$/);
            } else {
                var regex = new RegExp(/^[0-9.-]+$/);
            }
        } else {
            var regex = new RegExp(/^[0-9.,-]+$/);
        }

        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.print_window', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=1400,height=400");
    })
    function myFunction(url) {

    }


    function hidePreloader() {
        "use strict";
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut();
    }

    function showPreloader() {
        "use strict";
        $('.preloader img').fadeIn();
        $('.preloader').fadeIn();
    }

    function showFormSubmitting(form) {
        "use strict";
        let submit = form.find('.submit');
        let submitting = form.find('.submitting');
        submit.hide();
        submitting.show();
        showPreloader();
    }

    function hideFormSubmitting(form) {
        "use strict";
        hidePreloader();
        let submit = form.find('.submit');
        let submitting = form.find('.submitting');
        submit.show();
        submitting.hide();
    }

    $(document).ready(function (){
        let custom_fields = $('.custom_field');
        $.each(custom_fields, function (i, v){
            $(this).trigger('change')
        })

    });

    $(document).on('change keyup', '.custom_field', function(){
        let controlled_fields = $(this).data('controlled_fields');
        if (controlled_fields){
            controlled_fields = controlled_fields.toString();
        } else {
            controlled_fields = '';
        }
        var type = $(this).attr('type');
        var this_val;
        if (type === 'checkbox'){
            let name = $(this).attr('name');
            this_val = new Array();
            $("input[name='"+name+"']:checked:enabled").each(function () {
                this_val.push($(this).val());
            });
        }else if (type === 'radio'){
            if (this.checked){
                this_val = $(this).val();
            }
        } else{
            this_val = $(this).val();
        }

        if (controlled_fields) {
            controlled_fields = controlled_fields.split(',');
            $.each(controlled_fields, function (i, v) {
                let controlled_field = $('#controlled_field_' + v);
                if (controlled_field.length) {
                    let controlled_val = controlled_field.data('controlled_field_value');
                    let required = controlled_field.data('required');
                    if ($.isArray(this_val)){
                        if ($.inArray(controlled_val, this_val) !== -1) {
                            controlled_field.show();
                            if (required){
                                $('#custom_field_'+v).attr('required', true);
                            }
                        } else{
                            controlled_field.hide();
                            if (required){
                                $('#custom_field_'+v).attr('required', false);
                            }
                        }
                    } else{
                        if (controlled_val === this_val) {
                            controlled_field.show();
                            if (required){
                                $('#custom_field_'+v).attr('required', true);
                            }
                        } else {
                            controlled_field.hide();
                            if (required){
                                $('#custom_field_'+v).attr('required', false);
                            }
                        }
                    }
                }
            })
        }


    })
    $(".toggle-password").on('click', function () {

        var input = $(this).closest('.input-group').find('input');

        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
