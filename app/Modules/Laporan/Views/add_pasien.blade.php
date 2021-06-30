<style>
    .swal2-container {
        z-index: 99999
    }
    .container-print {
        padding:32px; border-radius:14px;
        width: 824px;
    }
    .fancybox-slide--html .fancybox-close-small {
        padding: 8px;
        right: 20px;
        top: 20px;
        background-color: #fbcacf;
        border-radius: 24px;
        color: red;
        width: 36px;
        height: 36px;
    }
    .disabled {
        background-color: #dfdfdf !important;
    }
    .select2-container {
        z-index: 9999;
    }
</style>
<div class="container container-print">
    <h3>Input Data Pasien Berdasarkan NIK</h3>
    <form id="submit" class="mt-4">
        <div class="form-group">
            <label><strong>NIK</strong></label>
            <div class="input-group">
                <input type="text" class="form-control form-control-lg" id="nik" autocomplete="off" name="nik" />
                <button type="button" class="btn btn-primary" id="btn-search-nik" style="border-radius:0px;"><i class="fa fa-search"></i> Check</button>
            </div>
            <i>pastikan anda menginput nik dengan benar</i>
        </div>
        <table class="table table-striped table-bordered" id="place-info">
            
        </table>
        <div id="result-domisili">
            <div class="mt-5 mb-5">
                <h5>Alamat <i>(Sesuai Domisili)</i></h5>
                <span>
                    <input type="checkbox" id="isSame" /> Gunakan Alamat sesuai KTP?
                </span>
            </div>
            <table class="table table-striped table-bordered mb-10" id="alamat-domisili">
                
            </table>
        </div>
        <div id="place-btn">

        </div>
    </form>
