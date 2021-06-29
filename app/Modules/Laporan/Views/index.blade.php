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
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span>
                            </span>
                            <h3 class="card-label mt-2 display-4">Input Laporan
                                <small>Kelola Data Laporan Masuk</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row fv-plugins-icon-container">
                            <div class="col-lg-10 col-10">
                                <input type="text" id="cariData" class="form-control" placeholder="Cari laporan"
                                    name="nama">
                            </div>
                            <div class="col-lg-2 col-2">
                                <div class="btn-group btn-group-justified btn-group-xs" role="group"
                                    aria-label="Large button group">
                                    <a href="{{ route('laporan.insert') }}"
                                        class="btn btn-primary py-3" data-toggle="tooltip" data-theme="dark"
                                        title="Tambah Data">
                                        <span class="svg-icon svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
                                                        x="4" y="11" width="16" height="2" rx="1" />
                                                </g>
                                            </svg></span> Input
                                    </a>
                                    <button class="btn btn-success py-3" data-fancybox data-type="ajax"
                                        data-src="{{ route('laporan.get-cetak-excel') }}"
                                        data-toggle="tooltip" data-theme="dark" title="Cetak Excel">
                                        <i class="far fa-file-excel text-light"></i> Cetak Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-laporan" width="100%">
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
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>

{{-- page scripts --}}
<script type="text/javascript">
    var dataTableLaporanWarga = function () {

        $.fn.dataTable.Api.register('column().title()', function () {
            return $(this.header()).text().trim();
        });

        var initTable = function () {
            var table = $('#table-laporan').DataTable({
                retrieve: true,
                ordering: false,
                destroy: true,
                responsive: true,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                info: true,
                paging: true,
                fixedHeader: true,
                language: {
                    'lengthMenu': 'Display _MENU_',
                    "processing": "Mengambil data ...",
                    "zeroRecords": "Data belum tersedia!"
                },
                searchDelay: 50220,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ (route('load-data')) }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        cari_data: $('#cariData').val()
                    }
                },
                columnDefs: [
                    // {
                    //     targets: [2, 6],
                    //     className: 'text-center'
                    // },
                    // {
                    //     targets: [4],
                    //     className: 'text-right'
                    // },
                ],
                columns: [{
                        data: 'no'
                    },
                    {
                        data: 'nama_pelapor'
                    },
                    {
                        data: 'no_telp_pelapor'
                    },
                    {
                        data: 'alamat_pelapor'
                    },
                    {
                        data: 'isi_laporan'
                    },
                    {
                        data: 'petugas_input'
                    },
                    {
                        data: 'tanggal_input'
                    },
                    {
                        data: 'aksi'
                    }
                ],
                initComplete: function () {
                    var input_filter_timeout;
                    $('#cariData').on('input', function () {
                        cari_data = this.value
                        table = table

                        clearTimeout(input_filter_timeout);
                        input_filter_timeout = setTimeout(function () {
                            if (table.search() !== cari_data) table.search(
                                cari_data).draw();
                        }, 500);
                    });

                }

            });
        };

        return {
            init: function () {
                initTable();
            },

        }
    }();

    dataTableLaporanWarga.init()

    /*
        End Of Data Table
    */

    const dataControl = function () {
        const deleteUser = function deleteUser(param) {
            $('#table-laporan tbody').on('click', '.btn-delete', function (e) {
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
                                        window.location.href =
                                            "{{ route('laporan.index') }}"
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
        $(document).ready(function() {
            // KTDatatablesBasicBasic.init();
            dataControl.init();
        })
    </script>
@endsection
