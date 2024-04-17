@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('transaksi') }}" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tanggal</label>
                    <div class="col-11">
                        <?php
                        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke WIB
                        $currentDateTime = date('Y-m-d\TH:i');
                        ?>
                        <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                            value="<?= $currentDateTime ?>" required>
                        @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode Penjualan</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                            value="{{ old('penjualan_kode') }}" required>
                        @error('penjualan_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kasir</label>
                    <div class="col-11">
                        <select class="form-control" id="user_id" name="user_id" value="{{ old('nama') }}" required>
                            <option value="">- Pilih Kasir -</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Pembeli</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="pembeli" name="pembeli"
                            value="{{ old('pembeli') }}" required>
                        @error('pembeli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>


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
                        <button type="button" class="btn btn-sm btn-success mb-4" id="btn-tambah-barang"
                            onclick="addBarangRow()">
                            Tambah Barang
                        </button>

                        <tr>
                            <td>
                                <select class="form-control barang-select" name="barang_id[]" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->barang_id }}" data-harga="{{ $item->harga_jual }}">
                                            {{ $item->barang_nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="harga" name="harga[]" id="">
                                {{-- <span class="harga" name="harga[]" readonly></span> --}}
                            </td>
                            <td>
                                <input type="number" class="form-control jumlah" id="jumlah" name="jumlah[]" required>
                                @error('jumlah')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="total" name="total[]">
                                {{-- <span class="total"></span> --}}
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="center"><strong>Total Keseluruhan</strong></td>
                            <td><strong><span id="total-keseluruhan"></span></strong></td>
                        </tr>
                    </tfoot>
                </table>



                <div class="form-group row">
                    {{-- <label class="col-1 control-label col-form-label"></label> --}}
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('transaksi') }}">Kembali</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        document.querySelectorAll('.barang-select').forEach(select => {
            select.addEventListener('change', function() {
                console.log(select);
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                const hargaElement = this.closest('tr').querySelector('.harga');
                hargaElement.value = harga;
            });
        });

        // Function to update total harga
        function updateTotalHarga(input) {
            const tr = input.closest('tr');
            const harga = parseFloat(tr.querySelector('.harga').value);
            const jumlah = parseFloat(input.value);
            const total = isNaN(harga) || isNaN(jumlah) ? 0 : harga * jumlah;
            tr.querySelector('.total').value = total.toFixed(2);

            // Update total keseluruhan
            updateTotalKeseluruhan();
        }

        // Function to update total keseluruhan
        function updateTotalKeseluruhan() {
            let totalKeseluruhan = 0;
            document.querySelectorAll('.total').forEach(total => {
                totalKeseluruhan += parseFloat(total.value);
            });
            document.getElementById('total-keseluruhan').textContent = totalKeseluruhan.toFixed(2);
        }

        // Add event listeners to input jumlah
        document.querySelectorAll('.jumlah').forEach(input => {
            input.addEventListener('input', function() {
                updateTotalHarga(this);
            });
        });

        // Trigger input event manually to calculate the total when the page loads
        document.querySelectorAll('.jumlah').forEach(input => {
            updateTotalHarga(input);
        });

        function addBarangRow() {
            const tbody = document.querySelector('.table tbody');
            const lastRow = tbody.lastElementChild.cloneNode(true);

            console.log(lastRow);
            const hargaElement = lastRow.querySelector('.harga');
            const jumlahInput = lastRow.querySelector('.jumlah');
            const totalCell = lastRow.querySelector('.total');

            hargaElement.value = ''

            // Reset nilai input jumlah
            jumlahInput.value = '';

            // Reset nilai total
            totalCell.value = '';

            // Append baris baru
            tbody.appendChild(lastRow);
            document.querySelectorAll('.barang-select').forEach(select => {
                select.addEventListener('change', function() {
                    console.log(select);
                    const selectedOption = this.options[this.selectedIndex];
                    const harga = selectedOption.getAttribute('data-harga');
                    const hargaElement = this.closest('tr').querySelector('.harga');
                    hargaElement.value = harga;
                });
            });

            document.querySelectorAll('.jumlah').forEach(input => {
                input.addEventListener('input', function() {
                    updateTotalHarga(this);
                });
            });
        }
    </script>
@endsection
@push('css')
@endpush
@push('js')
@endpush
