<style>
    .swal2-container {
        z-index: 10000000;
    }
</style>
<div class="container py-5 max-w-800px">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">
                Buat Acara Baru
            </h3>
        </div>
        <form class="form" id="event_form" method="POST" action="{{ route('event.update', $event->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Acara</label>
                    <input type="text" name="event_name" class="form-control" value="{{ $event->event_name }}" placeholder="Masukkan Nama Acara">
                </div>
                <div class="form-group">
                    <label>Tanggal Acara</label>
                    <input type="text" name="event_date" class="form-control" value="{{ date('d-m-Y', strtotime($event->event_date)) }}" placeholder="Tanggal Acara">
                </div>
                <div class="form-group">
                    <label>Jam Acara</label>
                    <input type="text" name="event_time" class="form-control" value="{{ date('H:i', strtotime($event->event_time)) }}" placeholder="Waktu Acara">
                </div>
                <div class="form-group">
                    <label>Deskripsi Acara</label>
                    <textarea name="description" class="form-control" id="description" rows="5">{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Prioritas Acara</label>
                    <select name="priority" id="priority" class="form-control">
                        <option value=""  {{ ($event->priority == '' ? 'selected' : '') }}>Semua Prioritas Acara</option>
                        <option value="1" {{ ($event->priority == 1 ? 'selected' : '') }}>Wajib</option>
                        <option value="2" {{ ($event->priority == 2 ? 'selected' : '') }}>Tidak Wajib</option>
                        <option value="3" {{ ($event->priority == 3 ? 'selected' : '') }}>Hanya Staff</option>
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
        $('input[name="event_date"]').datepicker({
            format: 'dd-mm-yyyy'
        })
        $('input[name="event_time"]').timepicker({
            showMeridian: false
        })

        $('#event_form').submit(function(e) {
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
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function(response) {
                            if(response.status == 'success') {
                                timerAlert(
                                    'Sukses!',
                                    response.msg,
                                    'success',
                                    2000
                                )
                                .then(() => {
                                    window.location.href = '{{ route("event.index") }}'
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