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
        <a class="md-fab md-fab-accent" href="#new_issue" data-uk-modal="{ center:true }">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>

    <div class="uk-modal" id="new_issue">
        <div class="uk-modal-dialog" id="modelContent">
           
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

$(function () {
    // datatables
    altair_datatables.dt_colVis();
});

altair_datatables = {

    dt_colVis: function () {
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
                    "data":
                            function (data) {
                                data._token = "{{{ csrf_token() }}}";
                                return data;
                            }
                }, "AutoWidth": false,
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "status"},
                    {"data": "created_at"},
                    {"data": "id"}
                ],
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $('td:eq(0)', nRow).html(iDataIndex + 1);
                    if(aData.status == 1){
                        var status = '<span class="uk-badge uk-badge-success">Active</span>';
                    }else{
                        var status = '<span class="uk-badge uk-badge-danger">Inactive</span>';
                    }
                    $('td:eq(3)', nRow).html(status);
                    $('td:eq(5)', nRow).html('<a onclick="editUser('+aData.id+')" href="#new_issue" data-uk-modal="{ center:true }"><i class="material-icons">mode_edit</i></a>\n\
                                                <a href="#" onclick="deleteUser('+aData.id+')"><i class="material-icons">delete</i></a>');
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
                    .each(function (index) {
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
                    .each(function () {
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
            $dt_colVis.closest('.dt-uikit').find('.md-colVis .data-md-icheck').on('ifClicked', function () {
                $(this).closest('li').click();
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowAll,.md-colVis .ColVis_Restore').on('click', function () {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked', true).iCheck('update')
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowNone').on('click', function () {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked', false).iCheck('update')
            });

        }
    }
};

function editUser(id){
    $.ajax({
        url:"{{URL::to('users/getUserDetails')}}",
        method:"POST",
        type:"json",
        data:{id:id,_token:"{!!csrf_token()!!}"},
        success:function(data){
            var active = (data.status == 1)?'checked="checked"':'';
            var inactive = (data.status == 0)?'checked="checked"':'';
            var html = '<form class="uk-form-stacked" id="userData">\n\
                            <input type="hidden" name="id" value="'+data.id+'">\n\
                            <div class="uk-margin-medium-bottom">\n\
                                <label for="task_title">Name</label>\n\
                                <input type="text" class="md-input" id="Task_title" name="name" value="'+data.name+'">\n\
                            </div>\n\
                            <div class="uk-margin-medium-bottom">\n\
                                <label for="task_title">Email</label>\n\
                                <input type="text" class="md-input" id="Task_title" name="email" value="'+data.email+'">\n\
                            </div>\n\
                            <div class="uk-margin-medium-bottom">\n\
                                <label for="task_priority" class="uk-form-label">Priority</label>\n\
                                <div>\n\
                                        <span class="icheck-inline">\n\
                                            <input value="1" '+active+' type="radio" name="status" id="task_priority_minor" data-md-icheck />\n\
                                            <label for="task_priority_minor" class="inline-label uk-badge uk-badge-success">Active</label>\n\
                                        </span>\n\
                                        <span class="icheck-inline">\n\
                                            <input value="0" '+inactive+' type="radio" name="status" id="task_priority_blocker" data-md-icheck />\n\
                                            <label for="task_priority_blocker" class="inline-label uk-badge uk-badge-danger">Inactive</label>\n\
                                        </span>\n\
                                </div>\n\
                            </div>\n\
                            <div class="uk-modal-footer uk-text-right">\n\
                                <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button onclick="updateUser()" type="button" class="md-btn md-btn-flat md-btn-flat-primary" id="snippet_new_save">Update</button>\n\
                            </div>\n\
                        {!! csrf_field() !!}</form>';
                $('#modelContent').html(html);
                altair_forms.select_elements();
                altair_md.checkbox_radio();
        }
    });
    
}

function updateUser(){
    $.ajax({
        url:"{{URL::to('users/updateUserDetails')}}",
        method:"POST",
        type:"json",
        data:$('#userData').serialize(),
        success:function(data){
            UIkit.notify(data.msg, {pos:'top-right', status:'success'});
            UIkit.modal("#new_issue").hide();
            users_table.ajax.reload();
        }
    });
    
}

function deleteUser(id){
    UIkit.modal.confirm('Are you sure?', function(){ 
        
    });
}

</script>
@endsection