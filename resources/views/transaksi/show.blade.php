@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($transaksi)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table sm mb-2">
                    <tr>
                        <th>ID</th>
                        <td>{{ $transaksi->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $transaksi->penjualan_tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Kasir</th>
                        <td>{{ $transaksi->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $transaksi->pembeli }}</td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped table-hover table sm">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($detailTransaksi as $d)
                            @php
                                $totalHargaBarang = $d->harga * $d->jumlah;
                                $total += $totalHargaBarang;
                            @endphp

                            <tr>
                                <td>{{ $d->barang->barang_nama }}</td>
                                <td>{{ $d->harga }}</td>
                                <td>{{ $d->jumlah }}</td>
                                <td>{{ $totalHargaBarang }} </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada detail barang</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3" align="center"><strong> Total Keseluruhan</strong></td>
                            <td>{{ $total }} </td>
                        </tr>
                    </tfoot>
                </table>
            @endempty
            <a href="{{ url('transaksi') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
