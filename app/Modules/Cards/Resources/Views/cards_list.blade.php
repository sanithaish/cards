@extends('layouts.app')

@section('content')
<div id="page_content_inner">

    <h4 class="heading_a uk-margin-bottom">Show/hide columns</h4>
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="#card_model" data-uk-modal="{ center:true }">
        <i class="material-icons">&#xE145;</i>
    </a>
</div>

<div class="uk-modal" id="card_model">
    <div class="uk-modal-dialog" id="modelContent">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Headline</h3>
        </div>
        {!! Form::open(array('url'=>'','class'=>'uk-form-stacked','id'=>'card_form')) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row">
                        <label for="card_name">Card Name<span class="req">*</span></label>
                        <input type="text" name="card_name" required class="md-input" />
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row">
                        <label for="card_number">Card Number<span class="req">*</span></label>
                        <input type="text" name="card_number" required  class="md-input" />
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row">
                        <label for="card_name">Card Limit<span class="req">*</span></label>
                        <input type="text" name="card_limit" required class="md-input" />
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row uk-margin-top">
                        <label for="val_birth">Bill Date<span class="req">*</span></label>
                        <input type="text" name="bill_date" id="val_birth" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row uk-margin-top">
                        <label for="val_birth">Payment Date<span class="req">*</span></label>
                        <input type="text" name="payment_date" id="val_birth" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row">
                        <label for="card_type" class="uk-form-label">Card Type</label>
                        <select id="card_type" name="card_type" required data-md-selectize>
                            <option value="">Choose..</option>
                            <option value="1">Visa</option>
                            <option value="2">Master</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="parsley-row">
                        <label for="bank" class="uk-form-label">Bank</label>
                        <select id="bank" name="bank" required data-md-selectize>
                            <option value="">Choose..</option>
                            <option value="1">SBI</option>
                            <option value="2">SCB</option>
                            <option value="3">HDFC</option>
                            <option value="4">ICICI</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="button" onclick="saveCard()" class="md-btn md-btn-flat md-btn-flat-primary">Action</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('css')

@endsection

@section('js')
<!-- datatables -->
<script src="{{ asset('template/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<!-- datatables colVis-->
<script src="{{ asset('template/bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<!-- datatables tableTools-->
<script src="{{ asset('template/bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<!-- datatables custom integration -->
<script src="{{ asset('template/assets/js/custom/datatables_uikit.min.js') }}"></script>

<!--  datatables functions -->
<script src="{{ asset('template/assets/js/pages/plugins_datatables.js') }}"></script>
<script>
$(function() {
    // datatables
    altair_datatables.dt_colVis();
    altair_form_validation.init();
});

// validation (parsley)
altair_form_validation = {
    init: function() {
        var $formValidate = $('#card_form');

        $formValidate.parsley()
            .on('form:validated', function() {
                altair_md.update_input($formValidate.find('.md-input-danger'));
            })
            .on('field:validated', function(parsleyField) {
                if ($(parsleyField.$element).hasClass('md-input')) {
                    altair_md.update_input($(parsleyField.$element));
                }
            });
    }
};

altair_datatables = {

    dt_colVis: function() {
        var $dt_colVis = $('#dt_colVis');
        if ($dt_colVis.length) {

            // init datatables
            users_table = $dt_colVis.DataTable({
                "responsive": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": '{!! URL::to("users/getUsers") !!}',
                    "type": "POST",
                    "data": function(data) {
                        data._token = "{{{ csrf_token() }}}";
                        return data;
                    }
                },
                "AutoWidth": false,
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "id"
                    }
                ],
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $('td:eq(0)', nRow).html(iDataIndex + 1);
                    if (aData.status == 1) {
                        var status = '<span class="uk-badge uk-badge-success">Active</span>';
                    } else {
                        var status = '<span class="uk-badge uk-badge-danger">Inactive</span>';
                    }
                    $('td:eq(3)', nRow).html(status);
                    $('td:eq(5)', nRow).html('<a onclick="editUser(' + aData.id + ')" href="#new_issue" data-uk-modal="{ center:true }"><i class="material-icons">mode_edit</i></a>\n\
                                                <a href="#" onclick="deleteUser(' + aData.id + ')"><i class="material-icons">delete</i></a>');
                }
            });

            // init colVis
            var colvis = new $.fn.dataTable.ColVis(users_table, {
                buttonText: 'Select columns',
                exclude: [0],
                restore: "Restore",
                showAll: "Show all",
                showNone: "Show none"
            });

            // custom colVis elements
            var _colVis_button = $(colvis.dom.button).off('click').attr('class', 'md-btn md-btn-colVis');
            var _colVis_wrapper = $('<div class="uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:\'click\'}"/>').append(_colVis_button);
            var _colVis_wrapper_outer = $('<div class="md-colVis uk-text-right"/>').append(_colVis_wrapper);
            var _colVis_collection = $(colvis.dom.collection);

            // Modify colVis collection
            $(_colVis_collection)
                .attr({
                    'class': 'md-list-inputs',
                    'style': ''
                })
                .find('input')
                .each(function(index) {
                    var inputClone = $(this).clone().hide();
                    $(this).attr({
                        'class': 'data-md-icheck',
                        'id': 'col_' + index
                    }).css({
                        'float': 'left'
                    }).before(inputClone)
                })
                .end()
                .find('span').unwrap()
                .each(function() {
                    var thisText = $(this).text();
                    var thisInputId = $(this).prev('input').attr('id');
                    $(this)
                        .after('<label for="' + thisInputId + '">' + thisText + '</label>')
                        .end()
                })
                .remove();

            // append collection to collection wrapper
            var _colVis_collection_wrapper = $('<div class="uk-dropdown uk-dropdown-flip"/>').append(_colVis_collection);

            // append collection wrapper to colVis wrapper
            _colVis_wrapper
                .append(_colVis_collection_wrapper);

            // insert colVis elements before datatable header
            $dt_colVis.closest('.dt-uikit').find('.dt-uikit-header').before(_colVis_wrapper_outer);

            // initialize styled checkboxes in dropdown
            altair_md.checkbox_radio();

            // custom events
            $dt_colVis.closest('.dt-uikit').find('.md-colVis .data-md-icheck').on('ifClicked', function() {
                $(this).closest('li').click();
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowAll,.md-colVis .ColVis_Restore').on('click', function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked', true).iCheck('update')
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowNone').on('click', function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked', false).iCheck('update')
            });

        }
    }
};

function saveCard() {
    $('#card_form').parsley().validate();
    if ($('#card_form').parsley().isValid()) {
        $.ajax({
            url: "{{URL::to('cards/saveCard')}}",
            method: "POST",
            type: "json",
            data: $('#card_form').serialize(),
            success: function(data) {
                UIkit.modal("#card_model").hide();
                UIkit.notify(data.msg, {pos:'top-right',status:'success'});
            }
        });
    }
}

function editUser(id) {
    $.ajax({
        url: "{{URL::to('users/getUserDetails')}}",
        method: "POST",
        type: "json",
        data: {
            id: id,
            _token: "{!!csrf_token()!!}"
        },
        success: function(data) {
            altair_forms.select_elements();
        }
    });
}

function updateUser() {
    $.ajax({
        url: "{{URL::to('users/updateUserDetails')}}",
        method: "POST",
        type: "json",
        data: $('#userData').serialize(),
        success: function(data) {
            UIkit.notify(data.msg, {
                pos: 'top-right',
                status: 'success'
            });
            UIkit.modal("#new_issue").hide();
            users_table.ajax.reload();
        }
    });

}

function deleteUser(id) {
    UIkit.modal.confirm('Are you sure?', function() {

    });
}  
</script>
@endsection