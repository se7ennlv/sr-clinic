<script>
    function VisitRecord() {
        $.ajax({
            url: "<?= site_url('ServiceController/VisitRecordView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function MedicinesManage() {
        $.ajax({
            url: "<?= site_url('MedicineController/index'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function DiseasesManage() {
        $.ajax({
            url: "<?= site_url('DiseaseController/index'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function UnitsManage() {
        $.ajax({
            url: "<?= site_url('UnitController/index'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function PatientsManage() {
        $.ajax({
            url: "<?= site_url('PatientController/index'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    //================================ Reprots ໍໍໍໍໍໍໍໍໍໍໍໍໍໍໍໍໍໍໍ===========================//
    function VisitDetailReport() {
        $.ajax({
            url: "<?= site_url('ReportController/VisitDetailView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function VisitReport() {
        $.ajax({
            url: "<?= site_url('ReportController/VisitView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function ShowAllMedAlerts() {
        $.ajax({
            url: "<?= site_url('ReportController/ShowAllMedAlerts'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function DeptSummaryReport() {
        $.ajax({
            url: "<?= site_url('ReportController/DeptSummaryView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }

    function GenderSummaryReport() {
        $.ajax({
            url: "<?= site_url('ReportController/GenderSummaryView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }
    function DrugSummaryByDept() {
        $.ajax({
            url: "<?= site_url('ReportController/DrugSummaryByDeptView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
    }
    function MedicineSummaryDistributed() {
        $.ajax({
            url: "<?= site_url('ReportController/DrugSummaryView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
	}
    function MonthlyReport() {
        $.ajax({
            url: "<?= site_url('ReportController/MonthlyView'); ?>",
            beforeSend: function() {
                BlockUI('Loading...');
            }
        }).done(function(data) {
            UnblockUI();
            $("#mainApp").html(data);
        });

        return false;
	}

</script>
