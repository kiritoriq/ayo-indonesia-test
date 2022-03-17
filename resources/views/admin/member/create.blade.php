<style>
    .swal2-container {
        z-index: 10000000;
    }
</style>
<div class="container py-5 max-w-800px">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">
                Buat Anggota Baru
            </h3>
        </div>
        <form class="form" id="member_form" method="POST" action="{{ route('member.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Anggota</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Anggota">
                </div>
                <div class="form-group">
                    <label>Tinggi Badan</label>
                    <div class="input-group">
                        <input type="number" name="height" class="form-control" min="0" placeholder="Masukkan Tinggi Badan Anggota">
                        <div class="input-group-append">
                            <span class="input-group-text">Cm</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Berat Badan</label>
                    <div class="input-group">
                        <input type="number" name="weight" class="form-control" min="0" placeholder="Masukkan Berat Badan Anggota">
                        <div class="input-group-append">
                            <span class="input-group-text">Kg</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email Anggota">
                </div>
                <div class="form-group">
                    <label>Nomor Ponsel</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan nomor ponsel Anggota">
                </div>
                <div class="form-group">
                    <label>Cabang Olahraga</label>
                    <select name="sport_branch" id="sport_branch" class="form-control">
                        <option value="">.: Pilih Cabang Olahraga :.</option>
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->sport_branch }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <h3 class="card-title">
                        Form Jabatan dan Organisasi
                    </h3>
                    <hr>
                    <table id="org-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Posisi</th>
                                <th>Organisasi</th>
                            </tr>
                        </thead>
                        <tbody id="org-result">
                            
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-primary btn-add-org">
                        Tambah Organisasi
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-del-org">
                        Hapus Organisasi
                    </button>
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
    function positionForm(i) {
        return `<select name="org[${i}][position_id]" id="position-${i}" class="form-control">
                    <option value="1">Ketua</option>
                    <option value="2">Staf</option>
                    <option value="3">Anggota</option>
                </select>`
    }

    function orgForm(orgs, i) {
        console.log(orgs)
        let html = `<select name="org[${i}][org_id]" id="org-${i}" class="form-control">
                        <option value="">.: Pilih Organisasi :.</option>
                    `
        $.each(orgs, (index, value) => {
            html += `<option value="${value.id}">${value.org_name}</option>`
        })
        html += `</select>`

        return html
    }

    $(document).ready(function() {
        let i=0;

        $('.btn-add-org').click(function(e) {
            e.preventDefault()
            let sportsId = $('#sport_branch').val();
            $.ajax({
                url: '{{ route("member.get-org") }}',
                type: 'GET',
                data: {
                    sports_id: sportsId
                },
                success: function(response) {
                    $('#org-table tbody').append(
                        `<tr id="row-org-${i}">
                            <td>${positionForm(i)}</td>
                            <td>
                                ${orgForm(response, i)}
                            </td>
                        </tr>`
                    )
                    i+=1
                }
            })
        })

        $('.btn-del-org').click(function(e) {
            e.preventDefault()
            i-=1
            $('#org-table tbody').find(`#row-org-${i}`).remove()
        })

        $('#member_form').submit(function(e) {
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
                                    window.location.href = '{{ route("member.index") }}'
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