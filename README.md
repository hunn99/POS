<div align=center>

# <strong> Laporan Praktikum Web Lanjut </strong>

## <strong>2241720107 | Denny Malik Ibrahim | 12 | TI-2H<br><hr>

# <strong> Jobsheet 2 <br> (Routing, Controller, dan View) </strong>

</div>

<br>

## Tugas

Home <br>
Menampilkan halaman awal website (route basic)<br>

![alt text](images/js3/image.png)<br>

Products <br>
Menampilkan daftar product (route prefix)<br>

![alt text](images/js3/image-1.png)<br>
![alt text](images/js3/image-2.png)<br>
![alt text](images/js3/image-3.png)<br>
![alt text](images/js3/image-4.png)<br>

User <br>
Menampilkan profil pengguna (route param)<br>

![alt text](images/js3/image-5.png)<br>

Transaksi <br>
Menampilkan halaman transaksi (route basic)<br>

![alt text](images/js3/image-6.png)
<br>

<hr>
<br>
<br>

<div align=center>

# Jobsheet 3 <br> (Migration, Seeder, DB Facade, Query Builder, dan Eloquent ORM)

</div>

## 😊👉 [Laporan disini](laporan/Jobsheet-3_PWL_DennyMalikIbrahim_TI-2H.pdf) 👈😊

<br>
<hr>
<br>
<br>

<div align=center>

# Jobsheet 4 <br> (Model dan Eloquent ORM)

</div>

<br>

## A. PROPERTI $fillable DAN $guarded

### Praktikum 1 - $fillable

1. Menambahkan $fillable di model UserModel

    ```php
    protected $fillable = ['level_id', 'username', 'nama', 'password'];
    ```

2. Mengubah script pada UserController
    ```php
    public function index()
    {
        $data = [
            'level_id' => 2,
            'username' => 'manager_dua',
            'nama' => 'Manager 2',
            'password' => Hash::make('12345')
        ];
        UserModel::create($data);
        //coba akses model usermodel
        $user = UserModel::all(); //ambil semua data dari tabel m_user
        return view('user', ['data' => $user]);
    }
    ```
3. localhostPWL_POS/public/user<br>
   ![alt text](images/js4/p1.1.png)

    Terlihat ada penambahan data manager 2

4. Mengubah file model UserModel.php

    ```php
    protected $fillable = ['level_id', 'username', 'nama'];
    ```

5. Mengubah bagian array pada $data di UserController

    ```php
    'username' => 'manager_tiga',
    'nama' => 'Manager 3',
    ```

6. localhostPWL_POS/public/user<br>
   ![alt text](images/js4/p1.2.png)

    Terjadi error, karena field password tidak memiliki default valuenya

### $guarded

-- Kebalikan dari $fillable. Semua kolom yang ditambahkan ke $guarded akan **diabaikan** oleh Eloquent ketika melakukan **insert/ update**.
Secara default $guarded isinya array("*"),
berarti semua atribut tidak bisa diset melalui *mass assignment\*.

_Mass Assignment_ adalah fitur canggih yang menyederhanakan proses pengaturan beberapa
atribut model sekaligus, menghemat waktu dan tenaga.

## B. RETRIEVING SINGLE MODELS

### Praktikum 2.1 - Retrieving Single Models

1. Mengubah script pada UserController

    ```php
    $user = UserModel::find(1);
    ```

2. Mengubah view user.blade

    ```php
    <tr>
        <td>{{$data->user_id}} </td>
        <td>{{$data->username}} </td>
        <td>{{$data->nama}} </td>
        <td>{{$data->level_id}} </td>
    </tr>
    ```

3. Hasil<br>
   ![alt text](images/js4/p2.1.png)

4. Mengubah script pada UserController

    ```php
    $user = UserModel::where('level_id', 1)->first();
    ```

5. Hasil<br>
   ![alt text](images/js4/p2.1.png)

6. Mengubah script pada UserController

    ```php
    $user = UserModel::firstWhere('level_id', 1);
    ```

7. Hasil<br>
   ![alt text](images/js4/p2.1.png)<br>

    Ketiga cara diatas adalah cara yang berbeda dengan hasil yang sama<br>

    -- Tindakan lain jika tidak ada hasil lain yang ditemukan menggunakan metode **findOr** dan **firstOr** yang akan mengembalikan satu contoh model atau akan menjalankan didalam fungsi <br>

    ```php
     $user = UserModel::findOr(1, function(){
        // ...
    });

    $user = UserModel::where('level_id', '>', 3)->firstOr(function(){
        // ...
    });
    ```

8. Mengubah script pada UserController

    ```php
    $user = UserModel::findOr(1, ['username', 'nama'], function(){
            abort(404);
    });
    ```

9. Hasil<br>
   ![alt text](images/js4/p2.2.png)<br>

    Data yang keluar hanya username dan nama, pada level_id 1, karena hanya data dari 2 field tersebut yang diambil

10. Mengubah script pada UserController

    ```php
    $user = UserModel::findOr(20, ['username', 'nama'], function(){
            abort(404);
    });
    ```

