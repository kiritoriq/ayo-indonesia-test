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
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-body d-flex align-items-center justify-content-between flex-lg-wrap-reverse">
                        <div class="mr-2">
                            <h3 class="font-weight-bolder">Data Stok Obat</h3>
                            <div class="text-dark-50 font-size-lg mt-2">Klik tombol untuk menuju website Kemkes</div>
                        </div>
                        <a href="https://farmaplus.kemkes.go.id/" target="_blank" rel="noopener noreferrer" class="btn btn-primary font-weight-bold py-3 px-6">
                            Lihat Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5 mt-3">
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
                        label: {
                            show: true,
                            position: 'top'
                        }
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
