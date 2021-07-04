@extends('layout.default')
@section('title', 'Edit Laporan')
@section('content')
<form action="{{route("laporan.insert.action")}}" class="form" id="kt_form" method="POST">
    @csrf
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-icon">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-19-122603/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    </span>
                    <b>Edit Laporan</b>
                </h3>
            </div>
            <!-- .card-header -->
            <div class="card-body">
                <div class="row gutter-b">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <input type="hidden" id="id" name="id" value="{{ $laporan->id }}">
                            <label class="col-lg-3 col-3 col-form-label">Nama Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama pelapor" name="nama_pelapor" value="{{ $laporan->nama_pelapor }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">No. Telepon Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="no_telp" placeholder="62812xxxxxxxx" name="no_telp_pelapor" value="{{ $laporan->no_telp_pelapor }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Provinsi Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                {!! getProvinsi("prov_id", $laporan->prov_id) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Kab / Kota Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <div id="result_kab">
                                    <input type="hidden" class="selected_kota" value="{{ $laporan->kab_id }}">
                                    <select name="kab_id" id="kab" placeholder="Pilih Kab / Kota" disabled class="form-control">
                                        <option value="">Pilih Kab / Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Kecamatan Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <div id="result_kec">
                                    <input type="hidden" class="selected_kec" value="{{ $laporan->kec_id }}">
                                    <select name="kec_id" id="kec" placeholder="Pilih Kecamatan" disabled class="form-control">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Kelurahan Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <div id="result_kel">
                                    <input type="hidden" class="selected_kel" value="{{ $laporan->kel_id }}">
                                    <select name="kel_id" id="kel" placeholder="Pilih Kelurahan" disabled class="form-control">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Alamat Pelapor <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat pelapor" name="alamat_pelapor" value="{{ $laporan->alamat_pelapor }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Isi Laporan <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <textarea name="isi_laporan" id="isi_laporan" class="form-control" rows="3" required>{!! trim($laporan->isi_laporan) !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Jenis Aduan <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                {!! getJenisAduan('id_jenis_aduan', (($laporan->id_jenis_aduan!=null)?$laporan->id_jenis_aduan:'')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Solusi</label>
                            <div class="col-lg-8 col-8">
                                <textarea name="solusi" id="solusi" class="form-control" rows="3" required>{!! trim($laporan->solusi) !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-3 col-form-label">Instansi <span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-8">
                                <select name="instansi" class="form-control" id="instansi" required>
                                    <option value="">.: Pilih Instansi :.</option>
                                    <option value="1" {{ ($laporan->instansi==1)?'selected':'' }}>Umum</option>
                                    <option value="2" {{ ($laporan->instansi==2)?'selected':'' }}>Faskes</option>
                                </select>
                                {{-- <input type="text" class="form-control border-primary" id="nama" placeholder="Masukkan nama kelompok" name="nama"> --}}
                            </div>
                        </div>
                        <div id="asalfaskes">
                            <div class="form-group row">
                                <label class="col-lg-3 col-3 col-form-label">Asal Instansi / Faskes <span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-8">
                                    <input type="text" class="form-control" id="asal_instansi" placeholder="Masukkan Asal Instansi / Faskes" name="asal_instansi" value="{{ $laporan->asal_instansi }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-primary float-right" data-fancybox data-type="ajax" data-src="{{ route('laporan.add-pasien') }}" id="btn-add-pasien"><i class="fa fa-plus-circle"></i> Tambah Pasien</button>
                        <div class="float-right" style="padding-right:20px; margin-top:4px;">
                            {{-- <input type="checkbox" id="isSame" /> Apakah Pelapor adalah Pasien? --}}
                        </div>
                        <br />
                        <h5><strong>Data Pasien</strong></h5>
                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Golongan Darah</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody id="place-tb-pasien">
                                @if (getEditPasien($laporan->id))
                                    @foreach (getEditPasien($laporan->id) as $item)
                                        <tr>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->golongan_darah }}</td>
                                            <td>
                                                <input type="hidden" name="nik_pasien[]" value="{{ $item->nik }}" />
                                                <input type="hidden" name="nama_lengkap_pasien[]" value="{{ $item->nama_lengkap }}" />
                                                <input type="hidden" name="prov_id_pasien[]" value="{{ $item->prov_id }}" />
                                                <input type="hidden" name="kab_id_pasien[]" value="{{ $item->kab_id }}" />
                                                <input type="hidden" name="kec_id_pasien[]" value="{{ $item->kec_id }}" />
                                                <input type="hidden" name="kel_id_pasien[]" value="{{ $item->kel_id }}" />
                                                <input type="hidden" name="alamat_pasien[]" value="{{ $item->alamat }}" />
                                                <input type="hidden" name="tgl_lahir_pasien[]" value="{{ $item->tgl_lahir }}" />
                                                <input type="hidden" name="golongan_darah_pasien[]" value="{{ $item->golongan_darah }}" />
                                                <input type="hidden" name="f[]" value="f-db" />
                                                <input type="hidden" name="mode" value="edit" />
                                                <a href="javascript:;" class="btn btn-danger btn-delete-pasien" onclick="delete_pasien('{{ $item->id }}')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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

        let delete_pasien = (uid) => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Pasien akan terhapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('laporan.add-hapus-pasien') }}`,
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: {
                            id: uid,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function (xhr, options) {
                        },
                        success: function (data, textStatus, jqXHR) {
                            Swal.fire({
                                title: "Terhapus!",
                                text: "Data Pasien berhasil dihapus!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "OK!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then((result) => {
                                window.location.href = ''
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            })
                        }
                    })
                }
            })
        }

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
                            $.ajax({
                                url: site_url + 'laporan/edit-action',
                                data: $('#kt_form').serialize(),
                                type: 'POST',
                                cache: false,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        let tambahPasienKeForm = (
            nik,
            nama_lengkap,
            prov_id,
            kab_id,
            kec_id,
            kel_id,
            alamat,
            tgl_lahir,
            golongan_darah,
            f
        ) => {
            $('#place-tb-pasien').append(`
                <tr>
                    <td>${nik}</td>
                    <td>${nama_lengkap}</td>
                    <td>${alamat}</td>
                    <td>${golongan_darah}</td>
                    <td>
                        <input type="hidden" name="nik_pasien[]" value="${nik}" />
                        <input type="hidden" name="nama_lengkap_pasien[]" value="${nama_lengkap}" />
                        <input type="hidden" name="prov_id_pasien[]" value="${prov_id}" />
                        <input type="hidden" name="kab_id_pasien[]" value="${kab_id}" />
                        <input type="hidden" name="kec_id_pasien[]" value="${kec_id}" />
                        <input type="hidden" name="kel_id_pasien[]" value="${kel_id}" />
                        <input type="hidden" name="alamat_pasien[]" value="${alamat}" />
                        <input type="hidden" name="tgl_lahir_pasien[]" value="${tgl_lahir}" />
                        <input type="hidden" name="golongan_darah_pasien[]" value="${golongan_darah}" />
                        <input type="hidden" name="f[]" value="${f}" />
                        <a href="javascript:;" class="btn btn-danger btn-delete-pasien"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            `)

            $('.btn-delete-pasien').on('click', function(){
                $(this).parent().parent().remove()
            })

        }

        $('document').ready(function() {
            SubmitForm.init();
            $('select').select2()

            $('.btn-delete-pasien').on('click', function(){
                $(this).parent().parent().remove()
            })

            $.extend($.fancybox.defaults, {
                afterClose: function(){
                },
                beforeClose: function(){
                    $('#isSame').prop('checked', false);
                }
            });

            // $('#isSame').on('change',function() {
            //     if (this.checked) {
            //         if ($('#nama').val()=='') {
            //             $('#isSame').prop('checked', false);
            //             Swal.fire({ title: 'Nama Kosong!', text: 'Inputkan Nama Terlebih dahulu', icon: 'error' })
            //         } else {
            //             if ($('#prov_id').val()=='') {
            //                 $('#isSame').prop('checked', false);
            //                 Swal.fire({ title: 'Provinsi Kosong!', text: 'Inputkan Provinsi Terlebih dahulu', icon: 'error' })
            //             } else {
            //                 if ($('#kab').val()=='') {
            //                     $('#isSame').prop('checked', false);
            //                     Swal.fire({ title: 'Kabupaten/Kota Kosong!', text: 'Inputkan Kabupaten/Kota Terlebih dahulu', icon: 'error' })
            //                 } else {
            //                     if ($('#kec').val()=='') {
            //                         $('#isSame').prop('checked', false);
            //                         Swal.fire({ title: 'Kecamatan Kosong!', text: 'Inputkan Kecamatan Terlebih dahulu', icon: 'error' })
            //                     } else {
            //                         if ($('#kel').val()=='') {
            //                             $('#isSame').prop('checked', false);
            //                             Swal.fire({ title: 'Kelurahan/Desa Kosong!', text: 'Inputkan Kelurahan/Desa Terlebih dahulu', icon: 'error' })
            //                         } else {
            //                             if ($('#alamat').val()=='') {
            //                                 $('#isSame').prop('checked', false);
            //                                 Swal.fire({ title: 'Alamat Kosong!', text: 'Inputkan Alamat Terlebih dahulu', icon: 'error' })
            //                             } else {
            //                                 $.fancybox.open({
            //                                     src: `{{ route('laporan.add-nik') }}`,
            //                                     type: 'ajax',
            //                                     closeBtn: false,
            //                                     closeClickOutside : false,
            //                                     opts: { touch : false },
            //                                 })
            //                             }
            //                         }
            //                     }
            //                 }
            //             }
            //         }

            //     } else {
            //         console.log('unchecked')
            //     }
            // });

            $('#prov_id').change(function(e) {
                e.preventDefault();
                var prov_id = $(this).val()
                $.ajax({
                    url: site_url + 'laporan/get_kota',
                    type: 'post',
                    data: { 'parent_id': prov_id, 'selected': $('.selected_kota').val(), id: 'kab_id', '_token': $('input[name="_token"]').val() },
                    success: function(response) {
                        $('#result_kab').html(response);
                        $('.kabkota').select2();
                        $('.kabkota').change(function(a) {
                            a.preventDefault();
                            var kab_id = $('#kab_id').val()
                            $.ajax({
                                url: site_url + 'laporan/get_kecamatan',
                                type: 'post',
                                data: { 'parent_id': kab_id, 'selected': $('.selected_kec').val(), id: 'kec_id', '_token': $('input[name="_token"]').val() },
                                success: function(response) {
                                    $('#result_kec').html(response);
                                    $('.kec').select2();
                                    $('.kec').change(function(r) {
                                        r.preventDefault();
                                        var kec_id = $('#kec_id').val();
                                        $.ajax({
                                            url: site_url + 'laporan/get_kelurahan',
                                            type: 'post',
                                            data: { 'parent_id': kec_id, 'selected': $('.selected_kel').val(), id: 'kel_id', '_token': $('input[name="_token"]').val() },
                                            success: function(response) {
                                                $('#result_kel').html(response);
                                                $('.kel').select2();
                                            }
                                        })
                                    }).trigger('change')
                                }
                            })
                        }).trigger('change')
                    }
                })
            }).trigger('change')

            $('#asalfaskes').hide();

            $('#instansi').change(function(e) {
                e.preventDefault();
                var val = $(this).val()
                console.log(val);
                if(val == '2') {
                    $('#asalfaskes').show();
                } else {
                    $('#asalfaskes').hide();
                }
            }).trigger('change')
        })
    </script>
@endsection