</div>
<script>
    $('document').ready(function(){
        $("#nik").inputmask({
            "mask": "9999999999999999",
            "placeholder": "________________" // remove underscores from the input mask
        });
        $('#result-domisili').hide();
        $('#btn-search-nik').on('click', function(e){
            e.preventDefault()
            $('#btn-search-nik').attr('disabled', true)
            $.ajax({
                url: `{{ route('laporan.add-pasien-action') }}`,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    nik: $('#nik').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                },
                success: function (data) {

                    // console.log(data[0].nama_lengkap)

                    let nik
                    let nama_lengkap
                    let prov_id
                    let kab_id
                    let kec_id
                    let kel_id
                    let alamat
                    let tgl_lahir
                    let golongan_darah

                    if(data.content==undefined) {
                        console.log(data[0].nama_lengkap)
                        let nik = data[0].nik
                        let nama_lengkap = data[0].nama_lengkap
                        let prov_id = data[0].prov_id
                        let kab_id = data[0].kab_id
                        let kec_id = data[0].kec_id
                        let kel_id = data[0].kel_id
                        let alamat = data[0].alamat
                        let tgl_lahir = data[0].tgl_lahir
                        let golongan_darah = data[0].golongan_darah
                        $('#place-info').html(`
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>${nik}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>${nama_lengkap}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>${alamat}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>${tgl_lahir}</td>
                            </tr>
                            <tr>
                                <td>Golongan Darah</td>
                                <td>:</td>
                                <td>${golongan_darah}</td>
                            </tr>
                        `)

                        $('#place-btn').html(`<button type="submit" class="btn btn-primary btn-lg" id="btn-tambah-pasien">Tambahkan</button>`);

                        $('#btn-tambah-pasien').on('click', function(e){
                            e.preventDefault()
                            tambahPasienKeForm(
                                nik,
                                nama_lengkap,
                                prov_id,
                                kab_id,
                                kec_id,
                                kel_id,
                                alamat,
                                tgl_lahir,
                                golongan_darah,
                                'f-db',
                            );
                            $.fancybox.close();
                        })

                    } else {
                        let nik = data.content[0].NIK
                        let nama_lengkap = data.content[0].NAMA_LGKP
                        let prov_id = nik.toString().substr(0, 2)
                        let kab_id = nik.toString().substr(0, 4)
                        let kec_id = nik.toString().substr(0, 6)
                        let kel_id = kec_id+data.content[0].NO_KEL
                        let alamat = data.content[0].ALAMAT+' RT.'+data.content[0].NO_RT+' / RW.'+data.content[0].NO_RW+' '+data.content[0].KEL_NAME+' '+data.content[0].KEC_NAME+' '+data.content[0].KAB_NAME+' '+data.content[0].PROP_NAME
                        let tgl_lahir = data.content[0].TMPT_LHR+', '+data.content[0].TGL_LHR
                        let golongan_darah = data.content[0].GOL_DARAH
                        $('#place-info').html(`
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>${nik}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>${nama_lengkap}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>${alamat}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>${tgl_lahir}</td>
                            </tr>
                            <tr>
                                <td>Golongan Darah</td>
                                <td>:</td>
                                <td>${golongan_darah}</td>
                            </tr>
                        `)
                        
                        $('.fancybox-content #isSame').change(function(e) {
                            e.preventDefault();
                            var status = $('.fancybox-content #isSame:checked')
                            // console.log(status);
                            if($('.fancybox-content #isSame:checked').length > 0) {
                                $('#alamat-domisili').html(`
                                    <tr>
                                        <td width="17%">Alamat</td>
                                        <td width="3%">:</td>
                                        <td>
                                            <input type="text" class="form-control" id="alamat_domisili" placeholder="Detail alamat pelapor (gang, jalan, nomor rumah, dsb)" name="alamat" disabled value="${alamat}">
                                        </td>
                                    </tr>
                                `)
                            } else {
                                $('#alamat-domisili').html(`
                                    <tr>
                                        <td>Provinsi</td>
                                        <td id='result-prov'>
                                            {!! getProvinsi('prov_id_nik', '') !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kab / Kota</td>
                                        <td id='result-kab'>
                                            <select name="kab_id_nik" id="kab_nik" placeholder="Pilih Kab / Kota" disabled class="form-control">
                                                <option value="">Pilih Kab / Kota</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td id='result-kec'>
                                            <select name="kec_id_nik" id="kec_nik" placeholder="Pilih Kecamatan" disabled class="form-control">
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan</td>
                                        <td id='result-kel'>
                                            <select name="kel_id_nik" id="kel_nik" placeholder="Pilih Kelurahan" disabled class="form-control">
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan Alamat</td>
                                        <td>
                                            <input type="text" class="form-control" id="alamat_domisili" placeholder="Detail alamat pelapor (gang, jalan, nomor rumah, dsb)" name="alamat" required>
                                        </td>
                                    </tr>
                                `);
                            }
                        })

                        $('#result-domisili').show(function() {
                            $('.fancybox-content #isSame').trigger('change')
                            $('.fancybox-content #prov_id_nik').select2({
                                dropdownParent: $('.fancybox-content')
                            });
                            $('#prov_id_nik').change(function(e) {
                                e.preventDefault()
                                var prov_id_domisili = $(this).val()
                                var kdc_prov = $('option:selected', this).attr('data-kdc')
                                prov_id = kdc_prov
                                $.ajax({
                                    url: '{{ route("get-kota") }}',
                                    type: 'post',
                                    data: { 'parent_id': prov_id_domisili, 'selected': '', id: 'kab_id_nik', '_token': $('input[name="_token"]').val() },
                                    success: function(response) {
                                        $('#result-kab').html(response);
                                        $('.fancybox-content #kab_id_nik').select2({
                                            dropdownParent: $('.fancybox-content')
                                        });
                                        $('#kab_id_nik').change(function(a) {
                                            a.preventDefault();
                                            var kab_id_domisili = $('#kab_id_nik').val()
                                            var kdc_kab = $('option:selected', this).attr('data-kdc')
                                            kab_id = kdc_kab
                                            $.ajax({
                                                url: '{{ route("get-kecamatan") }}',
                                                type: 'post',
                                                data: { 'parent_id': kab_id_domisili, 'selected': '', id: 'kec_id_nik', '_token': $('input[name="_token"]').val() },
                                                success: function(response) {
                                                    $('#result-kec').html(response);
                                                    $('.fancybox-content #kec_id_nik').select2({
                                                        dropdownParent: $('.fancybox-content')
                                                    });
                                                    $('#kec_id_nik').change(function(r) {
                                                        r.preventDefault();
                                                        var kec_id_domisili = $('#kec_id_nik').val();
                                                        var kdc_kec = $('option:selected', this).attr('data-kdc')
                                                        kec_id = kdc_kec
                                                        $.ajax({
                                                            url: '{{ route("get-kelurahan") }}',
                                                            type: 'post',
                                                            data: { 'parent_id': kec_id_domisili, 'selected': '', id: 'kel_id_nik', '_token': $('input[name="_token"]').val() },
                                                            success: function(response) {
                                                                $('#result-kel').html(response);
                                                                $('.fancybox-content #kel_id_nik').select2({
                                                                    dropdownParent: $('.fancybox-content')
                                                                });
                                                                $('#kel_id_nik').change(function(r) {
                                                                    r.preventDefault()
                                                                    var kdc_kel = $('option:selected', this).attr('data-kdc')
                                                                    kel_id = kdc_kel
                                                                    console.log(kel_id)
                                                                })
                                                            }
                                                        })
                                                    })
                                                }
                                            })
                                        })
                                    }
                                })
                            })
                            $('#alamat_domisili').keyup(function(e) {
                                e.preventDefault()
                                alamat = $(this).val()
                            })
                        });



                        $('#place-btn').html(`<button type="submit" class="btn btn-primary btn-lg" id="btn-tambah-pasien">Tambahkan</button>`);

                        $('#btn-tambah-pasien').on('click', function(e){
                            e.preventDefault()
                            tambahPasienKeForm(
                                nik,
                                nama_lengkap,
                                prov_id,
                                kab_id,
                                kec_id,
                                kel_id,
                                alamat,
                                tgl_lahir,
                                golongan_darah,
                                'f-api',
                            );
                            $.fancybox.close();
                        })
                    }
                }
            })

        })
    })
</script>