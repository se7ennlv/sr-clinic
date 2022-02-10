<div class="card mb-4 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fa fa-th-list"></i> <strong>Visit Records List</strong></h5>
        <hr>
        <form class="form-inline" action="#" autocomplete="off" method="POST">
            <div class="form-group">
                <select name="isAll" id="isAll" class="form-control">
                    <option value="0">all</option>
                    <option value="1">not sick laeve</option>
                    <option value="2">take sick leave</option>
                    <option value="3">observe at clinic</option>
                </select>
            </div>
            <div class="input-group ml-1 mr-1">
                <input type="text" name="fromDate" id="fromDate" class="form-control date-picker" readonly>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i></span>
                </div>
                <input type="text" name="toDate" id="toDate" class="form-control date-picker" readonly>
            </div>
            <button type="button" class="btn btn-info" onclick="GetVisitList();"><i class="fas fa-sync-alt"></i> Show Data</button>
            <i class="fas fa-grip-lines-vertical fa-2x ml-1 mr-1"></i>
            <button type="button" class="btn btn-warning" onclick="VisitRecord();"><i class="fas fa-user-plus"></i> New Record Visit</button>
            <i class="fas fa-grip-lines-vertical fa-2x ml-1 mr-1"></i>
            <button type="button" class="btn btn-success" onclick="ExportData();"><i class="fas fa-file-excel"></i> Export</i></button>
        </form>
        <hr>
        <div class="table-responsive overflow-auto" id="dynamicData" style="max-height: 557px;">
            <!-- dynamic -->
        </div>

    </div>
</div>



<script>
    $(document).ready(function() {
        $(function() {
            var currDate = moment().format("YYYY-MM-DD");

            $('#toDate').val(currDate);
            $('#fromDate').val(currDate);

            GetVisitList();
        });

        $(function() {
            $('.date-picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })
        });
    });

    function GetVisitList() {
        var formData = $('form').serialize();

        $.ajax({
            type: 'POST',
            url: "<?= site_url('ReportController/FetchAllVisit') ?>",
            data: formData,
            beforeSend: function() {
                BlockUI('Processing...');
            }
        }).done(function(data) {
            UnblockUI();

            $('#dynamicData').html(data);
        });

        return false;
    }
</script>