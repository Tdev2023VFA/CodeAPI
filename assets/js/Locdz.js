function DeleteFavorite(id) {
    Swal.fire({
        title: 'Xác Nhận Xóa',
        text: "Bạn có đồng ý xóa yêu thích code này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa ngay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "assets/ajaxs/Auth.php",
                method: "POST",
                data: {
                    type:"Defavorite",
                    id: id
                },
                success: function(response) {
                    $("#thongbao").html(response);
                   
                }
            });
        } 
    })
};
function PaymentVps(id) {
    Swal.fire({
        title: 'Xác Nhận Thanh Toán',
        text: "Bạn có đồng ý mua Vps này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Mua ngay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "assets/ajaxs/Vps.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#thongbao").html(response);
                   
                }
            });
        } 
    })
};
$(document).ready(function(){
	$(window).scroll(function(){
		if($(this).scrollTop())
		{
			$('#backtop').fadeIn();
		}
		else
		{
			$('#backtop').fadeOut();
		}
	});
});
 $('#backtop').click(function(){
 	$('html').animate({
 		scrollTop:0
 	},100);
 });
 var loader = document.getElementById("loadingpage");
 window.addEventListener("load", function() {
     loader.style.display = "none";
 })