11. Hasil<br>
    ![alt text](images/js4/p2.3.png)
    Jika tidak ada hasil yang diinginkan, maka akan menjalankan fungsi _abort(404)_

### Praktikum 2.2 - Not Found Exceptions

-- Metode findOrFail dan firstOrFail akan
mengambil hasil pertama dari kueri; namun, jika tidak ada hasil yang ditemukan, sebuah
Illuminate\Database\Eloquent\ModelNotFoundException akan dilempar

1. Mengubah script pada UserController

    ```php
    $user = UserModel::findOrFail(1);
    ```

2. Hasil<br>
   ![alt text](images/js4/p2.4.png)

3. Mengubah script pada UserController

    ```php
    $user = UserModel::where('username', 'manager9')->firstOrFail();
    ```

4. Hasil<br>
   ![alt text](images/js4/p2.5.png)<br>
   Di database tidak ada username 'manager9'

### Praktikum 2.3 - Retreiving Aggregrates

1. Mengubah script pada UserController

    ```php
    $user = UserModel::where('level_id', '2')->count();
    dd($user);
    ```

2. Hasil<br>
   ![alt text](images/js4/p2.6.png)<br>
   'level_id' yang bernilai 2 ada 3

3. Menampilkan seperti dibawah ini

    ```php
     <tr>
        <th>Jumlah Pengguna</th>
    </tr>
    <tr>
        <td>{{$data}}</td>
    </tr>
    ```

    Hasil<br>
    ![alt text](images/js4/P2.7.png)

### Praktikum 2.4 - Retreiving or Creating Models

1. Mengubah script pada UserController

    ```php
    $user = UserModel::firstOrCreate(
        [
            'username' => 'manager',
            'nama' => 'Manager',
        ],
    );
    ```

2. Mengubah view user

    ```php
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nama</th>
        <th>ID Level Pengguna</th>
    </tr>

    <tr>
        <td>{{$data->user_id}} </td>
        <td>{{$data->username}} </td>
        <td>{{$data->nama}} </td>
        <td>{{$data->level_id}} </td>
    </tr>
    ```

3. Hasil<br>
   ![alt text](images/js4/p2.8.png)<br>
   Karena username 'manager' sudah maka, firstoOrCreate hanya mengambil data yang ada

4. Mengubah script pada UserController

    ```php
    $user = UserModel::firstOrCreate(
        [
            'username' => 'manager22',
            'nama' => 'Manager Dua Dua',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ],
    );
    ```

5. Hasil<br>
   ![alt text](images/js4/p2.9.png)<br>
   Karena tidak ada username 'manager22', maka firstoOrCreate memambahkan data tersebut

6. Mengubah script pada UserController

    ```php
    $user = UserModel::firstOrNew(
        [
                'username' => 'manager',
                'nama' => 'Manager',
        ],
    );
    ```

7. Hasil<br>
   ![alt text](images/js4/p2.10.png)<br>
   Hasilnya sama dengan firstOrCreate

8. Mengubah script pada UserController

    ```php
    $user = UserModel::firstOrNew(
        [
            'username' => 'manager33',
            'nama' => 'Manager Tiga Tiga',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ],
    );
    ```

9. Hasil<br>
   ![alt text](images/js4/p2.11.png)<br>
   Username 'manager33' tidak ada di database, dan oleh firstOrNew data akan ditampilkan, namun belum disimpan ke database, oleh karena itu pada saat ditampilkan tidak ada ID nya

10. Mengubah script pada UserController

    ```php
    $user = UserModel::firstOrNew(
        [
           'username' => 'manager33',
            'nama' => 'Manager Tiga Tiga',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ],
    );
    $user->save();
    ```

11. Hasil<br>
    ![alt text](images/js4/p2.12.png)<br>
    Pada firstOrNew perlu adanya tambahan metode save untuk secara manual di simpan di database

### Praktikum 2.5 - Attribute Changes

-- Eloquent menyediakan metode isDirty, isClean, dan wasChanged untuk memeriksa
keadaan internal model
Metode isDirty menentukan apakah ada atribut model yang telah diubah sejak model diambil
Metode isClean akan
menentukan apakah suatu atribut tetap tidak berubah sejak model diambil

1. Mengubah script pada UserController

    ```php
     $user = UserModel::create([
            'username' => 'manager55',
            'nama' => 'Manager55',
            'password' => Hash::make(12345),
            'level_id' => 2,
    ]);

    $user->username = 'manager56';

    $user->isDirty(); // true
    $user->isDirty('username'); // true
    $user->isDirty('nama'); // false
    $user->isDirty(['nama', 'username']); // true

    $user->isClean(); // false
    $user->isClean('username'); // false
    $user->isClean('nama'); // true
    $user->isClean(['nama', 'username']); // false

    $user->save();

    $user->isDirty(); // false
    $user->isClean(); // true
    dd($user->isDirty());
    ```

2. Hasil<br>
   ![alt text](images/js4/p2.13.png)<br>
   Output isDirty() akan false karena setelah di simpan tidak ada perubahan, karena isDirty menentukan apakah ada atribut model yang telah diubah sejak model diambil

