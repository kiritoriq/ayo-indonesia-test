{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<div class="container py-5 max-w-700px">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Filter Cetak Excel
            </h3>
        </div>
        <form class="form" id="form_user" method="POST" action="{{ route('laporan.cetak-excel') }}">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Dari Tanggal</label>
                    <div class="col-lg-8 col-8">
                        <input type="text" class="form-control border-primary tanggal" id="username" placeholder="Masukkan Tanggal"  name="tanggal1">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right ">
                <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Simpan</button>
                <button type="button" onclick="$.fancybox.close()" class="btn btn-danger">Batal</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
    })
</script>