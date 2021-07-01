@extends('layout.default')
@section('title', 'Dashboard')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="alert alert-custom alert-white wave wave-animate wave-primary shadow fade show gutter-b" role="alert">
                    <div class="alert-icon">
                        <span class="svg-icon svg-icon-warning svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/General/Smile.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/>
                                <path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000000"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    </div>
                    <div class="alert-text">Selamat datang di Aplikasi Hotline Corona Jateng.</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-10 mt-3">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div id="chart" style="height: 400px"></div>
                        {{-- <div class="pt-5" style="background-color: #ffff">
                            <h2 class="text-center mb-5">Grafik Laporan Harian Hotline Corona Jateng</h2>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#data-rumahsakit">
                                        <span class="nav-icon"><i class="fas fa-hospital-alt"></i></span>
                                        <span class="nav-text font-13 font-weight-bold">Data Rumah Sakit Jawa Tengah</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#data-puskesmas">
                                        <span class="nav-icon"><i class="far fa-hospital"></i></span>
                                        <span class="nav-text font-13 font-weight-bold">Puskesmas Jawa Tengah</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#data-rs">
                                        <span class="nav-icon"><i class="fas fa-hospital-alt"></i></span>
                                        <span class="nav-text font-13 font-weight-bold">Data Direktur Rumah Sakit Jawa Tengah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="data-rumahsakit" role="tabpanel" aria-labelledby="data-rumahsakit">
                                <div class="table-responsive">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <div class="col-lg-12 col-12">
                                            <div class="input-group">
                                                <input type="text" id="cariDataRumahsakit" class="form-control h-auto" placeholder="Cari Rumah Sakit"
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
                                    <table class="table table-bordered table-hover table-checkable" id="datatable-rumahsakit">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Rumah Sakit</th>
                                                <th>Alamat Rumah Sakit</th>
                                                <th>Website</th>
                                                <th>Nomor Telepon</th>
                                                <th>Kab / Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="data-puskesmas" role="tabpanel" aria-labelledby="data-puskesmas">
                                <div class="table-responsive">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <div class="col-lg-12 col-12">
                                            <div class="input-group">
                                                <input type="text" id="cariDataPus" class="form-control h-auto" placeholder="Cari Puskesmas"
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
                                    <table class="table table-bordered table-hover table-checkable" id="datatable-puskesmas">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Wilayah Puskesmas</th>
                                                <th>Nama Puskesmas</th>
                                                <th>Kepala Puskesmas</th>
                                                <th>Nomor Telepon</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="data-rs" role="tabpanel" aria-labelledby="data-rs">
                                <div class="table-responsive">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <div class="col-lg-12 col-12">
                                            <div class="input-group">
                                                <input type="text" id="cariDataRS" class="form-control h-auto" placeholder="Cari Rumah Sakit"
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
                                    <table class="table table-bordered table-hover table-checkable" id="datatable-rs">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Rumah Sakit</th>
                                                <th>Kelas Rumah Sakit</th>
                                                <th>Nama Direktur RS</th>
                                                <th>Nomor Telepon</th>
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

        var dataTableDirRs = function () {

            $.fn.dataTable.Api.register('column().title()', function () {
                return $(this.header()).text().trim();
            });

            var initTable = function () {
                var table = $('#datatable-rs').DataTable({
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
                        url: '{{ (route('load-data-dir-rs')) }}',
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
                            data: 'kls_rs'
                        },
                        {
                            data: 'nama_direktur'
                        },
                        {
                            data: 'no_telp'
                        },
                    ],
                    initComplete: function () {
                        var input_filter_timeout;
                        $('#cariDataRS').on('input', function () {
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

        dataTableDirRs.init()

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

        $(document).ready(function() {
            var chart = echarts.init(document.getElementById('chart'));
            var option = {
                title: {
                    text: 'Grafik Laporan Harian Hotline Corona Jateng'
                },
                tooltip: {},
                dataZoom: [{
                    type: 'inside'
                }, {
                    type: 'slider'
                }],
                xAxis: {
                    data: []
                },
                yAxis: {
                    name: 'Laporan',
                    nameLocation: 'middle',
                    nameGap: 50
                },
                series: []
            };
            $.ajax({
                url: `{{ route('load-data-grafik') }}`,
                type: 'post',
                data: { _token: $('meta[name="csrf-token"]').attr('content'), },
                success: function(response) {
                    var laporan = response.split('\n')
                    var series = {
                        name: 'Jumlah Laporan Harian',
                        type: 'bar',
                        data: [],
                        itemStyle: {
                            color: 'rgba(0, 170, 19, 1)'
                        },
                    }
                    $.each(laporan, function(key, value) {
                        var items = value.split(',')
                        console.log(value)
                        if(value!='') {
                            option.xAxis.data.push(items[0])
                            series.data.push(parseInt(items[1]))
                        }
                    });
                    option.series.push(series)
                    chart.setOption(option);
                }
            })
            
        })
    </script>
@endsection