3. Mengubah script pada UserController

    ```php
    $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make(12345),
            'level_id' => 2,
    ]);

    $user->username = 'manager12';

    $user->save();

    $user->wasChanged(); // true
    $user->wasChanged('username'); // true
    $user->wasChanged(['username', 'level_id']); // true
    $user->wasChanged('nama'); // false
    dd($user->wasChanged(['nama', 'username'])); //true
    ```

4. Hasil<br>
   ![alt text](images/js4/p2.14.png)<br>
   Hasilnya true karena wasChanged memeriksa keadaan internal model dan menentukan bagaimana atributnya berubah sejak model pertama kali diambil.

### Praktikum 2.6 - Create, Read, Update, Delete (CRUD)

1. Mengubah script pada view user

    ```php
    <body>
        <h1>Data User</h1>
        <a href="/user/tambah">+ Tambah User</a>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
                <th>Aksi</th>
            </tr>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->user_id }} </td>
                    <td>{{ $d->username }} </td>
                    <td>{{ $d->nama }} </td>
                    <td>{{ $d->level_id }} </td>
                    <td><a href="/user/ubah/{{ $d->user_id }}">Ubah</a> | <a href="/user/hapus/{{ $d->user_id }}">Hapus</a></td>
                </tr>
            @endforeach

        </table>
        </body>
    ```

2. Mengubah script pada UserController

    ```php
    $user = UserModel::all();
    return view('user', ['data' => $user]);
    ```

3. Hasil<br>
   ![alt text](images/js4/p2.15.png)<br>
   Terdapat aksi untuk tambah, ubah dan hapus. Tetapi jika di tekan akan error karena masih belum mendefinikan route, view, dan controllernya

4. Menambahkan file user_tambah pada view

    ```php
    <body>
        <h1>Form Tambah Data User</h1>
        <form method="post" action="/user/tambah_simpan">

            {{ csrf_field() }}

            <label for="">Username</label>
            <input type="text" name="username" placeholder="Masukan Username" >
            <br>
            <label for="">Nama</label>
            <input type="text" name="nama" placeholder="Masukan Nama">
            <br>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Masukan Password">
            <br>
            <label for="">Level ID</label>
            <input type="number" name="level_id" placeholder="Masukan ID Level">
            <br><br>
            <input type="submit" class="btn btn-success" value="Simpan">
        </form>
    </body>
    ```

5. Menambah script pada route

    ```php
    Route::get('/user/tambah', [UserController::class, 'tambah']);
    ```

6. Menambah script pada UserController

    ```php
    public function tambah()
    {
        return view('user_tambah');
    }
    ```

7. Hasil<br>
   ![alt text](images/js4/p2.16.png)

8. Menambah script pada route

    ```php
    Route::get('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
    ```

9. Menambah script pada UserController

    ```php
    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }
    ```

10. Hasil<br>
    ![alt text](images/js4/p2.17.png)<br>
    ![alt text](images/js4/p2.18.png)<br>
    Setelah mengisi form akan kembali ke halaman user dan terlihat ada data yang ditambahkan

11. Membuat update atau ubah data user

    ```php
    <body>
    <h1>Form Ubah Data User</h1>
    <a href="/user">Kembali</a>
    <br><br>

    <form action="/user/ubah_simpan/{{ $data->user_id }}" method="post">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label for="">Username</label>
        <input type="text" name="username" placeholder="Masukan Username" value="{{ $data->username }}">
        <br>
        <label for="">Nama</label>
        <input type="text" name="nama" placeholder="Masukan Nama" value="{{ $data->nama }}">
        <br>
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Masukan Password" value="{{ $data->password }}">
        <br>
        <label for="">Level ID</label>
        <input type="number" name="level_id" placeholder="Masukan ID Level" value="{{ $data->level_id }}">
        <br><br>
        <input type="submit" class="btn btn-success" value="Ubah">

    </form>
    </body>
    ```

12. Menambah script pada routes

    ```php
    Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
    ```

13. Menambah script pada UserController

    ```php
    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    ```

14. Hasil<br>
    ![alt text](images/js4/p2.19.png)<br>

15. Menambah script pada routes

    ```php
    Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
    ```

16. Menambah script pada UserController

    ```php
    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect ('/user');
    }
    ```

17. Hasil<br>
    ![alt text](images/js4/p2.20.png)<br>
    Mengubah level_id menjadi 2

    ![alt text](images/js4/p2.21.png)<br>
    Setelah mengubah kembali ke halaman user dengan level_id denny berubah jadi 2

18. Menambah script pada routes

    ```php
    Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
    ```

19. Menambah script pada UserController

    ```php
    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
    ```

20. Hasil<br>
    ![alt text](images/js4/p2.22.png)<br>
    ![alt text](images/js4/p2.23.png)<br>
    Data denny telah dihapus

### Praktikum 2.7 - Relationships

1. Menambah script pada UserModel

    ```php
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    ```

    Lalu membuat model LevelModel dan mengisinya seperti UserModel

2. Mengubah script pada UserController

    ```php
    public function index()
    {
        $user = UserModel::with('level')->get();
        dd($user);
    }
    ```

3. Hasil<br>
   ![alt text](images/js4/p2.24.png)

4. Mengubah script pada UserController

    ```php
    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }
    ```

