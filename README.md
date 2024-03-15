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

