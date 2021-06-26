@extends('layout.default')
@section('title', 'Insert Laporan')
@section('content')
<form action="{{route("laporan.insert.action")}}" class="form" id="kt_form" method="POST">
    @csrf
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-icon">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    </span>
                    <b>Input Laporan</b>
                </h3>
            </div>
            <!-- .card-header -->
            <div class="card-body">
                <div class="row gutter-b">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Nama Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama pelapor" name="nama_pelapor" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Alamat Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat pelapor" name="alamat_pelapor" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">No. Telepon Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="no_telp" placeholder="62812xxxxxxxx" name="no_telp_pelapor" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Isi Laporan <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <textarea name="isi_laporan" id="isi_laporan" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Instansi <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <select name="instansi" class="form-control" id="instansi" required>
                                    <option value="">.: Pilih Instansi :.</option>
                                    <option value="1">Umum</option>
                                    <option value="2">Faskes</option>
                                </select>
                                {{-- <input type="text" class="form-control border-primary" id="nama" placeholder="Masukkan nama kelompok" name="nama"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .card-body -->
            <div class="card-footer">
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label"></label>
                    <div class="col-lg-7 col-7">
                        <button type="submit" id="btnsubmit" class="btn btn-primary mr-2">Simpan</button>
                        {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        <a href="{{ route('laporan.index') }}" class="btn btn-warning">Batal</a>
                    </div>
                </div>
            </div>
            <!-- .card-footer -->
        </div>
        <!-- .card -->
    </div>
    <!-- .container -->
</form>
@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script type="text/javascript">
        base_url.indexOf(1);
        base_url.toLowerCase();
        base_url = (window.location.origin === "http://103.9.227.61/" ? "" : base_url.split("/")[0]);

        var SubmitForm = function() {
            var _handleSubmitForm = function _handleSubmitForm() {
                var validation;

                validation = FormValidation.formValidation(KTUtil.getById('kt_form'), {
                    fields: {
                        nama_pelapor: {
                            validators: {
                                notEmpty: {
                                    message: 'Nama Pelapor tidak boleh kosong'
                                }
                            }
                        },
                        alamat_pelapor: {
                            validators: {
                                notEmpty: {
                                    message: 'Alamat pelapor tidak boleh kosong'
                                }
                            }
                        },
                        no_telp_pelapor: {
                            validators: {
                                notEmpty: {
                                    message: 'No. Telepon pelapor tidak boleh kosong'
                                }
                            }
                        },
                        isi_laporan: {
                            validators: {
                                notEmpty: {
                                    message: 'Isi Laporan tidak boleh kosong'
                                }
                            }
                        },
                        instansi: {
                            validators: {
                                notEmpty: {
                                    message: 'Instansi tidak boleh kosong'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                });

                $('#kt_form').on('submit', function(e) {
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        $('#btnsubmit').prop('disabled', true);
                        if(status == 'Valid') {
                            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            let nama = $('#nama').val();
                            let alamat = $('#alamat').val();
                            let no_telp = $('#no_telp').val();
                            let isi_laporan = $('#isi_laporan').val();
                            let instansi = $('#instansi').val();
                            $.ajax({
                                url: site_url + 'laporan/insert-action',
                                type: 'POST',
                                dataType: 'JSON',
                                timeout: 10000,
                                data: {
                                    _token: CSRF_TOKEN,
                                    nama_pelapor: nama,
                                    alamat_pelapor: alamat,
                                    no_telp_pelapor: no_telp,
                                    isi_laporan: isi_laporan,
                                    instansi: instansi,
                                },
                                beforeSend: function() {

                                },
                                success: function(response) {
                                    // var response = parseJSON(res);
                                    console.log(response);
                                    if(response.status == 'failed') {
                                        Swal.fire({
                                            title: 'Gagal Simpan',
                                            text: response.msg,
                                            icon: 'error',
                                        })
                                        $('btnsubmit').prop('disabled', false);
                                    } else if(response.status == 'validate') {
                                        Swal.fire({
                                            title: 'Gagal Disimpan!',
                                            text: response.msg,
                                            icon: 'error',
                                        })
                                    } else {
                                        Swal.fire({
                                            title: 'Berhasil Tersimpan',
                                            text: response.msg,
                                            icon: 'success',
                                            showConfirmButton: true,
                                            confirmButtonText: 'Ok'
                                        }).then(() => {
                                            window.location.href = "{{ route('laporan.index') }}";
                                        })
                                    }
                                }
                            })
                        } else {
                            $("#btnLogin").prop("disabled", false);
                                swal.fire({
                                    text: "Ops, terjadi kesalahan, semua form harap diisi.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Tutup",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function () {
                                    $("#btnsubmit").prop("disabled", false);
                                    KTUtil.scrollTop();
                                });
                        }
                    })
                })
            };

            return {
                init: function init() {
                    _handleSubmitForm();
                }
            };
        }();

        $(document).ready(function() {
            SubmitForm.init();
        })
    </script>
@endsection