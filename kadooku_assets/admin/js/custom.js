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
// tinymce
    initTinymce('#text-area');
    initTinymce('#textarea');

// Fungsi Datatable 
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
                "orderable": false
            },
            {
                "data": "product_price",
                "orderable": false
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

    $("#upload-image-1").change(function () {
        showThumbnail(this, '#thumbnail-1');
    });
    $("#upload-image-2").change(function () {
        showThumbnail(this, '#thumbnail-2');
    });
    $("#upload-image-3").change(function () {
        showThumbnail(this, '#thumbnail-3');
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
        $(thumb).append('<img class="img-responsive img-rounded" src="'+e.target.result+'"/>');
    }
    reader.readAsDataURL(files.files[0]);
}
  