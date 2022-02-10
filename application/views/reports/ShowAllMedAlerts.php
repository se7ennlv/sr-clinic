<div class="card mb-4 py-3 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-battery-quarter"></i> <strong>Low stock items</strong></h5>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">Code</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap text-center">Stock</th>
                        <th class="text-nowrap text-center">Unit</th>
                        <th class="text-nowrap text-center">Low Stock Alerts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mds as $md) :
                        $textColor = '';
                        ($md->Stock == $md->QtyAlert) ? $textColor = 'text-warning' : $textColor = 'text-danger';
                        ?>
                        <tr>
                            <td class="text-center"><?= $md->Code; ?></td>
                            <td><?= $md->Name; ?></td>
                            <td class="text-center <?= $textColor; ?>"><?= $md->Stock; ?></td>
                            <td class="text-center"><?= $md->Unit; ?></td>
                            <td class="text-center text-primary"><?= $md->QtyAlert; ?></td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(
            {
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
                title: 'low-stock-items-report'
            }]
        });
    });
</script>