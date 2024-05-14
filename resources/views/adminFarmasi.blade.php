<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Menggunakan Bootstrap dari CDN -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}" />
    <link rel="stylesheet" href="{{asset('css/menu-page.css')}}" />
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <title>Obat Masuk</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript" language="javascript">
        function get_all() {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'http://localhost/silk2024-slim-main/public/tampil_all');

            xhr.send();

            xhr.onload = function () {
                if (xhr.status != 200 && xhr.status != 201) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {
                    let table = document.getElementById("outputTable");
                    table.innerHTML = ''; // Mengosongkan tabel sebelum menambahkan data baru

                    let data = JSON.parse(xhr.responseText);
                    data.forEach(function (item) {
                        var row = document.createElement("tr");

                        var no_rm = document.createElement("td");
                        no_rm.textContent = item.no_rm;
                        row.appendChild(no_rm);

                        var sku = document.createElement("td");
                        sku.textContent = item.sku;
                        row.appendChild(sku);

                        var status_obat = document.createElement("td");
                        status_obat.textContent = item.status_obat;
                        row.appendChild(status_obat);

                        var actions = document.createElement("td");

                        var processButton = document.createElement("button");
                        processButton.textContent = 'Diproses';
                        processButton.className = 'btn btn-primary';
                        processButton.onclick = function () {
                            prosesItem(item.id_rm); // Menggunakan ID rekam medis untuk request API
                        };
                        actions.appendChild(processButton);

                        var completeButton = document.createElement("button");
                        completeButton.textContent = 'Selesai';
                        completeButton.className = 'btn btn-success';
                        completeButton.onclick = function () {
                            selesaiItem(item.id_rm); // Menggunakan ID rekam medis untuk request API
                        };
                        actions.appendChild(completeButton);

                        row.appendChild(actions);

                        table.appendChild(row);
                    });
                }
            };

            xhr.onerror = function () {
                alert("Request failed");
            };
        }

        function prosesItem(id) {
            fetch('http://localhost/silk2024-slim-main/public/proses_rm/' + id, {
                method: 'PUT'
            }).then(response => {
                if (response.ok) {
                    alert('Item berhasil diproses.');
                    get_all(); // Mengambil data kembali setelah item diproses
                } else {
                    alert('Gagal memproses item.');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }

        function selesaiItem(id) {
            fetch('http://localhost/silk2024-slim-main/public/selesai_rm/' + id, {
                method: 'PUT'
            }).then(response => {
                if (response.ok) {
                    alert('Item berhasil diselesaikan.');
                    get_all(); // Mengambil data kembali setelah item diselesaikan
                } else {
                    alert('Gagal menyelesaikan item.');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            get_all();
        });

    </script>

</head>
<style>
    body {
        background-image: url('https://wallpaperaccess.com/full/1464885.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .container {
        position: relative;
        top: 100px;
    }

    .table {
        background-color: white;
    }
</style>

<body>
    <!-- Navigation Bar -->
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

    <!-- Content -->
    <div class="container">
        <h1 class="text-center">Obat Pasien Masuk</h1>
        <!-- Drug List Table -->
        <table class="table mx-auto w-75" id="outputTable">
            <thead>
                <tr>
                    <th>no_rm</th>
                    <th>sku</th>
                    <th>status_obat</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p class="company-footer">Hak Cipta &copy; 2024 Healthcare.</p>
    </footer>

</body>

</html>
