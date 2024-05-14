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
    <title>Dashboard Farmasi</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script type="text/javascript" language="javascript">

   function get_farmasi() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', 'http://localhost/silk2024-slim-main/public/farmasi');

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

                    var nama_obat = document.createElement("td");
                    nama_obat.textContent = item.nama_obat;
                    row.appendChild(nama_obat);

                    var sku = document.createElement("td");
                    sku.textContent = item.sku;
                    row.appendChild(sku);

                    var dosis = document.createElement("td");
                    dosis.textContent = item.dosis;
                    row.appendChild(dosis);

                    var label= document.createElement("td");
                    label.textContent = item.label;
                    row.appendChild(label);

                    var actions = document.createElement("td");
                    var updateButton = document.createElement("button");
                    updateButton.textContent = 'Update';
                    updateButton.className = 'btn btn-primary';
                    updateButton.onclick = function() {
                        editData(item.sku);
                    };
                    actions.appendChild(updateButton);

                    var deleteButton = document.createElement("button");
                    deleteButton.textContent = 'Delete';
                    deleteButton.className = 'btn btn-danger';
                    deleteButton.onclick = function() {
                        delete_farmasi(item.sku);
                    };

                    actions.appendChild(deleteButton);

                    row.appendChild(actions);

                    table.appendChild(row);
                });
            }
        };

        xhr.onerror = function() {
            alert("Request failed");
        };
    }


    function post_farmasi(data) {
        let xhr = new XMLHttpRequest();
        // xhr.open('POST', 'http://192.168.0.8/slimsilk2024/public/farmasi');
        xhr.open('POST', 'http://localhost/silk2024-slim-main/public/farmasi');
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 201) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let response = JSON.parse(xhr.responseText);
                if (response.status === 'berhasil') {
                    alert('Data berhasil disimpan');
                    document.getElementById('myForm').reset();
                    get_farmasi();
                } else {
                    alert('Gagal menyimpan data');
                }
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };

        xhr.send(JSON.stringify(data));
     }

    function delete_farmasi(sku) {
        let xhr = new XMLHttpRequest();
        xhr.open('DELETE', 'http://localhost/silk2024-slim-main/public/farmasi/${sku}');
        // xhr.open('DELETE', 'http://192.168.0.8/slimsilk2024/public/farmasi/${sku}');
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 204) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                alert('Data berhasil dihapus');
                get_farmasi(); // Memuat ulang data setelah penghapusan
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };

        xhr.send();
        }

        function editData(sku) {
        let xhr = new XMLHttpRequest();
        // 
        
        xhr.open('GET', `http://localhost/silk2024-slim-main/public/farmasi/${sku}`);
        // xhr.open('GET', `http://192.168.0.8/slimsilk2024/public/farmasi/${sku}`);
        xhr.send();

        xhr.onload = function() {
            if (xhr.status != 200) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let data = JSON.parse(xhr.responseText);
                document.getElementById('update_nama_obat').value = data.nama_obat;
                document.getElementById('update_sku').value = data.sku;
                document.getElementById('update_dosis').value = data.dosis;
                document.getElementById('update_label').value = data.label;
                jQuery('#updateModal').modal('show'); // Menampilkan modal
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };
    }

    function submitUpdateForm() {
        let data = {
            nama_obat: document.getElementById('update_nama_obat').value,
            sku: document.getElementById('update_sku').value,
            dosis: document.getElementById('update_dosis').value,
            label: document.getElementById('update_label').value
        };

        let xhr = new XMLHttpRequest();
        
        xhr.open('PUT', `http://localhost/silk2024-slim-main/public/farmasi/${data.sku}`);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
            alert('Data berhasil diupdate');
            $('#updateModal').modal('hide'); // Menyembunyikan modal setelah update
            get_farmasi(); // Memuat ulang data setelah update
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };

        xhr.send(JSON.stringify(data));
        }


    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk melakukan submit default

            let data = {
                nama_obat: document.getElementById('nama_obat').value,
                sku: document.getElementById('sku').value,
                dosis: document.getElementById('dosis').value,
                label: document.getElementById('label').value
            };

            post_farmasi(data);
        });

        window.onload = get_farmasi; // Memanggil get_obat() agar data muncul saat halaman pertama kali dimuat
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

<!-- Modal Update Obat -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Farmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateForm">
          <input type="hidden" id="updateSku" name="sku">
          <div class="form-group">
            <label for="sku">Nama Obat:</label>
            <input type="text" class="form-control" id="update_nama_obat" name="update_nama_obat">
        </div>
        <div class="form-group">
            <label for="sku">SKU:</label>
            <input type="text" class="form-control" id="update_sku" name="update_sku">
        </div>
        <div class="form-group">
            <label for="dosis">Dosis:</label>
            <input type="text" class="form-control" id="update_dosis" name="update_dosis">
        </div>
        <div class="form-group">
            <label for="jumlah">Label:</label>
            <input type="text" class="form-control" id="update_label" name="update_label">
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitUpdateForm()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Memulai Isi -->
<div class="container">
    <h1 class="text-center">Dashboard Farmasi</h1>
    
    <!-- Tabel List Obat -->
    <table class="table mx-auto w-75" id="outputTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Obat</th>
                <th>SKU</th>
                <th>Dosis</th>
                <th>Label</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    
    
    <!-- Formulir Obat -->
    <form class="mx-auto w-50" id="myForm">
        <center>
            <h1>Menambah Data Farmasi</h1>
        </center>
        <div class="form-group">
             <!-- Insert Obat Baru -->
        <div class="form-group">
            <label for="sku">Nama Obat:</label>
            <input type="text" class="form-control" id="nama_obat" name="nama_obat">
        </div>
        <div class="form-group">
            <label for="sku">SKU:</label>
            <input type="text" class="form-control" id="sku" name="sku">
        </div>
        <div class="form-group">
            <label for="dosis">Dosis:</label>
            <input type="text" class="form-control" id="dosis" name="dosis">
        </div>
        <div class="form-group">
            <label for="jumlah">Label:</label>
            <input type="text" class="form-control" id="label" name="label">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Memulai Footer -->
 <footer class="footer">
        
        <p class="company-footer" >Hak Cipta &copy; 2024 Healthcare.</p>
   
    </footer>

    

</body>
</html>