5. Mengubah script view user

    ```php
    <body>
    <h1>Data User</h1>
    <a href="/user/tambah">+ Tambah User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->user_id }} </td>
                <td>{{ $d->username }} </td>
                <td>{{ $d->nama }} </td>
                <td>{{ $d->level_id }} </td>
                <td>{{ $d->level->level_kode }} </td>
                <td>{{ $d->level->level_nama }} </td>
                <td><a href="/user/ubah/{{ $d->user_id }}">Ubah</a> | <a
                        href="/user/hapus/{{ $d->user_id }}">Hapus</a></td>
            </tr>
        @endforeach

    </table>
    </body>
    ```

6. Hasil<br>
   ![alt text](images/js4/p2.25.png)<br>
   Terlihat ada penambahan kolom level kode dan level nama yang diambil dari tabel m_level

<br>
<hr>
<br>
<br>

<div align=center>

# Jobsheet 5 <br> (Blade View, Web Templating(AdminLTE), Datatables)

</div>

<br>

##

### Praktikum 1 – Integrasi Laravel dengan AdminLte3

1. Menjalankan command (composer require jeroennoten/laravel-adminlte), untuk mendefinisikan requirement project <br>
   ![alt text](images/js5/p1.1.png)<br>

2. Melakukan instalasi requirement project di atas dengan command (php artisan adminlte:install)<br>
   ![alt text](images/js5/p1.2.png)<br>

3. Membuat file resources/views/layout/app.blade.php<br>
   ![alt text](images/js5/p1.3.png)<br>
   dan mengisi dengan kode berikut:

    ```php
    @extends('adminlte::page')
    {{-- Extend and customize the browser title --}}
    @section('title')
        {{ config('adminlte.title') }}
        @hasSection('subtitle')
            | @yield('subtitle')
        @endif
    @stop
    {{-- Extend and customize the page content header --}}
    @section('content_header')
        @hasSection('content_header_title')
            <h1 class="text-muted">
                @yield('content_header_title')
                @hasSection('content_header_subtitle')
                    <small class="text-dark">
                        <i class="fas fa-xs fa-angle-right text-muted"></i>
                        @yield('content_header_subtitle')
                    </small>
                @endif
            </h1>
        @endif
    @stop
    {{-- Rename section content to content_body --}}
    @section('content')
        @yield('content_body')
    @stop
    {{-- Create a common footer --}}
    @section('footer')
        <div class="float-right">
            Version: {{ config('app.version', '1.0.0') }}
        </div>
        <strong>
            <a href="{{ config('app.company_url', '#') }}">
                {{ config('app.company_name', 'My company') }}
            </a>
        </strong>
    @stop
    {{-- Add common Javascript/Jquery code --}}
    @push('js')
        <script>
            $(document).ready(function() {
                // Add your common script logic here...
            });
        </script>
    @endpush
    {{-- Add common CSS customizations --}}
    @push('css')
        <style type="text/css">
            {{-- You can add AdminLTE customizations here --}}
            /*
            .card-header {
                border-bottom: none;
            }
            .card-title {
                font-weight: 600;
            }
            */
        </style>
    @endpush
    ```

4. Mengedit resources/views/welcome.blade.php dan mereplace dengan kode berikut

5. Menuju ke browser
   ![alt text](images/js5/p1.4.png)

### Praktikum 2 – Integrasi dengan DataTables

1. Menginstall laravel data tabel<br>

    - composer require laravel/ui --dev
    - composer require yajra/laravel-datatables:^10.0<br>

    ![alt text](images/js5/p2.1.png)<br>
    ![alt text](images/js5/p2.2.png)<br>

2. Melakukan perintah npm -v<br>
   ![alt text](images/js5/p2.3.png)<br>

3. Menginstall Laravel DataTables Vite dan sass<br>

    - npm i laravel-datatables-vite --save-dev
    - npm install -D sass<br>

    ![alt text](images/js5/p2.4.png)<br>
    ![alt text](images/js5/p2.5.png)

4. Mengedit file resources/js/app.js

    ```php
    import './bootstrap';
    import "../sass/app.scss";
    import 'laravel-datatables-vite';
    ```

5. Membuat file resources/saas/app.scss

    ```php
    // Fonts
    @import url('https://fonts.bunny.net/css?family=Nunito');


    // Bootstrap
    @import 'bootstrap/scss/bootstrap';

    // DataTables
    @import 'bootstrap-icons/font/bootstrap-icons.css';
    @import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
    @import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css";
    @import 'datatables.net-select-bs5/css/select.bootstrap5.css';
    ```

6. Menjalankan npm run dev<br>
   ![alt text](images/js5/p2.6.png)<br>

7. Membuat datatables untuk kategori<br>
   ![alt text](images/js5/p2.7.png)

