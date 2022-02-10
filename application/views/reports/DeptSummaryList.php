<table class="table table-bordered table-sm mt-5" id="dataTable" widtd="100%" cellspacing="0">
    <thead class="thead-light">
        <tr>
            <th rowspan="2" class="text-nowrap text-center align-middle">Departments</th>
            <th colspan="<?= $dates['numDays']; ?>" class="text-center">Dates</th>
            <th rowspan="2" class="text-center align-middle">Totals</th>
        </tr>
        <tr>
            <?php foreach ($dates['days'] as $date) : ?>
                <th class="text-nowrap text-center"><?= nice_date($date, 'd'); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($depts as $dept) : $deptTotal = 0; ?>
            <tr>
                <td class="text-center"><strong><?= $dept->DeptCode; ?></strong></td>
                <?php
                    $verTotal = 0;

                    foreach ($dates['days'] as $date) : ?>
                    <td class="text-nowrap text-center">
                        <?php
                                $CI = &get_instance();
                                $CI->load->model('ReportModel');
                                $verVal = $CI->ReportModel->FindCountOneDeptByDate($dept->DeptCode, $date);

                                echo $verVal;

                                $verTotal += $verVal;
                                ?>
                    </td>
                <?php endforeach; ?>

                <td class="text-center">
                    <span class="badge badge-danger"><?= $verTotal; ?></span>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <th class="text-right">Totals</th>
        <?php foreach ($dates['days'] as $date) : ?>
            <th class="text-nowrap text-center"><?= nice_date($date, 'd'); ?></th>
        <?php endforeach; ?>
        <th></th>
    </tfoot>
</table>

<script>
    $(document).ready(function() {
        $(function() {
            $('#dataTable').DataTable({
                paging: false,
                searching: false,
                bInfo: false,
                ordering: false,
                dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                    extend: 'excel',
                    className: 'btn btn-success btn-export d-none',
                    text: '<i class="fas fa-file-excel"></i> Export</i>',
                    title: 'visit_summary_by_dept'
                }],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 1;

                    while (j < nb_cols) {
                        var pageTotal = api
                            .column(j, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return Number(a) + Number(b);
                            }, 0);
                        $(api.column(j).footer()).html(pageTotal);
                        j++;
                    }
                }
            });
        });
    })

    function ExportData() {
        $('.btn-export').trigger('click');
    }
</script>