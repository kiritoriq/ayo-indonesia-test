<style>
    .swal2-container {
        z-index: 99999
    }
    .container-print {
        padding:32px; border-radius:14px;
        width: 624px;
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
</style>
<div class="container container-print">
    <div class="form-group">
        <label><strong>Inputkan NIK Anda</strong></label>
        <div class="input-group">
            <input type="text" class="form-control form-control-lg" id="nik-complete" autocomplete="off" name="nik" />
        </div>
        <i>pastikan anda menginput nik dengan benar</i>
    </div>
    <button type="button" id="add-ktp" class="btn btn-primary btn-block">Simpan</button>
</div>
<script>
    $('document').ready(function(){
        $("#nik-complete").inputmask({
            "mask": "9999999999999999",
            "placeholder": "________________" // remove underscores from the input mask
        });
        $('#add-ktp').on('click', function(){
            tambahPasienKeForm(
                $('#nik-complete').val(),
                $('#nama').val(),
                $('#prov_id').val(),
                $('#kab_id').val(),
                $('#kec_id').val(),
                $('#kel_id').val(),
                $('#alamat').val(),
                '-',
                '-',
                'f-i'
            )
            $.fancybox.close();
        })
    })
</script>