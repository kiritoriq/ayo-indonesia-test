@extends('layout.default')
@section('title', 'Master Jenis Aduan')
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Commode2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                            </span>
                            <h3 class="card-label mt-2 display-4">Master Jenis Aduan
                            <small>Kelola Jenis Aduan</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Cari Data Jenis Aduan</p>
                        <div class="form-group row fv-plugins-icon-container">
                            <div class="col-lg-8">
                                <input type="text" id="cari-jenis_aduan" name="jenis_aduan" class="form-control" placeholder="Cari Jenis Aduan">
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="btn-group btn-group-xs" role="group" aria-label="Large button group">
                                    <button class="btn btn-success btn-sm py-3" type="button" data-toggle="tooltip" data-theme="dark" title="Filter Data">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span> Cari
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm py-3" data-fancybox data-type="ajax" data-src="{{ route('jenis-aduan.create') }}" id="tambahData">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable-init" id="table-user">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Jenis Aduan</th>
                                        <th>Status Aktif</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Aduan</th>
                                        <th>Status Aktif</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($jenis_aduan as $key => $aduan)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>{{ $aduan->jenis_aduan }}</td>
                                        <td class="text-center align-middle">
                                            @if($aduan->isAktif == 1)
                                                <span class="text-success font-weight-bold">Aktif</span>
                                            @else
                                                <span class="text-danger font-weight-bold">Tidak Aktif</span>
                                            @endif
                                            {{-- <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $user->privilege }}</span> --}}
                                        </td>
                                        <td class="text-center" width="20%">
                                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-fancybox data-type="ajax" data-src="{{ route('jenis-aduan.edit', $aduan->id) }}" data-toggle="tooltip" data-theme="dark" title="Edit Jenis Aduan">
                                                <span class="la la-2x la-edit text-primary"></span>
                                            </button>
                                            <a href="#" class="btn btn-sm btn-clean btn-icon hapus-aduan" data-aduan="{{ $aduan->id }}" data-toggle="tooltip" data-theme="dark" title="Hapus Jenis Aduan">
                                                <span class="la la-2x la-trash text-danger"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        $(document).ready(function() {
            $('#table-user .hapus-aduan').click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-aduan')
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah anda yakin akan menghapus data ini?',
                    text: 'Setelah dihapus, data tidak dapat dikembalikan',
                    showConfirmButton: true,
                    confirmButtonText: 'Yakin',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            url: '{{ route("jenis-aduan.delete") }}',
                            type: 'POST',
                            data: { id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                            success: function(response) {
                                if(response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data Berhasil dihapus',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = "{{ route('jenis-aduan.index') }}";
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan!',
                                        text: response.msg,
                                        timer: 2000,
                                        showConfirmButton: false
                                    })
                                }
                            }
                        })
                    } else {

                    }
                })
            })
        })
    </script>
@endsection
