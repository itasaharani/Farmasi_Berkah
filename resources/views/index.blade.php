<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main-page.css')}}" />
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <title>Main Page</title>
    <style>
        body {
            background-image: url('https://wallpaperaccess.com/full/1464885.jpg'); /* Ganti URL gambar sesuai dengan gambar latar belakang baru */
            background-size: cover; /* Untuk memastikan gambar latar belakang terisi seluruh halaman */
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed; /* Menjaga gambar latar belakang tetap di tempatnya saat menggulir halaman */
        }
    </style>
</head>
<body>
    <!-- Memulai Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-logo">
        <img src="{{asset('img/hospital/Logo.png')}}" alt="Logo" />
        </div>
        <ul class="navbar-menu">
            <li><a href="/">Home</a></li>
            <li><a href="">Farmasi</a></li>
        </ul>
        <div class="navbar-bmi">
        <a href="{{ route('dashboard.page', 'obat') }}" class="bmi-button">Obat</a>
        </div>
    </nav>

    <!-- Memulai Isi -->

    <div class="container">
        <div class="kiri">
            <h1>Welcome to</h1>
            <h1>Dashboard Farmasi</h1>
        </div>
    </div>
   <!-- about us -->
<div class="container2">
  <div class="about-us" id="about-us">
    <div class="image-frame">
      <img src="https://i0.wp.com/astromesin.com/wp-content/uploads/2018/06/Obat.jpg?resize=1000%2C600&ssl=1" alt="" />
    </div>
    <div class="tulisan-about-us">
      <h2>About Us</h2>
      <p>
        Sistem Informasi Farmasi untuk Pencatatan Obat dan Pemberian Obat kepada Pasien
      </p>
    </div>
  </div>
</div>


    <!-- Membuat Timeline -->

    <!-- Memulai Footer -->

    <footer class="footer">
        
        <p class="company-footer" >Hak Cipta &copy; 2024 Healthcare.</p>
   
    </footer>

    
</body>
</html>