8. Mengedit KategoriDatable untuk mengatur kolom apasaja yang ingin ditampilkan<br>

    ```php
    <?php

    namespace App\DataTables;

    use App\Models\KategoriModel;
    use Illuminate\Database\Eloquent\Builder as QueryBuilder;
    use Yajra\DataTables\EloquentDataTable;
    use Yajra\DataTables\Html\Builder as HtmlBuilder;
    use Yajra\DataTables\Html\Button;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Html\Editor\Editor;
    use Yajra\DataTables\Html\Editor\Fields;
    use Yajra\DataTables\Services\DataTable;

    class KategoriDataTable extends DataTable
    {
        /**
         * Build the DataTable class.
         *
         * @param QueryBuilder $query Results from query() method.
         */
        public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))
    /*             ->addColumn('action', 'kategori.action') */
                ->setRowId('id');
        }

        /**
         * Get the query source of dataTable.
         */
        public function query(KategoriModel $model): QueryBuilder
        {
            return $model->newQuery();
        }

        /**
         * Optional method if you want to use the html builder.
         */
        public function html(): HtmlBuilder
        {
            return $this->builder()
                        ->setTableId('kategori-table')
                        ->columns($this->getColumns())
                        ->minifiedAjax()
                        //->dom('Bfrtip')
                        ->orderBy(1)
                        ->selectStyleSingle()
                        ->buttons([
                            Button::make('excel'),
                            Button::make('csv'),
                            Button::make('pdf'),
                            Button::make('print'),
                            Button::make('reset'),
                            Button::make('reload')
                        ]);
        }

        /**
         * Get the dataTable columns definition.
         */
        public function getColumns(): array
        {
            return [
        /*         Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'), */
                Column::make('kategori_id'),
                Column::make('kategori_kode'),
                Column::make('kategori_nama'),
                Column::make('created_at'),
                Column::make('updated_at'),
            ];
        }

        /**
         * Get the filename for export.
         */
        protected function filename(): string
        {
            return 'Kategori_' . date('YmdHis');
        }
    }
    ```

9. Mengubah kategori model

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class KategoriModel extends Model
    {
        protected $table = 'm_kategori';
        protected $primaryKey = 'kategori_id';
        protected $fillable = ['kategori_kode', 'kategori_nama'];

        public function barang(): HasMany
        {
            return $this->hasMany(BarangModel::class, 'barang_id', 'barang_id');
        }
    }
    ```

10. Mengubah Kategori Controller

    ```php
        public function index(KategoriController $dataTable)
        {
            return $dataTable->render('kategori.index');
        }
    ```

11. Membuat folder kategori di view

    ```php
    @extends('layouts.app')

    {{-- Customize layout sections --}}

    @section('subtitle', 'Kategori')
    @section('content_header_title', 'Home')
    @section('content_header_subtitle', 'Kategori')

    @section('content')
        <div class="container">
            <div class="card">
                <div class="card-header">Manage Kategori</div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
    ```

12. Memastikan route kategori tersedia

    ```php
    Route::get('/kategori', [KategoriController::class, 'index']);
    ```

13. Menyesuaikan app layout

    ```php
    @extends('adminlte::page')
    {{-- Extend and customize the browser title --}}
    @section('title')
        {{ config('adminlte.title') }}
        @hasSection('subtitle')
            | @yield('subtitle')
        @endif
    @stop
    @vite('resources/js/app.js')
    {{-- Extend and customize the page content header --}}
    @section('content_header')
        @hasSection('content_header_title')
            <h1 class="text-muted">
                @yield('content_header_title')
                @hasSection('content_header_subtitle')
                    <small class="text-dark">
                        <i class="fas fa-xs fa-angle-right text-muted"></i>
                        @yield('content_header_subtitle')
                    </small>
                @endif
            </h1>
        @endif
    @stop

    {{-- Rename section content to content_body --}}

    @section('content')
        @yield('content_body')
    @stop


    {{-- Create a common footer --}}

    @section('footer')
        <div class="float-right">
            Version: {{ config('app.version', '1.0.0') }}
        </div>

        <strong>
            <a href="{{ config('app.company_url', '#') }}">
                {{ config('app.company_name', 'My company') }}
            </a>
        </strong>
    @stop


    {{-- Add common Javascript/Jquery code --}}



    @push('js')
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    @endpush

    @stack('scripts')


    {{-- Add common CSS customizations --}}

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
        <style type="text/css">
            {{-- You can add AdminLTE customizations here --}}
            /*
        .card-header {
        border-bottom: none;
        }
        .card-title {
        font-weight: 600;
        }
        */
        </style>
    @endpush
    ```

14. Menset ViteJs / script type defaults

    ```php
    <?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Yajra\DataTables\Html\Builder;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            //
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Builder::useVite();
        }
    }
    ```

15. Melihat data kategori
    ![alt text](images/js5/p2.8.png)

### Praktikum 3 – Membuat form kemudian menyimpan data dalam database

1. Menambahkan 2 routing

    ```php
    Route::get('/kategori/create', [KategoriController::class, 'create']);
    Route::post('/kategori', [KategoriController::class, 'store']);
    ```

2. Menambahkan 2 function dalam KategoriController

    ```php
        public function create()
        {
            return view('kategori.create');
        }

        public function store(Request $request)
        {
            KategoriModel::create([
                'kategori_kode' => $request->kodeKategori,
                'kategori_nama' => $request->namaKategori,
            ]);
            return redirect('/kategori');
        }
    ```

3. Membuat file create.blade di views/kategori

    ```php
    @extends('layouts.app')

    {{-- Customize layout sections --}}

    @section('subtitle', 'Kategori')
    @section('content_header_title', 'Kategori')
    @section('content_header_subtitle', 'Create')

    @section('content')
        <div class="container">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Buat Kategori Baru</h3>
                </div>

                <form action="../kategori" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kodeKategori">Kode Kategori</label>
                            <input type="text" class="form-control" name="kodeKategori" id="kodeKategori" placeholder="Masukkan kode kategori">
                        </div>
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" class="form-control" name="namaKategori" id="namaKategori" placeholder="Masukkan nama kategori">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    ```

