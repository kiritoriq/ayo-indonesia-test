@extends('layout.default')
@section('title', 'Laporan')
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                            </span>
                            <h3 class="card-label mt-2 display-4">Input Laporan
                            <small>Kelola Data Laporan Masuk</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row fv-plugins-icon-container">
                            <div class="col-lg-10 col-10">
                                <input type="text" id="cari-nama" class="form-control" placeholder="Cari laporan" name="nama">
                            </div>
                            <div class="col-lg-2 col-2">
                                <div class="btn-group btn-group-justified btn-group-xs" role="group" aria-label="Large button group">
                                    <a href="{{ route('laporan.insert') }}" class="btn btn-primary py-3" data-toggle="tooltip" data-theme="dark" title="Tambah Data">
                                        <span class="svg-icon svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                            </g>
                                        </svg></span> Input
                                    </a>
                                    <button class="btn btn-success py-3" data-fancybox data-type="ajax" data-src="{{ route('laporan.get-cetak-excel') }}" data-toggle="tooltip" data-theme="dark" title="Cetak Excel">
                                        <i class="far fa-file-excel text-light"></i> Cetak Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover datatable-init" id="table-instansi" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Nama Pelapor</th>
                                        <th>No. Telp Pelapor</th>
                                        <th>Alamat Pelapor</th>
                                        <th>Isi Laporan</th>
                                        <th>Petugas Input</th>
                                        <th>Tanggal Input</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Nama Pelapor</th>
                                        <th>No. Telp Pelapor</th>
                                        <th>Alamat Pelapor</th>
                                        <th>Isi Laporan</th>
                                        <th>Petugas Input</th>
                                        <th>Tanggal Input</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($laporans as $row => $laporan)
                                    <tr>
                                        <td class="text-center">{!! $row++ !!}</td>
                                        <td>{!! $laporan->nama_pelapor !!}</td>
                                        <td>{!! $laporan->no_telp_pelapor !!}</td>
                                        <td>{!! $laporan->alamat_pelapor !!}</td>
                                        <td>
                                            @if(strlen($laporan->isi_laporan) > 30)
                                                {!! substr_replace($laporan->isi_laporan, ' ...', 30) !!}
                                            @else
                                                {!! $laporan->isi_laporan !!}
                                            @endif
                                        </td>
                                        <td>
                                            {!! $laporan->petugas[0]->username !!}
                                        </td>
                                        <td>{!! formatTanggalPanjang(date('Y-m-d', strtotime($laporan->created_at))) !!}, Pukul {!! date('H:i', strtotime($laporan->created_at)) !!}</td>
                                        <td width="10%" class="text-center">
                                            <button type="button" id="detail" data-id="{{ $laporan->id }}" data-src="{{ route('laporan.details', $laporan->id) }}" data-theme="dark" class="btn btn-sm btn-default btn-text-warning btn-hover-warning btn-icon detail" data-toggle="modal" data-target="#exampleModal" title="Detail">
                                                <span class="svg-icon svg-icon-warning svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-19-122603/theme/html/demo1/dist/../src/media/svg/icons/Text/Menu.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                                        <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                            </button>
                                            <a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" data-toggle="tooltip" data-theme="dark" title="Edit Laporan" href="{{ route('laporan.edit', $laporan->id) }}">
                                                <span class="svg-icon svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                    </g>
                                                </svg></span>
                                            </a>
                                            @if(array_intersect(Session::get('role_id'), [1]))
                                                <button type="button" id="btnDelete" data-id="{!! $laporan->id !!}" data-href="{{ route('laporan.delete', $laporan->id) }}" class="btn btn-delete btn-sm btn-default btn-text-danger btn-hover-primary btn-icon" data-toggle="tooltip" data-theme="dark" title="Hapus Laporan">
                                                    <span class="svg-icon svg-icon-danger"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg></span>
                                                </button>
                                            @endif
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

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                {{-- <button id="" type="button" class="btn btn-primary font-weight-bold">Save changes</button> --}}
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
        const dataControl = function(){
            const deleteUser = function deleteUser(param){
                $('#table-instansi tbody').on('click', '.btn-delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let urls = $(this).attr("data-href");

                Swal.fire({
                    title: `Yakin hapus data ?`,
                    text: `Data yang dihapus tidak dapat dikembalikan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            dataType: "JSON",
                            timeout: 10000,
                            data: {
                                _token: CSRF_TOKEN,
                                id: id
                            },
                            beforeSend: function () {

                            },
                            success: function (data) {
                                if (data.status == "failed") {
                                    Swal.fire({
                                        title: `Terjadi Kesalahan!`,
                                        text: data.msg,
                                        icon: 'error',
                                        showConfirmButtonn: true,
                                        confirmButtonText: 'Ok' 
                                    })
                                } else {
                                    Swal.fire({
                                        title: `Data Berhasil Dihapus`,
                                        icon: 'success',
                                        showConfirmButtonn: true,
                                        confirmButtonText: 'Ok' 
                                    }).then(() => {
                                        window.location.href = "{{ route('laporan.index') }}"
                                    })
                                }
                            },
                            error: function (x, t, m) {

                            }
                        });
                    }
                })
                })
            }

            return {
                init: function init() {
                    deleteUser();
                }
            };
        }();

        const KTDatatablesBasicBasic = function () {
            const dataTableInit = function dataTableInit() {
                    table = $('.datatable-init').DataTable({
                    responsive: true,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    info: false,
                    language: {
                        'lengthMenu': 'Display _MENU_'
                    },
                    columnDefs: []
                    });

                table.on('order.dt search.dt', function () {
                    table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();

                $("#cari-nama").on("keyup", function (e) {
                    if ($(this).val() === "") {
                        table.search($("#cari-nama").val()).draw();
                    } else {
                        table.columns(1).search($("#cari-nama").val()).draw();
                    }
                });

            };

            
            return {
                init: function init() {
                dataTableInit();
                }
            };
        }();
        $(document).ready(function() {
            KTDatatablesBasicBasic.init();
            dataControl.init();
            $('.detail').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: site_url + "laporan/details/"+id,
                type: 'get',
                success: function(response) {
                    $('#exampleModal .modal-body').html(response);
                    $('#exampleModal').modal('show');
                } 
            })
        })
        })
    </script>
@endsection