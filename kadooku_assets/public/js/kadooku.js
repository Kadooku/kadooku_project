/**
 * Kumpulan deklarasi variabel 
 */
var base_url = $('#base_url').val();
var path = window.location.pathname;


// fungsi untuk mengkonversi nilai float/integer ke format rupiah
function convertToRupiah(angka)
{
    var rupiah = '';		
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}


// Fungsi eksternal website
$(document).ready(function(){
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
    
    $('#btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });
    
    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
});
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

/**
 * Kumpulan Fungsi - Fungsi Utama Website
 */
function checkMore(pages){
    $.ajax({
        type: "GET",
        cache: false,
        url: base_url+pages,
        success: function(data)
        {
            if(data.next_page == null){
                return true;
            }
        }
    });
}
function loadMoreData(pages, p){
    $.ajax({
        type: "GET",
        cache: false,
        url: base_url+pages,
        beforeSend: function()
	            {
	                $('.ajax-load').show();
	            },
        success: function(data)
        {
            var output = "";
            if(data.message == 'fail'){
                $('.ajax-load').html("");
                return;
            }            
            else if(data.message == 'success'){
                output = setProduct(data, p);
            }
            
            $( "#list-product" ).append( output );
            $('.ajax-load').hide();

            $("img.lazy").lazyload({
                effect:"fadeIn",
                threshold : 400
            });

            /* PAGINATION */
            // var pagination = '';
            // var paging = data.total_page;
            // hal_aktif = getUrlParameter('page');
            // if( (!hal_aktif) && ($('div#pagination-product a').length == 0) ){
            //     $('div#pagination-product a').remove();
            //     for(i = 1; i <= paging ; i++){
            //         pagination = pagination + '<a href="?page='+i+'" class="item-pagination flex-c-m trans-0-4">'+i+'</a>';
            //     }
            //     console.log(pagination);
            // }
            // else if(hal_aktif){
            //     $('div#pagination-product a').remove();
            //     for (i = 1; i <= paging ; i++) {
            //       pagination = pagination + '<a href="?page='+i+'" class="item-pagination flex-c-m trans-0-4">'+i+'</a>';
            //     }
            // }
            // $('div#pagination-product').append(pagination);
            // $('div#pagination-product a:contains("'+hal_aktif+'")').addClass('active-pagination');
        },
        complete: function(){
            $('#loading-image').hide();
        }
    });
}
function setProduct(data, pages){
    var output = "";
    for (var i in data.result)
    {
        var cart   = $('#cart').val();
        var row    = data.result[i];
        var d = (new Date()).toISOString().substring(0, 10);
        if((row.discount != 0) && (d >= row.start_discount) && (d <= row.end_discount)){
                var dis = Math.round((row.discount/100) * row.product_price);
                var label = 'block2-labelsale';
                var price = '<span class="block2-oldprice m-text7 p-r-5">'+convertToRupiah(parseInt(row.product_price))+'</span><span class="block2-newprice m-text8 p-r-5"><b>'+convertToRupiah(row.product_price - dis)+'</b></span>';
        }else{
            var label = '';
            var price = '<span class="block2-price m-text6 p-r-5">'+convertToRupiah(parseInt(row.product_price))+'</span>';
        }
        var divs = (pages == 'product') ? "col-sm-12 col-md-6 col-lg-4 p-b-50" : "col-sm-6 col-md-4 col-lg-3 p-b-50";
        var img     = jQuery.parseJSON(row.product_image);
        var img_url = base_url+"kadooku_uploads/product/img/"+img[0];
        var p_img   = "<a href='"+base_url+"product_detail/"+row.product_url+"'><img width='300px' height='300px' src='"+base_url+"kadooku_assets/public/images/circle.gif' data-original='"+img_url+"' class='lazy'/></a>";
        
        output += '<div class="'+divs+'">';
        output += '    <div class="block2">';
        output += '        <div class="block2-img wrap-pic-w of-hidden pos-relative '+label+'">';
        output += p_img;
        output += '            <a href="'+base_url+'product_detail/'+row.product_url+'" class="block2-overlay trans-0-4">';                
        output += '            </a>';
        output += '                <div class="block2-btn-addcart w-size1 trans-0-4">';
        output += '                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">'+cart+'</button>';
        output += '                </div>';
        output += '        </div>';
        output += '        <div class="block2-txt p-t-20">';
        output += '            <a href="'+base_url+'product_detail/'+row.product_url+'" class="block2-name dis-block s-text3 p-b-5">'+row.product_name+'</a>';
        output += price;
        output += '        </div></div></div>';
    }
    
    return output;
}
$(document).ready(function () {
    if(path.search('product') > 0){
        // Fungsi untuk mengambil list all product
        $('#loading-image').show();
        $('#list-product').empty();
        // var pages = getUrlParameter('page') ? "product/get_list?page="+getUrlParameter('page') : "product/get_list";
        var pages = 1;
        loadMoreData("product/get_list", 'product');
        
        $(window).endlessScroll({
            pagesToKeep: 5,
            fireDelay: 10,
            insertAfter: "#list-product div:last",
            loader: '<div class="ajax-load text-center" style="display:none"></div>',
            content: function(i) {
                i=i+1;
                console.log(i);
                loadMoreData("product/get_list?page="+i, 'product');
            },
            ceaseFire: function(i) {
                if(checkMore("product/get_list?page="+i)){
                    return true;
                }
            }
        });
    }else{
        // Fungsi untuk mengambil list all product
        $('#loading-image').show();
        $('#list-product').empty();
        loadMoreData("product/get");        
    }

});