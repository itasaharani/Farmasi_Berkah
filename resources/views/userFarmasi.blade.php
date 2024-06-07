<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Menggunakan Bootstrap dari CDN -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}" />
    <link rel="stylesheet" href="{{asset('css/menu-page.css')}}" />
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <title>Antrian Farmasi</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

        .page-title {
            text-align: center;
            grid-column: 1 / span 2; /* Menggunakan 2 kolom untuk judul */
            margin-bottom: 20px; /* Jarak bawah dari judul ke konten */
        }


        body {
            background-image: url('https://wallpaperaccess.com/full/1464885.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .left-box, .right-box {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .left-box {
            grid-column: 1 / span 1;
            background-color: lightyellow;
        }

        .right-box {
            grid-column: 2 / span 1;
            background-color: white;
        }

        .table {
            width: 100%;
        }

        .table th, .table td {
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .table td {
            border-bottom: 1px solid #dee2e6;
        }
    </style>

    <script type="text/javascript" language="javascript">
        function get_tunggu() {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'http://192.168.78.114/silk2024-slim-main/public/tampil_tunggu');
            // xhr.open('GET', 'http://192.168.0.15/slimsilk2024/public/tampil_tunggu');

            xhr.send();

            xhr.onload = function() {
                if (xhr.status != 200 && xhr.status != 201) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {
                    let table = document.getElementById("outputTable");
                    table.innerHTML = ''; // Mengosongkan tabel sebelum menambahkan data baru

                    let data = JSON.parse(xhr.responseText);
                    data.forEach(function(item) {
                        var row = document.createElement("tr");

                        var no_rm = document.createElement("td");
                        no_rm.textContent = item.no_rm;
                        row.appendChild(no_rm);

                        var status_obat = document.createElement("td");
                        status_obat.textContent = item.status_obat;
                        row.appendChild(status_obat);

                        table.appendChild(row);
                    });
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }

        document.addEventListener("DOMContentLoaded", function() {
            get_tunggu(); // Panggil fungsi get_obat setelah dokumen selesai dimuat
        });

        function get_proses() {
            let xhr = new XMLHttpRequest();

            // xhr.open('GET', 'http://192.168.0.15/slimsilk2024/public/tampil_proses');
            xhr.open('GET', 'http://192.168.78.114/silk2024-slim-main/public/tampil_proses');
          

            xhr.send();

            xhr.onload = function() {
                if (xhr.status != 200 && xhr.status != 201) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {
                    let data = JSON.parse(xhr.responseText);
                    let output = document.getElementById("outputTable2");
                    if (data.length > 0) {
                        output.innerHTML = `<h1>${data[0].no_rm} - ${data[0].status_obat}</h1>`;
                    } else {
                        output.innerHTML = '<h1>Tidak ada data yang tersedia</h1>';
                    }
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }

        document.addEventListener("DOMContentLoaded", function() {
            get_proses(); // Panggil fungsi get_proses setelah dokumen selesai dimuat
        });

    </script>
  

</head>
<body>
<!-- Memulai Navigation Bar -->
<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{asset('img/hospital/Logo.png')}}" alt="Logo" />
    </div>
    <ul class="navbar-menu">
        <li><a href="/">Home</a></li>
        <li class="nav-item">
            <a href="{{ route('farmasi.view') }}" class="farm-button">Farmasi</a>
            <a href="{{ route('adminFarmasi.view') }}" class="farm-button">Admin Farmasi</a>
            <a href="{{ route('userFarmasi.view') }}" class="farm-button">Antrian Farmasi</a>
        </li>
    </ul>
    <div class="navbar-bmi">
        <a href="{{ route('dashboard.page', 'obat') }}" class="bmi-button">Obat</a>
    </div>
</nav>


<!-- Memulai Isi -->
<div class="container">
    <!-- Kotak Kiri (Antrian) -->
    <div class="left-box">
    <h3 class="text-center">Antrian Saat Ini</h3>
    <div id="outputTable2" class="text-center"></div>
</div>


    <!-- Kotak Kanan (Obat) -->
    <div class="right-box">
    <h3 class="text-center">Antrian Yang Akan Datang</h3>

        <table class="table mx-auto w-75" id="outputTable">
        <thead>
            <tr>
                
                <th>No_rm :</th>
                <th>Status Obat : </th>
                
            </tr>
        </thead>
    </table>
    </div>
</div>

</body>
</html>