4. Melakukan pengecualian proteksi CsrfToken pada file VerifyCsrfToken

    ```php
    protected $except = [
            '/kategori'
    ];
    ```

5. Mengakses kategori/create<br>
   ![alt text](images/js5/p3.1.png)

6. Mengakses halaman kategori<br>
   ![alt text](images/js5/p3.2.png)

### Tugas Praktikum

1. Menambah button Add di halaman manage kategori yang mengarah ke create kategori baru

    ```php
    @section('content')
        <div class="container">
            <div class="card">
                <div class="card-header">Manage Kategori</div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
            <a href="/kategori/create">
            <button class="btn btn-primary float-end">
                Tambah
            </button>
            </a>
        </div>
    @endsection
    ```

    Hasil<br>
    ![alt text](images/js5/t1.png)

2. Menambahkan menu untuk halaman manage kategori di daftar menu sidebar

    ```php
    [
                'text' => 'Manage Kategori',
                'url' => 'kategori',
            ],
    ```

    ![alt text](images/js5/t2.3.png)

3. Menambahkan action edit di datatables dan buat halaman edit serta controllernya

    ```php
        public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))
                ->addColumn('action', function ($kategori) {
                    return '<a href = "' . route('kategori.edit', $kategori->kategori_id) . '" class = "btn btn-primary">Edit</a>';
                })
                ->setRowId('id');
        }
    ```

    ```php
        public function getColumns(): array
        {
            return
                [
                    Column::make('kategori_id'),
                    Column::make('kategori_kode'),
                    Column::make('kategori_nama'),
                    Column::make('created_at'),
                    Column::make('updated_at'),
                    Column::make('action')
                        ->exportable(false)
                        ->printable(false)
                        ->width(60)
                        ->addClass('text-center')
                        ->title('Actions'),
                ];
        }
    ```

    ```php
    @extends('layouts.app')

    @section('subtitle', 'Kategori')
    @section('content_header_title', 'Kategori')
    @section('content_header_subtitle', 'Edit')

    @section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">Edit Kategori</div>

            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kategori_kode">Kode Kategori:</label>
                        <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="{{ $kategori->kategori_kode }}">
                    </div>

                    <div class="form-group">
                        <label for="kategori_nama">Nama Kategori:</label>
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="{{ $kategori->kategori_nama }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
    ```

    ```php
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}/update', [KategoriController::class, 'update'])->name('kategori.update');
    ```

    ![alt text](images/js5/t2.png)<br>
    ![alt text](images/js5/t2.1.png)<br>
    ![alt text](images/js5/t2.2.png)<br>

4. Menambahkan action delete di datatables serta controllernya

    ```php
        public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))
                ->addColumn('action', function ($kategori) {
                    return '<a href="' . route('kategori.edit', $kategori->kategori_id) . '" class="btn btn-primary">Edit</a>
                        <form action="' . route('kategori.destroy', $kategori->kategori_id) . '" method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
                })
                ->setRowId('id');
        }
    ```

    ```php
        public function destroy($id)
        {
            $kategori = KategoriModel::find($id);
            $kategori->delete();

            return redirect('/kategori');
        }
    ```

    ![alt text](images/js5/t2.4.png)

    ![alt text](images/js5/t2.5.png)

<br>
<hr>
<br>
<br>

<div align=center>

# Jobsheet 6 <br> (Template Form (AdminLTE), Server Validation, Client Validation, CRUD)

</div>

<br>

## A. Template Form (AdminLTE)

1. Mengakses https://adminlte.io/ , lalu klik download pada source code (zip) dan memindahkannya pada folder public <br>
   ![alt text](images/js6/p1.png)

2. Mengcopy isi public/template/index2.html pada welcome.blade.php

    ```php
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <img class="animation__wobble" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">

    ```

3. Menyesuaikan kode

    ```php
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}  "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.js') }} "></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('template/plugins/jquery-mousewheel/jquery.mousewheel.js') }} "></script>
    <script src="{{ asset('template/plugins/raphael/raphael.min.js') }} "></script>
    <script src="{{ asset('template/plugins/jquery-mapael/jquery.mapael.min.js') }} "></script>
    <script src="{{ asset('template/plugins/jquery-mapael/maps/usa_states.min.js') }} "></script>
    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }} "></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/dist/js/demo.js') }} "></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard2.js') }} "></script>
    ```

4. Menjalankan browser<br>
   ![alt text](images/js6/p1.1.png)

