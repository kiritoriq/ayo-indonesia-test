<style>
    .swal2-container {
        z-index: 10000000;
    }
</style>
<div class="container py-5 max-w-800px">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">
                Edit Laporan Acara
            </h3>
        </div>
        <form class="form" id="eventlog-form" method="POST" action="{{ route('eventlog.update', $eventlog->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Pilih Acara</label>
                    <select name="event_id" id="event_id" class="form-control">
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ ($eventlog->event_id == $event->id ? 'selected' : '') }}>{{ $event->event_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Resume Acara</label>
                    <textarea name="event_resume" class="form-control" id="event_resume" rows="5">{{ $eventlog->event_resume }}</textarea>
                </div>
                <div class="form-group">
                    <label>Anggota yang Hadir</label>
                    <input type="number" min="0" name="member_attend" class="form-control" value="{{ $eventlog->member_attend }}" placeholder="Masukkan Anggota yang hadir (angka)">
                </div>
                <div class="form-group">
                    <label>Kontribusi Anggota</label>
                    <textarea name="member_contribution" class="form-control" id="member_contribution" rows="5">{{ $eventlog->member_contribution }}</textarea>
                </div>
                <div class="form-group">
                    <label>Hasil Acara</label>
                    <textarea name="event_result" class="form-control" id="event_result" rows="5">{{ $eventlog->event_result }}</textarea>
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
        $('#eventlog-form').submit(function(e) {
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
                                            window.location.href = '{{ route("eventlog.index") }}'
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
