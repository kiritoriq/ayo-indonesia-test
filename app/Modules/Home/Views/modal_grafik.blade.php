<script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script>
<div class="container py-5 max-w-800px">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Grafik Laporan Harian Berdasarkan Jenis Aduan
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th width="2%">No</th>
                                <th class="text-center">Jenis Aduan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key=>$data)
                                @if($data->jenis_aduan != 'Total')
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->jenis_aduan }}</td>
                                        <td class="text-right">{{ $data->jml_laporan }}</td>
                                        <td class="text-right">{{ $data->prosentase_show }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            @foreach($datas as $data)
                                @if($data->jenis_aduan == 'Total')
                                    <tr>
                                        <td colspan="2" class="text-center font-weight-bold">{{ $data->jenis_aduan }}</td>
                                        <td class="text-right">{{ $data->jml_laporan }}</td>
                                        <td class="text-right">{{ $data->prosentase_asli }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div id="AduanModal" style="height: 400px"></div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="button" onclick="$.fancybox.close()" class="btn btn-danger">Tutup</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var chartModal = echarts.init(document.getElementById('AduanModal'));
        var optionAduanModal = {
            title: {
                // text: 'Grafik Laporan Harian Hotline Dinkop UMKM Berdasarkan Jenis Aduan'
            },
            legend: {
                orient: 'horizontal',
                left: 'center',
                padding: 10
            },
            tooltip: {
                trigger: 'item',
            },
            xAxis: {
                data: [],
                axisLabel: { interval: 0, rotate: 20 }
            },
            yAxis: {
                name: 'Jumlah Laporan',
                nameLocation: 'middle',
                nameGap: 50
            },
            series: []
        };

        $.ajax({
            url: `{{ route('load-data-grafik-aduan') }}`,
            type: 'post',
            data: { _token: $('meta[name="csrf-token"]').attr('content'), tanggal: '{{ $tanggal }}' },
            success: function(response) {
                var laporan = response.split('\n')
                var series = {
                    name: 'Jumlah Laporan',
                    type: 'pie',
                    radius: '50%',
                    data: [],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                }
                $.each(laporan, function(key, value) {
                    var items = value.split(',')
                    // console.log(items[0])
                    var data_s = {};
                    if(value!='' && items[0]!='Total') {
                        data_s.value = items[1]
                        data_s.name = items[0]
                        // console.log(data_s)
                        series.data.push(data_s)
                        // series.data.name.push(items[0])
                        // series.data.value.push(parseInt(items[1]))
                    }
                });
                optionAduanModal.series.push(series)
                chartModal.setOption(optionAduanModal);
                // console.log(optionAduan)
            }
        })
    })
</script>