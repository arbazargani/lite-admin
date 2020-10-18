function areUsure(){
    swal({
        title: "مطمعن هستید؟",
        text: "در صورت تایید یوزر قابلیت سفارش در سایت خواهد داشت.",
        icon: "warning",
        buttons: ["عدم تایید", "تایید"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            swal({
                text: "یوزر با موفقیت تایید شد.",
                icon: "success",
            });
        }
        else{
            swal("یوزر تایید نشد.");
        }
    })
}