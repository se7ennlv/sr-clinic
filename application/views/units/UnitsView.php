<div class="card mb-4 py-3 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-th-list"></i> <strong>Units Management</strong></h5>
        <hr>

        <button type="button" class="btn btn-success" onclick="Add();">
            <i class="fas fa-plus-circle"></i> Add New Item
        </button>
        <hr>

        <div class="table-responsive" style="width: 700px;">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-nowrap">Unit Name</th>
                        <th class="text-nowrap">Low Stock Alert</th>
                        <th class="text-center text-nowrap">Options</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModal">
                    <i class="fas fa-plus-circle"></i> Add New Unit
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm-data" action="#" method="POST" autocomplete="off" novalidate="off">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="Name" id="Name" placeholder="Enter unit name" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="QtyAlert" id="QtyAlert" placeholder="Enter low stock alert" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="UID" id="UID" />
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var events;

    $(document).ready(function() {
        $('#dataTable').DataTable({
            pageLength: 10,
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?php echo site_url('UnitController/FetchUnitDataTable'); ?>'
            },
            columns: [{
                    data: "UID",
                    className: 'text-center',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'Name',
                    className: "text-center"
                },
                {
                    data: 'QtyAlert',
                    className: "text-center"
                },
                {
                    data: 'UID',
                    render: function(data, type, row) {

                        var btnActions = '<a href="#" id="' + data + '" class="btn btn-warning btn-xs" onclick="Update(this.id);" title="Edit"><i class="fas fa-edit"></i></a> ' +
                            '<a href="#" id="' + data + '" class="btn btn-danger btn-xs" title="Delete" onclick="Delete(this.id);"><i class="fas fa-times-circle"></i></a>';
                        return btnActions;

                    },
                    orderable: false,
                    className: "text-center"
                }
            ]
        });
    });

    function Add() {
        events = 'add';

        $('#unitModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Add New Unit');
    }

    function Update(did) {
        events = 'update';

        $.ajax({
            type: "GET",
            url: "<?= site_url('UnitController/FetchOneUnit') ?>/" + did,
            dataType: "JSON"
        }).done(function(data) {
            $('#unitModal').modal('show');
            $('.modal-title').html('<i class="fas fa-edit"></i> Update Unit Info');
            $('#UID').val(data.UID);
            $('#Name').val(data.Name);
            $('#QtyAlert').val(data.QtyAlert);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $.smkAlert({
                text: "Something went wrong, please contact IT!",
                type: "danger"
            });
        });
    }

    function Delete(did) {
        Swal.fire({
            type: 'question',
            title: 'Confirm ?',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: '<?= site_url('UnitController/InitDeleteUnit') ?>/' + did
                }).done(function(data) {
                    $.smkAlert({
                        type: data.status,
                        text: data.message
                    });
                    $('#dataTable').DataTable().ajax.reload(null, false);
                });

            }
        })
    }

    $('form').on('submit', function(e) {
        e.preventDefault();

        var msg;

        if (events === 'add') {
            url = "<?= site_url('UnitController/InitInsertUnit') ?>";
            msg = 'Saving...'
        } else {
            msg = 'Updating...';
            url = "<?= site_url('UnitController/InitUpdateUnit') ?>";
        }

        if ($(this).smkValidate()) {
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                beforeSend: function() {
                    BlockUI(msg);
                }

            }).done(function(data) {
                UnblockUI();

                $.smkAlert({
                    type: data.status,
                    text: data.message
                });

                $('#unitModal').modal('hide');
                $('#dataTable').DataTable().ajax.reload(null, false);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                SmkAlert('Something went wrong, please contact IT', 'danger');
            });
        }
    });

    $(function() {
        $('#unitModal').on('hidden.bs.modal', function() {
            $('#frm-data').smkClear();
        });
    });
</script>