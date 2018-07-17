/**
 * Kumpulan deklarasi variabel 
 */
var base_url = $('#base_url').val();
var path     = window.location.pathname;
var host     = window.location.hostname;


// Fungsi eksternal website
$(document).ready(function(){
    // timeout notif
//  angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    setTimeout(function(){$(".notif").fadeIn('slow');}, 300);
//  angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function(){$(".notif").fadeOut('slow');}, 5000);
    
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    var birthday = $('#datepicker').val();
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        maxDate: today,
        format: 'dd mmmm yyyy',
        value: birthday
    });

    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);


    $('.no-open-lmao').collapse({
    toggle: false
    })

    $(".selection-1").select2({
        dropdownParent: $('#dropDownSelect1')
    });
    
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
    

    $(".selection-3").select2({
        dropdownParent: $('#dropDownSelect2')
    });
    
    $(".selection-address").select2({
        dropdownParent: $('.bd-address-modal-lg')
    });

    $('#address-datatable').DataTable({
        "ordering": false,
        "bInfo" : false,
        "bLengthChange": false,
        "searching" : false
    });

    // Radio box border
    $('.method').on('click', function() {
        $('.method').removeClass('blue-border');
        $(this).addClass('blue-border');
    });


    // Fungsi select sort urutkan
    var cat   = getUrlParameter('category') ? "category="+getUrlParameter('category') : "";
    var q     = getUrlParameter('q') ? "&q="+getUrlParameter('q') : "";
    var min   = getUrlParameter('minPrice') ? "&minPrice="+getUrlParameter('minPrice') : "";
    var max   = getUrlParameter('maxPrice') ? "&maxPrice="+getUrlParameter('maxPrice') : "";
    $('.selection-2').on('change', function() {
        window.location.href = base_url+"product?"+cat+max+min+q+"&sort="+this.value;
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


/**
 * Kumpulan Fungsi - Fungsi Utama Website
 */
// fungsi untuk mengkonversi nilai float/integer ke format rupiah
function convertToRupiah(angka)
{
    var rupiah = '';		
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}

// fungsi untuk mengambil paramater url
function getUrlParameter(sParam) {
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
}

// fungsi untuk check data
function checkMore(pages){
    $.ajax({
        type: "GET",
        cache: false,
        url: base_url+pages,
        success: function(data)
        {
            if(data.next_page === null){
                return true;
            }
        }
    });
}

// fungsi untuk meload/mengambil data
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
        },
        complete: function(){
            $('#loading-image').hide();
        }
    });
}

// fungsi untuk set produk pada tag html
function setProduct(data, pages){
    var output = "";
    
    if(data.result.length > 0){
        for (var i in data.result)
        {
            var cart = $('#cart').val();
            var row  = data.result[i];
            var d    = (new Date()).toISOString().substring(0, 10);
            var label, price, newprice;
                if(row.product_amount > 0){
                    if((row.discount != 0) && (d >= row.start_discount) && (d <= row.end_discount)){
                            var dis      = Math.round((row.discount/100) * row.product_price);
                            label    = 'block2-labelsale';
                            price    = '<span class="block2-oldprice m-text7 p-r-5">'+convertToRupiah(parseInt(row.product_price))+'</span><span class="block2-newprice m-text8 p-r-5"><b>'+convertToRupiah(row.product_price - dis)+'</b></span>';
                            newprice = row.product_price - dis;
                    }else{
                        label    = '';
                        price    = '<span class="block2-price m-text6 p-r-5">'+convertToRupiah(parseInt(row.product_price))+'</span>';
                        newprice = row.product_price;
                    }
                    var divs    = (pages == 'product') ? "col-sm-12 col-md-6 col-lg-4 p-b-50" : "col-sm-6 col-md-4 col-lg-3 p-b-50";
                    var img     = jQuery.parseJSON(row.product_image);
                    var img_url = base_url+"kadooku_uploads/product/img/"+img[0];
                    var title   = (row.product_name.length > 20) ? row.product_name.substring(0,20)+' ...' : row.product_name;
                    var p_img   = "<a href='"+base_url+"product_detail/"+row.product_url+"'><img width='300px' height='300px' src='"+base_url+"kadooku_assets/public/images/circle.gif' data-original='"+img_url+"' class='lazy'/></a>";
                    
                    output += '<div class="'+divs+' animated zoomIn">';
                    output += '    <div class="block2" style="border:2px solid #F5F5F5;background-color:#fff;">';
                    output += '        <div class="block2-img wrap-pic-w of-hidden pos-relative '+label+'">';
                    output += p_img;
                    output += '            <a href="'+base_url+'product_detail/'+row.product_url+'" class="block2-overlay trans-0-4">';                
                    output += '            </a>';
                    output += '        </div>';
                    output += '        <div class="block2-txt p-t-20 p-l-10 p-r-20 p-b-20">';
                    output += '            <a href="'+base_url+'product_detail/'+row.product_url+'" class="block2-name dis-block s-text3 p-b-10"><b>'+title+'</b></a>';
                    output += price;
                    output += '        <button class="add_to_cart flex-c-m size4 m-l-5 m-t-10 bg0 bo-rad-23 hov4 s-text1 trans-0-4" data-id="'+row.id+'" data-name="'+row.product_name+'" data-price="'+newprice+'">';
                    output += cart+'</button>';
                    output += '</div></div></div>';
                }
        }
    }
    else{
        if(pages != 'product'){
            $("#btn-more").hide();
            output += '<div class="col-md-12"><div class="sec-title p-b-22"><div class="s-text5 t-center">Data belum ada, mohon untuk muat ulang.</div></div></div>';
        }
    }
    
    return output;
}
function Timer(duration, display) 
{
    var timer = duration, hours, minutes, seconds;
    setInterval(function () {
        hours = parseInt((timer /3600)%24, 10)
        minutes = parseInt((timer / 60)%60, 10)
        seconds = parseInt(timer % 60, 10);

				hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(hours +":"+minutes + ":" + seconds);

				--timer;
    }, 1000);
}
jQuery(function ($) 
{
    var twentyFourHours = $('#countdown').data('time');
    var display = $('#countdown');
    Timer(twentyFourHours, display);
});

