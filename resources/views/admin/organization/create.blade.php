<style>
    .swal2-container {
        z-index: 10000000;
    }
</style>
<div class="container py-5 max-w-800px">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">
                Buat Organisasi Baru
            </h3>
        </div>
        <form class="form" id="org_form" method="POST" action="{{ route('organization.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Organisasi</label>
                    <input type="text" name="org_name" class="form-control" placeholder="Masukkan Nama Organisasi">
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <input type="file" accept="image/png, image/gif, image/jpeg" name="logo" class="form-control">
                    <small>* Ukuran gambar maks 1 MB</small>
                </div>
                <div class="form-group">
                    <label>Tahun Berdiri</label>
                    <input type="text" name="since" class="form-control" placeholder="Tahun Berdiri Organisasi">
                </div>
                <div class="form-group">
                    <label>Alamat Organisasi</label>
                    <textarea name="address" class="form-control" id="address" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Cabang Olahraga</label>
                    <select name="sport_branch" id="sport_branch" class="form-control">
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->sport_branch }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-right ">
                <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Simpan</button>
                <button type="button" class="btn btn-warning" onclick="$.fancybox.close()">Batal</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#org_form').submit(function(e) {
            e.preventDefault()
            confirmAlert(
                'Yakin simpan data ini?',
                '',
                'warning',
                'Yakin',
                'Tidak'
            )
            .then((result) => {
                if(result.value) {
                    let formData = new FormData(this)
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.status == 'success') {
                                timerAlert(
                                    'Sukses!',
                                    response.msg,
                                    'success',
                                    2000
                                )
                                .then(() => {
                                    window.location.href = '{{ route("organization.index") }}'
                                })
                            }

                            if(response.status == 'failed') {
                                basicAlert(
                                    'Gagal Menyimpan Data!',
                                    response.msg,
                                    'error',
                                    'Ok'
                                )
                            }
                        }
                    })
                }
            })
        })
    })
</script>