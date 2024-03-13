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

## [laporan disini](laporan/Jobsheet-3_PWL_DennyMalikIbrahim_TI-2H.pdf)
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
3. localhostPWL_POS/public/user\
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

6. localhostPWL_POS/public/user\
    ![alt text](images/js4/p1.2.png)

    Terjadi error, karena field password tidak memiliki default valuenya


