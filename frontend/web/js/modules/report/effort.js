function showMsg(msg, isSuccess, timeOut) {    
    if(isSuccess) {
        toastr.success(msg,'',{
            "positionClass": "toast-top-center",
            timeOut: timeOut,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        });
    } else {
        toastr.error(msg,'',{
            "positionClass": "toast-top-full-width",
            timeOut: timeOut,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        });
    }
};

function confirmRemove(title, process) {
    swal({
            title: "WARNING REMOVE " + title,
            text: "Are you sure to remove it ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, remove it !!",
            closeOnConfirm: true
        },
        function(){
            process.remove();
        }
    );
};
