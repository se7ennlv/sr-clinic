function SwalAlert(type, msg) {
    Swal.fire({
        type: type,
        title: '',
        text: msg
    });
}

function SmkAlert(msg, type) {
    $.smkAlert({
        text: msg,
        type: type
    });
}

function BlockUI(msg) {
    $.blockUI({
        message: '<h3><i class="fas fa-spinner fa-spin fa-1x"></i> ' + msg + '</h3>'
    });
}

function UnblockUI() {
    $.unblockUI();
}