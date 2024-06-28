# Cahaya Sports

**Kelompok 10:**

-   Christian Fernando (535220055)
-   Ryan Anthony (535220074)
-   Leonardez Flobert (535220097)

## Instalasi

1.  Clone repository.

    ```
    https://github.com/ryanthony6/cahaya_sports.git
    ```

2.  Install dependency

    ```
    composer install
    npm install
    ```

3.  Copy environment (.env) example dan isi .env sesuai dengan perangkat dan database yang digunakan.

    ```
    cp .env.example .env
    ```

4.  Generate key untuk APP_KEY pada file .env.

    ```
    php artisan key:generate
    ```

5.  Lakukan seed database untuk mendapatkan data dummy dan akun yang dapat digunakan langsung.

    ```
    php artisan migrate
    php artisan db:seed
    ```

6.  Untuk konek storage gambar

    ```
    php artisan storage:link
    ```

7.  Jalankan server.

    ```
    php artisan serve
    npm run dev
    ```

8.  Akses website melalui `http://127.0.0.1:8000` atau `http://localhost:8000`

## Instalasi

```
 admin : admin@example.com
 pw : password
```
