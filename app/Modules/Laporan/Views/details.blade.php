                <table class="table table-hover table-borderless">
                    <tr>
                        <td width="30%">Nama Pelapor</td>
                        <td>{{ $laporan->nama_pelapor }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Pelapor</td>
                        <td>{{ $laporan->alamat_pelapor }}</td>
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
                            <div>
                                <small>Id Petugas: {!! $laporan->user_id !!}</small>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Tanggal Input</td>
                        <td>
                            {!! formatTanggalPanjang(date('Y-m-d', strtotime($laporan->created_at))) !!}, Pukul {!! date('H:i', strtotime($laporan->created_at)) !!}
                        </td>
                    </tr>
                </table>