@extends('layout.default')
@section('title', 'User')
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                            </span>
                            <h3 class="card-label mt-2 display-4">Master Acara
                            <small>Manajemen Acara</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Filter Data Acara</p>
                        <div class="form-group row fv-plugins-icon-container">
                            <div class="col-lg-6">
                                <input type="text" id="search" name="search" class="form-control" value="{{ Request()->search }}" placeholder="Cari Nama Organisasi">
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control" name="priority" id="priority">
                                    <option value="" {{ Request()->priority == '' ? 'selected' : '' }}>Semua Prioritas Acara</option>
                                    <option value="1" {{ Request()->priority == 1 ? 'selected' : '' }}>Wajib</option>
                                    <option value="2" {{ Request()->priority == 2 ? 'selected' : '' }}>Tidak Wajib</option>
                                    <option value="3" {{ Request()->priority == 3 ? 'selected' : '' }}>Hanya Staff</option>
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
                                    <button data-fancybox data-type="ajax" data-src="{{ route('event.create') }}" class="btn btn-primary btn-sm py-3" title="Buat Acara">
                                        <span class="svg-icon svg-icon-white"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                        </span> Buat Acara
                                    </button>
                                    {{-- ./end of Create Button --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable-init" id="table-event">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">#</th>
                                        <th>Nama Acara</th>
                                        <th>Tanggal, Waktu Acara</th>
                                        <th>Deskripsi Acara</th>
                                        <th>Prioritas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($events) > 0)
                                        @foreach($events as $key => $event)
                                        <tr>
                                            <td class="text-center">{{ (($key+1)+(( $events->currentPage() !=0 )?($events->currentPage()-1):$events->currentPage())*env('APP_PAGE_LIMIT')) }}</td>
                                            <td>{{ $event->event_name }}</td>
                                            <td>
                                                {{ Helper::formatTanggalPanjang($event->event_date) }} {{ date('H:i', strtotime($event->event_time)) }} WIB
                                            </td>
                                            <td>
                                                {{ substr($event->description, 0, 30) }}
                                            </td>
                                            <td>{{ ($event->priority == 1 ? 'Wajib' : ($event->priority == 2 ? 'Tidak Wajib' : 'Hanya Staf')) }}</td>
                                            <td class="text-center" width="20%">
                                                <button type="button" class="btn btn-sm btn-clean btn-icon" data-fancybox data-type="ajax" data-src="{{ route('event.edit', $event->id) }}" data-toggle="tooltip" data-theme="dark" title="Edit Data">
                                                    <span class="la la-2x la-edit text-primary"></span>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-clean btn-icon delete-data" data-id="{{ $event->id }}" data-href="{{ route('event.destroy', $event->id) }}" data-toggle="tooltip" data-theme="dark" title="Hapus Data">
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
                            {!! $events->links() !!}
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
                let priority = $('#priority').val()
                priority = (priority !== '' ? 'priority=' + priority : '')
                search = (search !== '' ? 'search=' + search : '')
                if(search !== '' && priority !== '') {
                    window.location.href = '{{ url("event") }}?' + search + '&' + priority
                } else if(search !== '') {
                    window.location.href = '{{ url("event") }}?' + search
                } else if(priority !== '') {
                    window.location.href = '{{ url("event") }}?' + priority
                } else {
                    window.location.href = '{{ url("event") }}'
                }
            })

            $('.reset-form').click(function(e) {
                e.preventDefault()
                window.location.href = '{{ url("event") }}'
            })

            $('#table-event .delete-data').click(function(e) {
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
                                        window.location.href = "{{ route('event.index') }}";
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
