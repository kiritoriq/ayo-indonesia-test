<div class="container py-5 max-w-700px">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Detail Laporan
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-borderless">
                <tr>
                    <td width="30%">Nama Pelapor</td>
                    <td>{{ $laporan->nama_pelapor }}</td>
                </tr>
                <tr>
                    <td width="30%">Alamat Pelapor</td>
                    <td>{{ $laporan->alamat_pelapor.(($laporan->kel_id != null)?', KEL. '.getNamaWilayah($laporan->kel_id):'').(($laporan->kec_id != null)?', KEC. '.getNamaWilayah($laporan->kec_id):'').(($laporan->kab_id != null)?', '.getNamaWilayah($laporan->kab_id):'').(($laporan->prov_id != null)?', '.getNamaWilayah($laporan->prov_id):'') }}</td>
                </tr>
                <tr>
                    <td width="30%">No. Telp. Pelapor</td>
                    <td>{{ $laporan->no_telp_pelapor }}</td>
                </tr>
                <tr>
                    <td width="30%">No. Telp. Pelapor</td>
                    <td>
                        {{ $laporan->isi_laporan }}
                    </td>
                </tr>
                <tr>
                    <td width="30%">Solusi</td>
                    <td>
                        {{ $laporan->solusi }}
                    </td>
                </tr>
                <tr>
                    <td width="30%">Jenis Pelapor</td>
                    <td>
                        {{ ($laporan->instansi==1)?'Umum':'Faskes' }}
                    </td>
                </tr>
                @if($laporan->instansi==2)
                <tr>
                    <td width="30%">Asal Instansi</td>
                    <td>
                        {{ $laporan->asal_instansi }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td width="30%">Petugas Input</td>
                    <td>
                        <strong>{!! $laporan->petugas[0]->username !!}</strong>
                    </td>
                </tr>
                <tr>
                    <td width="30%">Tanggal Input</td>
                    <td>
                        {!! formatTanggalPanjang(date('Y-m-d', strtotime($laporan->created_at))) !!}, Pukul {!! date('H:i', strtotime($laporan->created_at)) !!}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-right">
            <button type="button" onclick="$.fancybox.close()" class="btn btn-danger">Tutup</button>
        </div>
    </div>
</div>