function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}


// fungsi internal website
$(document).ready(function () {
    if(path.search('product') > 0){
        // Fungsi untuk mengambil list all product
        $('#loading-image').show();
        $('#list-product').empty();
        var cat   = getUrlParameter('category') ? "&category="+getUrlParameter('category') : "";
        var q     = getUrlParameter('q') ? "&q="+getUrlParameter('q') : "";
        var min   = getUrlParameter('minPrice') ? "&minPrice="+getUrlParameter('minPrice') : "";
        var max   = getUrlParameter('maxPrice') ? "&maxPrice="+getUrlParameter('maxPrice') : "";
        var sort  = getUrlParameter('sort') ? "&sort="+getUrlParameter('sort') : "";
        var pages = 1;
        loadMoreData("product/getList?"+cat+max+min+q+sort, 'product');
        
        $(window).endlessScroll({
            pagesToKeep: 5,
            fireDelay: 10,
            insertAfter: "#list-product div:last",
            loader: '<div class="ajax-load text-center" style="display:none"></div>',
            content: function(i) {
                i=i+1;
                loadMoreData("product/getList?page="+i+cat+max+min+q+sort, 'product');
            },
            ceaseFire: function(i) {
                if(checkMore("product/getList?page="+i+cat+max+min+q+sort) === 1){
                    return true;
                }else{
                    return false;
                }
            }
        });
    }else{
        // Fungsi untuk mengambil list all product
        $('#loading-image').show();
        $('#list-product').empty();
        loadMoreData("product/getJson");        
    }

    // fungsi payment
function get_cost(id){
    var subtotal = $('#subtotal-py').val();
    $.ajax({
        method : 'post',
        url : base_url+'cart/json/getAddress',
        data:{address_id:id},
        success: function(res){
            
            var row   = res.data[0];
            var cost  = row != null ? parseInt(row.reg) : 20000;
            var total = parseInt(subtotal) + cost;

            $("#shipping-cost").fadeOut("fast", function(){
                $(this).empty();
            });
            $("#shipping-cost").fadeIn("fast", function(){
                $(this).append(convertToRupiah(cost));
            });

            $("#total-payment").fadeOut("fast", function(){
                $(this).empty();
            });
            $("#total-payment").fadeIn("fast", function(){
                $(this).append(convertToRupiah(total));
            });
            $("#totalpayment").val(total);
        }
    });
}
        // get cost without select new address
        var address_id = $("#address_id").val();
        get_cost(address_id);

        $("#address_id").on("change", function(){
            get_cost(this.value);
        });
        if($('input:radio[id=old_address]').is(':checked')) {
            $("#old-address").show();
            $("#new-address").hide();
        }

        if($('input:radio[id=new_address]').is(':checked')) {
            $("#old-address").hide();
            $("#new-address").show();
        }

        $('#old_address').click(function() {
            $("#old-address").show();
            $("#new-address").hide();
            // get cost without select new address
            var address_id = $("#address_id option:selected").val();
            get_cost(address_id);
        });
        $('#new_address').click(function() {
            $("#new-address").show();
            $("#old-address").hide();
        });


    // inisialisasi Provinsi
    $.ajax({
        method : 'GET',
        url : base_url+'cart/json/getProvinces',
        success: function(res){
            var output = "";
            for (var i in res.data){
                var row = res.data[i];
                output += "<option value='"+row.id+"'>"+row.name+"</option>";
            }
            $( "#provinces" ).append( output );
        }
    });

    $('#provinces').on('change', function() {
        var value = $('#provinces').val();
        if(value>0){
            $.ajax({
                method : 'post',
                url : base_url+'cart/json/getRegencies',
                data:{province_id:value, type:'regencies'},
                success: function(res){
                    var output = "";
                        output += '<option value="0">Silahkan pilih kota/kabupaten anda</option>';
                        for (var i in res.data){
                            var row = res.data[i];
                            output += "<option value='"+row.id+"'>"+row.name+"</option>";
                        }
                    $( "#regencies" ).empty().append( output );
                }
            })
        }
    });

    $('#regencies').on('change', function() {
        var value = $('#regencies').val();
        if(value>0){
            $.ajax({
                method : 'post',
                url : base_url+'cart/json/getDistricts',
                data:{regency_id:value, type:'districts'},
                success: function(res){
                    var output = "";
                        output += '<option value="0">Silahkan pilih kecamatan anda</option>';
                        for (var i in res.data){
                            var row = res.data[i];
                            output += "<option value='"+row.id+"'>"+row.name+"</option>";
                        }
                    $( "#districts" ).empty().append( output );
                }
            })
        }
    });

    $('#districts').on('change', function() {
        var value = $('#districts').val();
        if(value>0){
            $.ajax({
                method : 'post',
                url : base_url+'cart/json/getVillages',
                data:{district_id:value, type:'villages'},
                success: function(res){
                    var output = "";
                        output += '<option value="0">Silahkan pilih kelurahan/desa anda</option>';
                        for (var i in res.data){
                            var row = res.data[i];
                            output += "<option value='"+row.id+"'>"+row.name+"</option>";
                        }
                    $( "#villages" ).empty().append( output );
                }
            })
        }
    });

    // $('#villages').on('change', function() {
    //     var output = "";
    //         output += '<option value="0">Silahkan pilih kurir anda</option>';
    //         output += "<option value='reg'>Regular</option>";
    //         output += "<option value='oke'>Oke</option>";
    //         output += "<option value='yes'>Yes</option>";
    //     $( "#getLogistics" ).empty().append( output );

    // });

    $('#villages').on('change', function() {
        var subtotal = $('#subtotal-py').val();
        var regency  = $('#regencies option:selected').text();
        var district = $('#districts option:selected').text();
        //var $type    = $('#getLogistics option:selected').val();

        $.ajax({
            method : 'post',
            url : base_url+'cart/json/getLogistics',
            data:{district:district, regency:regency},
            success: function(res){
                var row = res.data[0];
                var cost = parseInt(row.reg) > 0 ? parseInt(row.reg) : 20000;
                var total = parseInt(subtotal) + cost;

                $("#shipping-cost").fadeOut("fast", function(){
                    $(this).empty();
                });
                $("#shipping-cost").fadeIn("fast", function(){
                    $(this).append(convertToRupiah(cost));
                });

                $("#total-payment").fadeOut("fast", function(){
                    $(this).empty();
                });
                $("#total-payment").fadeIn("fast", function(){
                    $(this).append(convertToRupiah(total));
                });
                $("#totalpayment").val(total);
            }
        })
    });

    // Fungsi Edit Address
    $(this).on("click", "#add-address", function(){
        $('.bd-address-modal-lg').modal('show');
        $('.bd-address-modal-lg #form-address').attr('action',base_url+'user/address/add');
        $( "#inputName" ).val("");
        $( "#inputPhone" ).val("");
        $( "#inputAddress" ).val("");

        $('#provinces').prop('selectedIndex',0).prepend("<option value='' selected='selected'>Silahkan pilih provinsi anda</option>");
        $('#districts').prop('selectedIndex',0).prepend("<option value='' selected='selected'>Silahkan pilih kecamatan anda</option>");
        $('#regencies').prop('selectedIndex',0).prepend("<option value='' selected='selected'>Silahkan pilih kota/kabupaten anda</option>");
        $('#villages').prop('selectedIndex',0).prepend("<option value='' selected='selected'>Silahkan pilih kelurahan/desa anda</option>");
    });

    $(this).on("click", "#delete-address", function(){
        var id      = $(this).data("id");
        var user_id = $(this).data("user");
        var geo     = $(this).data("geo");
        
        swal({
            title:"Hapus Alamat "+geo,
            text:"Yakin akan menghapus alamat ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url : base_url+"user/address/remove_address",
                        method : "POST",
                        data : {id: id, user_id:user_id},
                        success: function(res){
                            var data = jQuery.parseJSON(res);
                            if(data.status == true){
                                // hapus row address
                                $("tr[data-id='"+id+"']").fadeOut("fast",function(){
                                    $(this).remove();
                                });
                                swal(geo, data.message, "success");
                            }else{
                                swal(geo, data.message, "error");
                            }                
                        }
                    });
                } else {
                    swal(geo, "Alamat dibatalkan untuk dihapus", "error");
                }       
            });
    });

    $(this).on("click", "#set", function(){
        var id      = $(this).data("rowid");
        var user_id = $(this).data("user");
        var geo     = $(this).data("geo");
        var temp_id = $("#temp_id").val();
        // console.log(temp_id);
        $.ajax({
            url : base_url+"user/address/set_primary",
            method : "POST",
            data : {id: id, user_id:user_id},
            success: function(res){
                var data = jQuery.parseJSON(res);
                if(data.status == true){
                    // hapus row address
                    $("#badges").fadeOut("fast",function(){
                        $(this).remove();
                    });
                    
                    $("td[data-id='name-"+id).fadeIn('fast', function(){
                        $(this).append('<span id="badges" class="badge badge-pill badge-success">Utama</span>');
                    });

                    $("#temp_id").val(id);

                    $("button[data-rowid="+id+"]").prop('disabled', true);

                    $("button[data-rowid="+temp_id+"]").removeAttr('disabled');
                    // swal(name, data.message, "success");
                }else{
                    swal(name, data.message, "error");
                }                
            }
        });
    });

    $(this).on("click", "#edit-address", function(){
        $('.bd-address-modal-lg').modal('show');

        var id   = $(this).data("id");
        var user = $(this).data("user");

        $.when(
            $.ajax({
                method : 'POST',
                url : base_url+'user/json/getAddressById',
                data: {address_id:id, user_id:user}
            })
        ).done(function(res){
            var province_id = res.data[0].province_id;
            var regency_id  = res.data[0].regency_id;
            var district_id = res.data[0].district_id;
            var village_id  = res.data[0].village_id;

            $('.bd-address-modal-lg #form-address').attr('action',base_url+'user/address/update/'+id);
            $('.bd-address-modal-lg #form-address').append('<input type="hidden" value="'+id+'" name="id">');
            $( "#inputName" ).val( res.data[0].name );
            $( "#inputPhone" ).val( res.data[0].phone );
            $( "#inputAddress" ).val( res.data[0].address );
            

            $.when(
                $.ajax({
                    method : 'GET',
                    url : base_url+'user/json/getProvinces'
                }),
                $.ajax({
                    method : 'post',
                    url : base_url+'user/json/getRegencies',
                    data:{province_id:province_id, type:'regencies'}
                }),
                $.ajax({
                    method : 'post',
                    url : base_url+'user/json/getDistricts',
                    data:{regency_id:regency_id, type:'districts'}
                }),
                $.ajax({
                    method : 'post',
                    url : base_url+'user/json/getVillages',
                    data:{district_id:district_id, type:'villages'}
                })
            ).done(function(province, regency, district, village){
                var provinces = "";
                var regencies = "";
                var districts = "";
                var villages = "";

                    for (var i in province[0].data){
                        var row = province[0].data[i];
                        var selected = (row.id == province_id) ? 'selected' : '';
                        provinces += "<option value='"+row.id+"' "+selected+">"+row.name+"</option>";
                    }
                    for (var i in regency[0].data){
                        var row = regency[0].data[i];
                        var selected = (row.id == regency_id) ? 'selected' : '';
                        regencies += "<option value='"+row.id+"' "+selected+">"+row.name+"</option>";
                    }
                    for (var i in district[0].data){
                        var row = district[0].data[i];
                        var selected = (row.id == district_id) ? 'selected' : '';
                        districts += "<option value='"+row.id+"' "+selected+">"+row.name+"</option>";
                    }
                    for (var i in village[0].data){
                        var row = village[0].data[i];
                        var selected = (row.id == village_id) ? 'selected' : '';
                        villages += "<option value='"+row.id+"' "+selected+">"+row.name+"</option>";
                    }
                
                    $( "#provinces" ).empty().append( provinces );
                    $( "#regencies" ).empty().append( regencies );
                    $( "#districts" ).empty().append( districts );
                    $( "#villages" ).empty().append( villages );
            });
        });        
    });

    // fungsi add product
    $(this).on("click", ".add_to_cart", function(){
        var product_id    = $(this).data("id");
        var product_name  = $(this).data("name");
        var product_price = $(this).data("price");
        var quantity      = $('#quantity').val() ? $('#quantity').val() : 1;
        $.ajax({
            url : base_url+"cart/add_to_cart",
            method : "POST",
            data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity},
            success: function(res){
                var data = jQuery.parseJSON(res);
                if(data.status == true){
                    swal(product_name, "berhasil ditambahkan ke keranjang !", "success");
                    // update cart header
                    $(".header-icons-noti").fadeOut("fast", function(){
                        $(this).empty();
                    });
                    $(".header-icons-noti").fadeIn("fast", function(){
                        $(this).append(data.total_item);
                    });
                }else{
                    swal(product_name, data.message, "error");
                }                
            }
        });
    });

    // fungsi update qty product
    $(this).on("click", "#count-product", function(){
        var product_id    = $(this).data("id");
        var quantity      = $('#numproduct-'+product_id).val();
        
        $.ajax({
            url : base_url+"cart/update_cart",
            method : "POST",
            data : {product_id: product_id, quantity: quantity},
            success: function(res){
                var data = jQuery.parseJSON(res);
                if(data.status == true){
                    // update cart header
                    $(".header-icons-noti").fadeOut("fast", function(){
                        $(this).empty();
                    });
                    $(".header-icons-noti").fadeIn("fast", function(){
                        $(this).append(data.total_item);
                    });

                    // update total cart
                    $("#total-cart").fadeOut("fast", function(){
                        $(this).empty();
                    });
                    $("#total-cart").fadeIn("fast", function(){
                        $(this).append(data.total);
                    });

                    // update sub total item
                    $("#sub-total-"+product_id).fadeOut("fast", function(){
                        $(this).empty();
                    });
                    $("#sub-total-"+product_id).fadeIn("fast", function(){
                        $(this).append(data.subtotal);
                    });
                } else{
                    swal("Gagal", data.message, "error");
                    $('#numproduct-'+product_id).val(quantity-1);
                }             
            }
        });
    });

    // fungsi hapus product
    $(this).on("click", "#hapus-cart", function(){
        var product_id = $(this).data("id");
        var name       = $(this).data("name");
        
        swal({
            title:"Hapus Item "+name,
            text:"Yakin akan menghapus item ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url : base_url+"cart/remove_cart",
                        method : "POST",
                        data : {product_id: product_id},
                        success: function(res){
                            var data = jQuery.parseJSON(res);
                            if(data.status == true){
                                // update cart header
                                $(".header-icons-noti").fadeOut("fast", function(){
                                    $(this).empty();
                                });
                                $(".header-icons-noti").fadeIn("fast", function(){
                                    $(this).append(data.total_item);
                                });
                                
                                // update total cart
                                $("#total-cart").fadeOut("fast", function(){
                                    $(this).empty();
                                });
                                $("#total-cart").fadeIn("fast", function(){
                                    $(this).append(data.total);
                                });
            
                                // hapus row product
                                $("tr[data-id='"+product_id+"']").fadeOut("fast",function(){
                                    $(this).remove();
                                });
                                swal(name, "Item berhasil dihapus", "success");
                            }else{
                                swal(name, "Item gagal dihapus", "error");
                            }                
                        }
                    });
                } else {
                    swal(name, "Item tidak dihapus", "error");
                }       
            });
        
    });
});
