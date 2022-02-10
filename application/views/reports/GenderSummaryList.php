<table class="table table-bordered table-sm mt-5" id="dataTable" widtd="100%" cellspacing="0">
    <thead class="thead-light">
        <tr>
            <th rowspan="2" class="text-nowrap text-center align-middle">Genders</th>
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
        <tr>
            <td class="text-center"><strong>Male</strong></td>
            <?php
            $verMTotal = 0;

            foreach ($dates['days'] as $date) : ?>
                <td class="text-nowrap text-center">
                    <?php
                        $CI = &get_instance();
                        $CI->load->model('ReportModel');
                        $verMVal = $CI->ReportModel->FindCountOneGenderByDate('M', $date);

                        echo $verMVal;

                        $verMTotal += $verMVal;
                        ?>
                </td>
            <?php endforeach; ?>

            <td class="text-center">
                <span class="badge badge-danger"><?= $verMTotal; ?></span>
            </td>
        </tr>
        <tr>
            <td class="text-center"><strong>Female</strong></td>
            <?php
            $verFTotal = 0;

            foreach ($dates['days'] as $date) : ?>
                <td class="text-nowrap text-center sum">
                    <?php
                        $CI = &get_instance();
                        $CI->load->model('ReportModel');
                        $verMVal = $CI->ReportModel->FindCountOneGenderByDate('F', $date);

                        echo $verMVal;

                        $verFTotal += $verMVal;
                        ?>
                </td>
            <?php endforeach; ?>

            <td class="text-center">
                <span class="badge badge-danger"><?= $verFTotal; ?></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <th class="text-right">Totals</th>
        <?php foreach ($dates['days'] as $date) : ?>
            <th class="text-nowrap text-center"></th>
        <?php endforeach; ?>
        <th>50</th>
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
                    title: 'visit_summary_by_gender'
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