5. Modifikasi welcome.blade

    ```php
    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')

        <div class="card-body">
            <form>
            <div class="row">
                <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
        <label>Level id</label><input type="text" class="form-control" placeholder="id">
                    <div>
                </div>
                <button type = "submit" class ="btn btn-info">Submit </button>
                </div>
    @stop

    @section('css')
        {{-- Add here extra stylesheets --}}
        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @stop

    @section('js')
        <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    @stop
    ```

6. Hasil tampilan<br>
   ![alt text](images/js6/p1.2.png)

7. General form<br>
   ![alt text](images/js6/p1.3.png)

8. m_user<br>
   ![alt text](images/js6/p1.4.png)

9. m_level<br>
   ![alt text](images/js6/p1.5.png)

## B. Validasi Pada Seeder

1. Mengedit KategoriController

    ```php
    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
        ]);
        return redirect('/kategori');
    }
    ```

2. Tulis perbedaan penggunaan validate dengan validateWithBag!<br>

- Metode validate() biasanya digunakan di dalam controller. Jika validasi gagal, Laravel
secara otomatis akan mengarahkan kembali pengguna ke halaman sebelumnya dengan
pesan error yang sesuai. Pesan error validasi akan dikirim kembali ke tampilan dan dapat
diakses menggunakan fungsi bantuan errors().
-> Metode validateWithBag() memberikan fleksibilitas yang lebih besar dalam menangani
pesan error validasi. Dengan menggunakan metode ini, dapat mengontrol di mana pesan
error validasi disimpan dan bagaimana pesan tersebut ditampilkan kepada pengguna.

3. Menggunakan bail untuk menghentikan validasi pada field setelah kegagalan validasi pertama,
   Sehingga, jika validasi untuk kode_kategori gagal, maka Laravel akan menghentikan validasi
   dan tidak mengevaluasi aturan validasi untuk nama_kategori

    ```php
    $validated = $request->validate([
                'kategori_kode' => 'bail|required',
                'kategori_nama' => 'required',
            ]);
    ```

4. Pada view/create.blade.php tambahkan code berikut agar ketika validasi gagal, kita dapat menampilkan pesan kesalahan dalam tampilan

    ```php
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    ```

5. Hasil<br>
   ![alt text](images/js6/p2.png)

6. Menambahkan kode pada view/create.blade.php

    ```php
    <label for="kategori_kode">Kode Kategori</label>
                        <input type="text"
                            name="kategori_kode"
                            id="kategori_kode"
                            class="@error('kategori_kode') is-invalid @enderror form-control"
                            placeholder="Kode Kategori">

                        @error('kategori_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    ```

    <br>

    ![alt text](images/js6/p2.1.png)

## C. Form Request Validation

1. Membuat permintaan form dengan menuliskan pada terminal<br>
   ![alt text](images/js6/p3.png)

2. Menambahkan kode pada Http/request/StorePostRequest

    ```php
    public function rules(): array
        {
            return [
                'kategori_kode' => 'required',
                'kategori_nama' => 'required',
            ];
        }

    public function store(StorePostRequest $request): RedirectResponse
    {
        // $validate = $request->validate([
        //     'kategori_kode' => 'bail|required',
        //     'kategori_nama' => 'required',
        // ]);

        // Retrieve the validated input data...
        $validated = $request->validated();

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
        return redirect('/kategori');
    }
    ```

3. Menerapkan pada m_user dan m_level<br>
   m_user<br>
   ![alt text](images/js6/p3.1.png)<br>

    m_level<br>
    ![alt text](images/js6/p3.2.png)<br>

## D. CRUD (Create, Read, Update, Delete)

1. Membuat POSController lengkap dengan resourcenya, Membuat Resource Controller dan Route
   yang berfungsi untuk route CRUD sehingga tidak perlu repot-repot membuat masing-masing
   route seperti post, get, delete dan update<br>
   ![alt text](images/js6/p4.png)

2. Menambahkan kode pada route

    ```php
    Route::recourse('m_user', POSController::class);
    ```

3. Mengatur model m_user

    ```php
    class UserModel extends Model
    {
        use HasFactory;

        protected $table = 'm_user';        // mendefinisikan nama tabel yang digunakan oleh model ini
        public $timestamps = false;
        protected $primaryKey = 'user_id';  // mendefinisikan primary key dari tabel yang digunakan

        protected $fillable = [
            'user_id',
            'level_id',
            'username',
            'nama',
            'password',
        ];
    ```

4. Mengatur migration m_user_table

    ```php
    public function up(): void
        {
            Schema::create('m_user', function (Blueprint $table) {
                $table->id('user_id');
                $table->unsignedBigInteger('level_id')->index(); // indexing for foreign key
                $table->string('username', 20)->unique(); // unique untuk memastikan tidak ada username yang sama
                $table->string('nama', 100);
                $table->string('password');
                $table->timestamps();

                // mendefinisikan foreign key pada kolom level_id mengace pada kolom level_id di tabel m_level
                $table->foreign('level_id')->references('level_id')->on('m_level');
            });
        }
    ```

