<div class="card mb-4 py-3 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-cog"></i> <strong>Diseases Management</strong></h5>
        <hr>

        <button type="button" class="btn btn-primary" onclick="Add();">
            <i class="fas fa-plus-circle"></i> Add New Item
        </button>
        <i class="fas fa-grip-lines-vertical"></i>
        <button type="button" class="btn btn-success" onclick="ExportData();">
            <i class="fas fa-file-excel"></i> Export to Excel</i>
        </button>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center text-nowrap">Code</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-center text-nowrap">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="diseaseModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diseaseModal">
                    <i class="fas fa-plus-circle"></i> Add New Disease
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmData" action="#" method="POST" autocomplete="off" novalidate="off">
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="Code" id="Code" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="Name" id="Name" placeholder="Eenter name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="DID" id="DID" />
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
                url: '<?php echo site_url('DiseaseController/FetchDiseaseDataTable'); ?>'
            },
            columns: [{
                    data: "DID",
                    className: 'text-center',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'Code',
                    className: "text-center"
                },
                {
                    data: 'Name'
                },
                {
                    data: 'DID',
                    render: function(data, type, row) {
                        var btnActions = '<a href="#" class="btn btn-warning btn-xs" onclick="Update(' + data + ');" title="Edit"><i class="fas fa-edit"></i></a> ' +
                            '<a href="#" class="btn btn-danger btn-xs" title="Delete" onclick="Delete(' + data + ');"><i class="fas fa-times"></i></a>';
                        return btnActions;

                    },
                    orderable: false,
                    className: "text-center"
                }
            ],
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success d-none btn-export',
                text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
                title: 'Diseases-List'
            }]
        });
    });

    function Add() {
        events = 'add';

        $('#diseaseModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Add New Disease');
    }

    function Update(did) {
        events = 'update';

        $.ajax({
            type: "GET",
            url: "<?= site_url('DiseaseController/FetchOneDisease') ?>/" + did,
            dataType: "JSON"
        }).done(function(data) {
            $('#diseaseModal').modal('show');
            $('.modal-title').html('<i class="fas fa-edit"></i> Update Disease Info');
            $('#DID').val(data.DID);
            $('#Code').val(data.Code);
            $('#Name').val(data.Name);
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
                    url: "<?= site_url('DiseaseController/InitDeleteDisease') ?>/" + did
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
            msg = 'Saving...'
            url = "<?= site_url('DiseaseController/InitInsertDisease') ?>";
        } else {
            msg = 'Updating...';
            url = "<?= site_url('DiseaseController/InitUpdateDisease') ?>";
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

                $('#diseaseModal').modal('hide');
                $('#dataTable').DataTable().ajax.reload(null, false);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $.smkAlert({
                    text: "Something went wrong, please contact IT!",
                    type: "danger"
                });
            });
        }
    });

    $(function() {
        $('#diseaseModal').on('hidden.bs.modal', function() {
            $('#frmData').smkClear();
        });
    });

    function ExportData() {
        $('.btn-export').trigger('click');
    }
</script>