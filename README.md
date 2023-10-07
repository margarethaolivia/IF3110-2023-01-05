#WeTube

> Built to fulfill Tugas Besar 1 IF3110 Pengembangan Aplikasi Berbasis Web

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#about-the-project">About The Project</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#website-screenshot">Website Screenshot</a></li>
    <li><a href="#lighthouse-score">Lighthouse Score</a></li>
    <li><a href="#team-member">Team Member</a></li>
  </ol>
</details>

## About The Project

WeTube adalah sebuah website yang dirancang bagi pengguna untuk mengunggah serta menonton video. Website ini memiliki beberapa fitur utama bagi pengguna, yaitu sebagai berikut.

1. Mengunggah Video<br>
   Pengguna dapat mengunggah video yang memungkinkan mereka untuk berbagi konten yang mereka buat dengan komunitas WeTube
2. Menonton Video<br>
   Pengguna dapat menelusuri berbagai video yang tersedia di WeTube, termasuk berbagai tags seperti musik, hiburan, pendidikan, olahraga, dan sebagainya.
3. Memberi Komentar<br>
   Pengguna dapat memberikan komentar pada video yang mereka tonton, berinteraksi dengan pembuat video, dan berdiskusi dengan pengguna lainnya.
4. Mengedit dan Menghapus Video <br>
   Pengguna memiliki kendali penuh atas video yang mereka unggah dan dapat menghapusnya jika diperlukan.
5. Filter Pencarian dan Sortir Video
   Pengguna dapat mencari video berdasarkan filter tags dan juga pembuat video (admin atau user). Selain itu, video juga dapat disortir berdasarkan judul, waktu unggah, serta waktu edit.

## Built With

Website WeTube dibuat menggunakan teknologi berikut.

- Client Side: Vanilla JavaScript, HTML, dan CSS
- Server Side: Monolithic PHP
- Database: PostgreSQL

## Usage

1. Clone repository
2. Buat file .env
3. Run docker

   ```bash
    docker compose up -d
   ```

4. Jika terjadi error `no pg_hba.conf entry for host`, tambahkan entry pada pg_hba.conf dengan nilai `host all all all md5`
5. Akses halaman website melalui http://localhost:8008
6. Akses halaman admin melalui http://localhost:8888

## Website Screenshot

Login Page

<img src="./src/public/images/screenshot/login.png" alt="login page" width="600">

Sign Up Page

<img src="./src/public/images/screenshot/signup.png" alt="signup page" width="600">

Home Page

<img src="./src/public/images/screenshot/home.png" alt="home page" width="600">

Watch Video Page (User)

<img src="./src/public/images/screenshot/watchvideo-1.png" alt="watchvideo page" width="600">
<img src="./src/public/images/screenshot/watchvideo-2.png" alt="watchvideo page" width="600">

Watch Video Page (Admin)

<img src="./src/public/images/screenshot/watchvideo-admin-1.png" alt="watchvideo page" width="600">
<img src="./src/public/images/screenshot/watchvideo-admin-2.png" alt="watchvideo page" width="600">

Upload Video Page

<img src="./src/public/images/screenshot/uploadvideo.png" alt="uploadvideo page" width="600">

My Videos Page

<img src="./src/public/images/screenshot/myvideos.png" alt="myvideos page" width="600">

Edit Video Page

<img src="./src/public/images/screenshot/editvideo.png" alt="editvideo page" width="600">

Takedowns Page

<img src="./src/public/images/screenshot/takedowns.png" alt="takedowns page" width="600">

Profile Page

<img src="./src/public/images/screenshot/profile.png" alt="profile page" width="600">

404 Page

<img src="./src/public/images/screenshot/404.png" alt="404 page" width="600">

## Lighthouse Score

Login Page

<img src="./src/public/images/lighthouse/login.png" alt="login page score" width="600">

Sign Up Page

<img src="./src/public/images/lighthouse/signup.png" alt="signup page score" width="600">

Home Page

<img src="./src/public/images/lighthouse/home.png" alt="home page score" width="600">

Watch Video Page

<img src="./src/public/images/lighthouse/watchvideo.png" alt="watchvideo page score" width="600">

Upload Video Page

<img src="./src/public/images/lighthouse/uploadvideo.png" alt="uploadvideo page score" width="600">

My Videos Page

<img src="./src/public/images/lighthouse/myvideos.png" alt="myvideos page score" width="600">

Edit Video Page

<img src="./src/public/images/lighthouse/editvideo.png" alt="editvideo page score" width="600">

Takedowns Page

<img src="./src/public/images/lighthouse/takedowns.png" alt="takedowns page score" width="600">

Profile Page

<img src="./src/public/images/lighthouse/profile.png" alt="profile page score" width="600">

404 Page

<img src="./src/public/images/lighthouse/404.png" alt="404 page score" width="600">

## Team Member

| Nama                 | NIM      |
| -------------------- | -------- |
| Margaretha Olivia H. | 13521071 |
| Johanes Lee          | 13521148 |

Server Side

- User : 13521148
- Video : 13521148
- Comment : 13521071
- Tags : 13521148

Client Side

- Login : 13521148
- Register : 13521148
- Home : 13521071
- Watch Video : 13521071
- My Videos : 13521071
- Edit Video : 13521148
- Takedown : 13521148
- Profile : 13521148