5. Mengedit app/Http/Controllers/POSController.php

    ```php
    /**
         * Display a listing of the resource.
         */
        public function index()
        {
            // fungsi eloquent menampilkan data menggunakan pagination
            $useri = UserModel::all(); // Mengambil semua isi tabel
            return view('m_user.index', compact('useri'))->with('i');
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('m_user.create');
        }
    ```

6. Membuat folder di Resources/Views/m_user dengan beberapa blade dan isian kode berikut

    1. template.blade.php

        ```php
        <!DOCTYPE html>
        <html>
        <head>
            <title>CRUD Laravel</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                @yield('content')
            </div>
        </body>
        </html>
        ```

    2. index.blade.php

        ```php
        @extends('m_user/template')

        @section('content')
            <div class="row mt-5 mb-5">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>CRUD user</h2>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('m_user.create') }}">Input User</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th width="20px" class="text-center">User id</th>
                    <th width="150px" class="text-center">Level id</th>
                    <th width="200px" class="text-center">Username</th>
                    <th width="200px" class="text-center">Nama</th>
                    <th width="150px" class="text-center">Password</th>
                </tr>
                @foreach ($useri as $m_user)
                    <tr>
                        <td>{{ $m_user->user_id }}</td>
                        <td>{{ $m_user->level_id }}</td>
                        <td>{{ $m_user->username }}</td>
                        <td>{{ $m_user->nama }}</td>
                        <td>{{ substr($m_user->password, 0, 10) . "..." }}</td>
                        <td class="text-center">
                            <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('m_user.show', $m_user->user_id) }}">Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('m_user.edit', $m_user->user_id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endsection
        ```

    3. create.blade.php

        ```php
        @extends('m_user/template')

        @section('content')
            <div class="row mt-5 mb-5">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>Membuat Daftar User</h2>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary" href="{{ route('m_user.index') }}">Kembali</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops</strong> Input gagal<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('m_user.store') }}" method="POST">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Username:</strong>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Level ID:</strong>
                        <input type="number" name="level_id" class="form-control" placeholder="Masukkan level id">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        @endsection
        ```

    4. show.blade.php

        ```php
        @extends('m_user/template')

        @section('content')
            <div class="row mt-5 mb-5">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>Show User</h2>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary" href="{{ route('m_user.index') }}">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User_id:</strong>
                        {{ $useri->user_id }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Level_id:</strong>
                        {{ $useri->level_id }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Username:</strong>
                        {{ $useri->username }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        {{ $useri->nama }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {{ $useri->password }}
                    </div>
                </div>
            </div>
        @endsection
        ```

    5. edit.blade.php

        ```php
        @extends('m_user/template')

        @section('content')
            <div class="row mt-5 mb-5">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>Edit User</h2>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary" href="{{ route('m_user.index') }}">Kembali</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Error <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('m_user.update', $useri->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User_id:</strong>
                            <input type="text" name="userid" value="{{ $useri->user_id }}" class="form-control" placeholder="Masukkan user id">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Level_id:</strong>
                            <input type="text" name="levelid" value="{{ $useri->level_id }}" class="form-control" placeholder="Masukkan level">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Username:</strong>
                            <input type="text" value="{{ $useri->username }}" class="form-control" name="username" placeholder="Masukkan Nomor username">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama:</strong>
                            <input type="text" value="{{ $useri->nama }}" name="nama" class="form-control" placeholder="Masukkan nama">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" value="{{ $useri->password }}" name="password" class="form-control" placeholder="Masukkan password">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        @endsection
        ```

7. Melihat hasil<br>
   ![alt text](images/js6/p4.1.png)

## Tugas

1. Coba tampilkan level_id pada halaman web tersebut dimana field ini merupakan foreign key<br>
   ![alt text](images/js6/p4.1.png)<br>

2. Modifikasi dengan tema/ template kesukaan Anda<br>
   ![alt text](images/js6/p4.2.png)<br>

3. Apa fungsi $request->validate, $error dan alert yang ada pada halaman CRUD tersebut<br>

- $request->validate: Ini adalah metode dari objek $request yang digunakan untuk
 melakukan validasi input yang diterima dari pengguna. Validasi dilakukan berdasarkan
 aturan yang didefinisikan di dalam metode rules() pada file Form Request atau secara
 langsung di dalam controller. Jika validasi gagal, maka metode ini akan mengembalikan
 pesan kesalahan.
 - $errors: Variabel ini digunakan untuk menyimpan pesan-pesan kesalahan yang dihasilkan
 dari validasi input. Jika validasi gagal, maka pesan kesalahan akan disimpan di dalam
 variabel ini. Ini dapat diakses di dalam tampilan Blade untuk menampilkan pesan
 kesalahan kepada pengguna.
 - alert: Ini adalah elemen HTML yang digunakan untuk menampilkan pesan kesalahan
 kepada pengguna. Dalam konteks halaman CRUD, pesan kesalahan biasanya ditampilkan
 dalam elemen alert untuk memberi tahu pengguna tentang kesalahan yang terjadi selama
 proses validasi atau operasi CRUD.
    
    Dengan menggunakan fungsi $request->validate untuk validasi input dan variabel $errors untuk menangani pesan kesalahan, serta menggunakan elemen alert di dalam tampilan Blade
