@extends('layout.default')
@section('title', 'Organization')
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </span>
                            <h3 class="card-label mt-2 display-4">Master Organisasi
                            <small>Manajemen Organisasi</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Filter Data Organisasi</p>
                        <div class="form-group row fv-plugins-icon-container">
                            <div class="col-lg-6">
                                <input type="text" id="search" name="search" class="form-control" value="{{ Request()->search }}" placeholder="Cari Nama Organisasi">
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control" name="sports" id="sports">
                                    <option value="" {{ Request()->sports == '' ? 'selected' : '' }}>Semua Cabang Olahraga</option>
                                    @foreach ($sports as $sport)
                                        <option value="{{ $sport->id }}" {{ Request()->sports == $sport->id ? 'selected' : '' }}>{{ $sport->sport_branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="btn-group btn-group-xs" role="group" aria-label="Large button group">
                                    <button class="btn btn-danger btn-sm text-white py-3 reset-form" type="button" data-toggle="tooltip" data-theme="dark" title="Reset Form">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Close.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                                    <rect x="0" y="7" width="16" height="2" rx="1"/>
                                                    <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
                                                </g>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
                                    </button>
                                    
                                    {{-- Search Button --}}
                                    <button class="btn btn-success btn-sm py-3 search-btn" type="button" data-toggle="tooltip" data-theme="dark" title="Cari">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                        </span> Cari
                                    </button>
                                    {{-- ./end of Search Button --}}

                                    {{-- Create Button --}}
                                    <button data-fancybox data-type="ajax" data-src="{{ route('organization.create') }}" class="btn btn-primary btn-sm py-3" title="Buat Organisasi">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                        </span> Buat Organisasi
                                    </button>
                                    {{-- ./end of Create Button --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable-init" id="table-org">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">#</th>
                                        <th>Nama Organisasi</th>
                                        <th>Logo</th>
                                        <th>Tahun Berdiri</th>
                                        <th>Alamat</th>
                                        <th>Cabang Olahraga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orgs) > 0)
                                        @foreach($orgs as $key => $org)
                                        <tr>
                                            <td class="text-center">{{ (($key+1)+(( $orgs->currentPage() !=0 )?($orgs->currentPage()-1):$orgs->currentPage())*env('APP_PAGE_LIMIT')) }}</td>
                                            <td>{{ $org->org_name }}</td>
                                            <td style="text-align: center">
                                                <img src="{{ asset('media/upload/logo/' . $org->logo) }}" alt="logo {{ $org->org_name }}" style="max-width: 65px">
                                            </td>
                                            <td>{{ $org->since }}</td>
                                            <td>{{ $org->address }}</td>
                                            <td class="text-center align-middle">
                                                <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $org->sports->sport_branch }}</span>
                                            </td>
                                            <td class="text-center" width="20%">
                                                <button type="button" class="btn btn-sm btn-clean btn-icon" data-fancybox data-type="ajax" data-src="{{ route('organization.edit', $org->id) }}" data-toggle="tooltip" data-theme="dark" title="Edit Data">
                                                    <span class="la la-2x la-edit text-primary"></span>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-clean btn-icon delete-data" data-id="{{ $org->id }}" data-href="{{ route('organization.destroy', $org->id) }}" data-toggle="tooltip" data-theme="dark" title="Hapus Data">
                                                    <span class="la la-2x la-trash text-danger"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" style="text-align: center">
                                                Data Tidak Ditemukan!
                                            </td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="float: right">
                            {!! $orgs->links() !!}
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
    {{-- <script src="{{ asset('js/pages/User.js') }}" type="text/javascript"></script> --}}
    <script>
        $(document).ready(function() {
            $('.search-btn').click(function(e) {
                e.preventDefault()
                let search = $('#search').val()
                let sports = $('#sports').val()
                sports = (sports !== '' ? 'sports=' + sports : '')
                search = (search !== '' ? 'search=' + search : '')
                if(search !== '' && sports !== '') {
                    window.location.href = '{{ url("organization") }}?' + search + '&' + sports
                } else if(search !== '') {
                    window.location.href = '{{ url("organization") }}?' + search
                } else if(sports !== '') {
                    window.location.href = '{{ url("organization") }}?' + sports
                } else {
                    window.location.href = '{{ url("organization") }}'
                }
            })

            $('.reset-form').click(function(e) {
                e.preventDefault()
                window.location.href = '{{ url("organization") }}'
            })

            $('#table-org .delete-data').click(function(e) {
                e.preventDefault();
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
                            url: $(this).attr('data-href'),
                            type: 'DELETE',
                            success: function(response) {
                                if(response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data Berhasil dihapus',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = "{{ route('organization.index') }}";
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
