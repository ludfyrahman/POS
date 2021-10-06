
$(document).ready(function () {
    var harga = $("#harga").val();
    var jumlah = $("#jumlah").val();
    $("input[name='kg']").keyup(function(){
        var val = $(this).val();
        var setkg= parseInt(val) / 2 + ((val / 2 * 10)/100);
        var seratusg= (setkg/5) + ((setkg * 15)/100);
        $("input[name='500gr']").val(setkg);
        $("input[name='100gr']").val(seratusg);
    })
    $("#id_produk").change(function(){
        // alert();
        var val = $(this).val();
        $.ajax({
            type: "GET",
            url: BASEURL+"site/cek/"+val,
            cache: false,
            success: function(data){
                console.log(data);
                var obj = JSON.parse(data);
                if (obj != null) {
                    $("#harga").val(obj['harga'] * $("#kurs").val());
                    harga = obj['harga'] * $("#kurs").val();
                    jumlahkan();
                }
            },
            error(res){
                // $("#pesan_alert").show();
                console.log(res);
            }
        });
    });

    // filter laporan
    $("#datepicker1").change(function(){
        var val = $(this).val();
        var val2 = $("#datepicker2").val();
        
        if(val2 !=""){
            // loaddata
        }
    })
    $("#datepicker2").change(function(){
        var val = $(this).val();
        var val1 = $("#datepicker1").val();
        // console.log(val1)
        if(val1 == ""){
            alert("tanggal Pertama tidak boleh kosong");
            $("#datepicker1").focus();
        }else{
        }
    });
    $("#filter").click(function(){
        var val1 = $("#datepicker1").val();
        var val2 = $("#datepicker2").val();
        var url      = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        // console.log(url);
        window.location.href = BASEURL+"transaksi/filter/"+val1+"/"+val2+"/"+url;
    });
    $("#filter_produk").change(function(){
        var val = $(this).val();
        var count = window.location.href.split('/');
        if(count.length == 10){
            window.location.href = window.location.href+"/"+val;
        }else{
            count[10] = val;
            count.join('/');
            originalArray =count;
            separator = '/';
            implodedArray = originalArray.join(separator);
  
            window.location.href = implodedArray;
        }
    })
    // end filter laporan
    $("#tipe").change(function(){
        var val = $(this).val();
        console.log(val);
        var produk = $('#id_produk').val();
        $.ajax({
            type: "GET",
            url: BASEURL+"produk/getHarga/"+produk+"/"+val,
            cache: false,
            success: function(data){
                console.log(data);
                var obj = JSON.parse(data);
                if (obj != null) {
                    $("#harga").val(obj[val] * $("#kurs").val());
                    // console.log(obj[val] * $("#kurs").val());
                    harga = obj[val] * $("#kurs").val();
                    // jumlahkan();
                    var total = parseInt(harga);
                    $("#subtotal").text(formatRupiah(total, 'Rp. '));
                }
            },
            error(res){
                // $("#pesan_alert").show();
                console.log(res);
            }
        });
    })
    $("#jenis").change(function(){
        var val = $("#jenis").val();
        if(val == '1'){
            $("#tipe").removeClass("d-none");
            $("#jumlah").addClass("d-none");
        }else{
            $("#tipe").addClass("d-none");
            $("#jumlah").removeClass("d-none");
        }
    })
    $("#bayar").keyup(function(){
        var val = $(this).val();
        var total = $("#total").val();
        console.log("bayar "+ val);
        console.log("total "+ total);
        var kembalian = 0;
        if(parseInt(val) >= parseInt(total)){
            kembalian =  val - $("#total").val();
            $('#simpan').removeClass('d-none');
        }else{
            kembalian= 0;
            $('#simpan').addClass('d-none');
        }
        $('input[name="kembalian"]').val(kembalian);
        $("#kembalian").text(kembalian);
    });
    $('select[name="pembayaran"]').change(function(){
        var val  = $(this).val();
        if(val == "2"){
            $('.bayar').removeClass('d-none');
        }else{
            $('.bayar').addClass('d-none');
            // $('#simpan').removeClass('d-none');
        }
    })
    function formatRupiah(angka, prefix){
        var	number_string = angka.toString(),
        split	= number_string.split(','),
        sisa 	= split[0].length % 3,
        rupiah 	= split[0].substr(0, sisa),
        ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix+rupiah;
    }
    $("#level").change(function(){
        var val = $(this).val();
        if(val == 2){
            $("#toko").removeClass('hide');
        }else{
            $("#toko").addClass('hide');
        }
    })
    $("#jumlah").keyup(function(){
        var val = $(this).val();
        jumlah = val;
        jumlahkan();
    })
    function jumlahkan(){
        var total = parseInt(harga) * parseInt(jumlah);
        $("#subtotal").text(formatRupiah(total, 'Rp. '));
    }
    $(".duplicate").click(function(){
        // var val = $('.item-order').clone().appendTo('table');
        // $('.table').html(val);
        // alert();
    })
    $(".delete").click(function(){
        return confirm("apakah anda yakin ???");
    });
    $("[class=table]").DataTable();
});