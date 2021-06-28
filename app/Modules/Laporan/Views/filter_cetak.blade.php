<div class="container py-5 max-w-700px">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Filter Cetak Excel
            </h3>
        </div>
        <form class="form" id="form_user" method="POST" action="{{ route('laporan.cetak-excel') }}" target="_blank">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Dari Tanggal</label>
                    <div class="col-lg-8 col-8">
                        <input type="text" name="tanggal1" class="form-control datetimepicker-input tanggal" placeholder="Pilih Tanggal dan waktu" id="tanggal1" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Hingga Tanggal</label>
                    <div class="col-lg-8 col-8">
                        <input type="text" name="tanggal2" class="form-control datetimepicker-input tanggal" placeholder="Pilih Tanggal dan waktu" id="tanggal2" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right ">
                <button type="submit" id="btnSubmit" class="btn btn-success mr-2">
                    <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon--></span> Cetak
                </button>
                <button type="button" onclick="$.fancybox.close()" class="btn btn-danger">Batal</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // KTBootstrapDatetimepicker.init();
        $('#tanggal1').datetimepicker({
            format: 'dd-mm-yyyy hh:ii'
        });
        $('#tanggal2').datetimepicker({
            format: 'dd-mm-yyyy hh:ii'
        });

        // $('#form_user').submit(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         type: 'post',
        //         data: $(this).serialize(),
        //         success: function(response) {
        //             console.log(response);
        //         }
        //     })
        // })
    })
</script>