@extends('layout.default')
@section('title', 'Dashboard')
@section('content')
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="fas fa-info-circle icon-2x text-primary"></i>
                            </span>
                            <h3 class="card-label mt-2 display-4">Informasi Lainnya
                                </h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#data-vaksinasi">
                                        <span class="nav-icon"><i class="fas fa-syringe"></i></span>
                                        <span class="nav-text font-13 font-weight-bold">Sentra Vaksinasi di Jawa Tengah</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#data-isolasi">
                                        <span class="nav-icon"><i class="fas fa-house-user"></i></span>
                                        <span class="nav-text font-13 font-weight-bold">Tempat Isolasi Terpusat</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="data-vaksinasi" role="tabpanel" aria-labelledby="data-vaksinasi">
                                <div class="table-responsive">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <div class="col-lg-12 col-12">
                                            <div class="input-group">
                                                <input type="text" id="cariDataSentra" class="form-control h-auto" placeholder="Cari Sentra Vaksinasi"
                                                    name="namaRS">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-checkable" id="datatable-vaksinasi">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Sentra Vaksinasi</th>
                                                <th>Alamat</th>
                                                <th>Kab / Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data_vaksinasi as $row => $vaksinasi)
                                                <tr>
                                                    <td class="text-center" width="5%">{!! $row++ !!}</td>
                                                    <td>{{ $vaksinasi->sentra_vaksinasi }}</td>
                                                    <td>{{ $vaksinasi->alamat }}</td>
                                                    <td width="10%">{{ (($vaksinasi->kab_id!=null)?getNamaWilayah($vaksinasi->kab_id):'Provinsi Jawa Tengah') }}</td>
                                                    <td width="5%">{{ (($vaksinasi->kec_id!=null)?getNamaWilayah($vaksinasi->kec_id):'') }}</td>
                                                    <td width="5%">{{ (($vaksinasi->kel_id!=null)?getNamaWilayah($vaksinasi->kel_id):'') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="data-isolasi" role="tabpanel" aria-labelledby="data-isolasi">
                                <div class="table-responsive">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <div class="col-lg-12 col-12">
                                            <div class="input-group">
                                                <input type="text" id="cariDataIsolasi" class="form-control h-auto" placeholder="Cari Tempat Isolasi Terpusat"
                                                    name="namaRS">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-checkable" id="datatable-isolasi">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tempat Isolasi Terpusat</th>
                                                <th>Kapasitas</th>
                                                <th>Kab / Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data_isolasi as $row => $isolasi)
                                                <tr>
                                                    <td class="text-center" width="5%">{!! $row++ !!}</td>
                                                    <td>{{ $isolasi->tempat_isolasi }}</td>
                                                    <td>{{ $isolasi->kapasitas_tt }} Tempat Tidur</td>
                                                    <td width="10%">{{ (($isolasi->kab_id!=null)?getNamaWilayah($isolasi->kab_id):'') }}</td>
                                                    <td width="10%">{{ (($isolasi->kec_id!=null)?getNamaWilayah($isolasi->kec_id):'') }}</td>
                                                    <td width="10%">{{ (($isolasi->kel_id!=null)?getNamaWilayah($isolasi->kel_id):'') }}</td>
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
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
            var dataTableRS = function () {

                $.fn.dataTable.Api.register('column().title()', function () {
                    return $(this.header()).text().trim();
                });

                var initTable = function () {
                    var table = $('#datatable-rumahsakit').DataTable({
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
                            url: '{{ (route('load-data-rs')) }}',
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
                                data: 'nama_rs'
                            },
                            {
                                data: 'alamat_rs'
                            },
                            {
                                data: 'website_rs'
                            },
                            {
                                data: 'no_telp'
                            },
                            {
                                data: 'kabkot'
                            },
                            {
                                data: 'kec'
                            },
                            {
                                data: 'kel'
                            },
                        ],
                        initComplete: function () {
                            var input_filter_timeout;
                            $('#cariDataRumahsakit').on('input', function () {
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

                dataTableRS.init()

        var dataTablePuskesmas = function () {

            $.fn.dataTable.Api.register('column().title()', function () {
                return $(this.header()).text().trim();
            });

            var initTable = function () {
                var table = $('#datatable-puskesmas').DataTable({
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
                        url: '{{ (route('load-data-puskesmas')) }}',
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
                            data: 'nama_wilayah'
                        },
                        {
                            data: 'nama_puskesmas'
                        },
                        {
                            data: 'kepala_puskesmas'
                        },
                        {
                            data: 'no_telp'
                        },
                    ],
                    initComplete: function () {
                        var input_filter_timeout;
                        $('#cariDataPus').on('input', function () {
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

        dataTablePuskesmas.init()

        const KTDatatablesBasicBasic = function () {
            const dataTableSentraVaksin = function dataTableSentraVaksin() {
                    let table = $('#datatable-vaksinasi').DataTable({
                    responsive: true,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    info: false,
                    ordering: false,
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
                $("#cariDataSentra").on("keyup", function (e) {
                    if ($(this).val() === "") {
                        table.search($("#cariDataSentra").val()).draw();
                    } else {
                        table.columns(1).search($("#cariDataSentra").val()).draw();
                    }
                });
            };

            const dataTableIsolasi = function dataTableIsolasi() {
                    let table = $('#datatable-isolasi').DataTable({
                    responsive: true,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    info: false,
                    ordering: false,
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
                $("#cariDataIsolasi").on("keyup", function (e) {
                    if ($(this).val() === "") {
                        table.search($("#cariDataIsolasi").val()).draw();
                    } else {
                        table.columns(3).search($("#cariDataIsolasi").val()).draw();
                    }
                });
            };

            
            return {
                init: function init() {
                    dataTableSentraVaksin();
                    dataTableIsolasi();
                }
            };
            }();

        $(document).ready(function() {
            KTDatatablesBasicBasic.init();
        })
    </script>
@endsection
