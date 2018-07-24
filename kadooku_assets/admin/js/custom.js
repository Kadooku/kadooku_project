/*
-----------
GLOBAL
-----------
*/
var base_url = $('#base_url').val();
var path = window.location.pathname;
var host = window.location.hostname;


/* 
--------
Document Fungsi
--------
*/
$(document).ready(function() {
// timeout notif
//  angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    setTimeout(function(){$(".notif").fadeIn('slow');}, 300);
//  angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function(){$(".notif").fadeOut('slow');}, 3000);

// tinymce
    initTinymce('#text-area');
    initTinymce('#textarea');

//page category
$(this).on("click", "#add_category", function(){
    var $id   = $(this).data("id");
    var $name = $(this).data("name");

    console.log($id + " dan "+ $name);
});

// Admin Transaksi
$('#select_status').on('change', function() {
    if(this.value === "sent") $('#tracking_number').show();
    else $('#tracking_number').hide();
});

if($("#select_status").find('option:selected').val() === "sent") $('#tracking_number').show();
else $('#tracking_number').hide();


// Fungsi Datatable
if(path.search('category') > 0){ 
    $("#category").DataTable({
        "ordering": false
    });
}


    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
  
    /* PRODUCT */
    var t = $("#ProductTable").dataTable({
        initComplete: function() {
            var api = this.api();
            $('#ProductTable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                            api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "product/get_json", "type": "POST"},
        columns: [
            {
                "data": "id",
                "orderable": false
            },
            {
                "data": "product_name",
                "orderable": true
            },
            {
                "data": "product_price",
                "orderable": true
            },
            {
                "data": "product_amount",
                "orderable": false
            },
            {
                "data": "action",
                "orderable": false
            }
        ],
        order: [[1, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    /* TRANSACTION */
    var t =$('#TransactionTable').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "transaction/ajax_list",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],
 
    });

    /* CUSTOMER */
    var t =$('#CustomerTable').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "customer/ajax_list",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],
 
    });

    /* THUMBNAIL PRODUCT */
    $("#upload-image-1").change(function () {
        showThumbnail(this, '#thumbnail-1');
    });
    $("#upload-image-2").change(function () {
        showThumbnail(this, '#thumbnail-2');
    });
    $("#upload-image-3").change(function () {
        showThumbnail(this, '#thumbnail-3');
    });

    $(this).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
});

// $.ajax({
//     method : 'post',
//     url : base_url+'adm_kadooku/product/category_json',
//     data:{parent_id:0, parent: true},
//     success: function(res){
//         var output = "";
//         for (var i in res.categories){
//             var category = res.categories[i];
//             output += "<option value='"+category.id+"'>"+category.category_name+"</option>";
//         }
//         $( "#category" ).append( output );
//     }
// });
    
// $(document).on("change","#category", function(){
//     var value=$(this).val();
//     if(value>0){
//         $.ajax({
//             method : 'post',
//             url : base_url+'adm_kadooku/product/category_json',
//             data:{parent_id:value},
//             success: function(res){
//                 var output = "";
                
//                     output += '<div class="col-md-4"><div class="form-group"><label for="category">Sub Kategori</label><select id="category" name="category_id" class="form-control">';
//                     for (var i in res.categories){
//                         var category = res.categories[i];
//                         output += "<option value='"+category.id+"'>"+category.category_name+"</option>";
//                     }
//                     output += "</select></div></div>";
//                 if(res.parent == true)
//                      $( "#list-category" ).empty();

//                 $( "#list-category" ).append( output );
//             }
//         })
//     }
//     });

// fungsi sweetalert delete data
$(document).on("click","#product-delete", function(e){
    e.preventDefault();
    var id=$(this).attr("data-id");
    var abc = path+"/delete/"+id;

    swal({
        title: "Apakah kamu yakin akan menghapus ini?",
        text: "Data yang dihapus tidak dapat dikembalikan lagi",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Product berhasil dihapus", {
                    icon: "success",
                });
                setTimeout(function(){ window.location.href = abc; }, 1000);
            }else{
                swal("Dibatalkan", "Produk dibatalkan untuk dihapus", "info");
            }
    });
});

$(document).on("click","#category-delete", function(e){
    e.preventDefault();
    var id=$(this).attr("data-id");
    var abc = path+"/delete/"+id;

    swal({
        title: "Apakah kamu yakin akan menghapus ini?",
        text: "Data yang dihapus tidak dapat dikembalikan lagi",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Kategori berhasil dihapus", {
                    icon: "success",
                });
                setTimeout(function(){ window.location.href = abc; }, 1000);
            }else{
                swal("Dibatalkan", "Kategori dibatalkan untuk dihapus", "info");
            }
    });
});


function initTinymce(e){
    tinymce.init({
        selector: e,
        menubar: false,
        plugins: [
            "advlist autolink link lists charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        toolbar1: "undo redo |  formatselect | bold italic forecolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        image_advtab: true ,
    });
}

function showThumbnail(files, thumb) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $(thumb).empty();
        $(thumb).append('<img class="img-responsive img-rounded img-thumbnail" width="180" height="240" src="'+e.target.result+'"/>');
    }
    reader.readAsDataURL(files.files[0]);
}
  