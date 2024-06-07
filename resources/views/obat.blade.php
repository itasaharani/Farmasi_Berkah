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
    <title>Dashboard Obat</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script type="text/javascript" language="javascript">

   function get_obat() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', 'http://192.168.78.114/silk2024-slim-main/public/obat');

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

                    var sku = document.createElement("td");
                    sku.textContent = item.sku;
                    row.appendChild(sku);

                    var id_rm = document.createElement("td");
                    id_rm.textContent = item.id_rm;
                    row.appendChild(id_rm);

                    var label_catatan = document.createElement("td");
                    label_catatan.textContent = item.label_catatan;
                    row.appendChild(label_catatan);

                    var jumlah = document.createElement("td");
                    jumlah.textContent = item.jumlah;
                    row.appendChild(jumlah);

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
                        delete_obat(item.sku);
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


    function post_obat(data) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://192.168.78.114/silk2024-slim-main/public/obat');
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 201) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let response = JSON.parse(xhr.responseText);
                if (response.status === 'berhasil') {
                    alert('Data berhasil disimpan');
                    document.getElementById('myForm').reset();
                    get_obat();
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

    function delete_obat(sku) {
        let xhr = new XMLHttpRequest();
        xhr.open('DELETE', `http://192.168.78.114/silk2024-slim-main/public/obat/${sku}`);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 204) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                alert('Data berhasil dihapus');
                get_obat(); // Memuat ulang data setelah penghapusan
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };

        xhr.send();
        }

        function editData(sku) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `http://192.168.78.114/silk2024-slim-main/public/obat/${sku}`);
        xhr.send();

        xhr.onload = function() {
            if (xhr.status != 200) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let data = JSON.parse(xhr.responseText);
                document.getElementById('updateSku').value = data.sku;
                document.getElementById('updateIdRm').value = data.id_rm;
                document.getElementById('updateLabelCatatan').value = data.label_catatan;
                document.getElementById('updateJumlah').value = data.jumlah;
                jQuery('#updateModal').modal('show'); // Menampilkan modal
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };
    }

    function submitUpdateForm() {
        let data = {
            sku: document.getElementById('updateSku').value,
            id_rm: document.getElementById('updateIdRm').value,
            label_catatan: document.getElementById('updateLabelCatatan').value,
            jumlah: document.getElementById('updateJumlah').value
        };

        let xhr = new XMLHttpRequest();
        xhr.open('PUT', `http://192.168.78.114/silk2024-slim-main/public/obat/${data.sku}`);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status != 200) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
            alert('Data berhasil diupdate');
            $('#updateModal').modal('hide'); // Menyembunyikan modal setelah update
            get_obat(); // Memuat ulang data setelah update
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
                sku: document.getElementById('sku').value,
                id_rm: document.getElementById('id_rm').value,
                label_catatan: document.getElementById('label_catatan').value,
                jumlah: document.getElementById('jumlah').value
            };

            post_obat(data);
        });

        window.onload = get_obat; // Memanggil get_obat() agar data muncul saat halaman pertama kali dimuat
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
        <h5 class="modal-title" id="updateModalLabel">Update Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateForm">
          <input type="hidden" id="updateSku" name="sku">
          <div class="form-group">
            <label for="updateIdRm">Id Rm:</label>
            <input type="text" class="form-control" id="updateIdRm" name="updateIdRm" readOnly>
          </div>
          <div class="form-group">
            <label for="updateLabelCatatan">Label Catatan:</label>
            <input type="text" class="form-control" id="updateLabelCatatan" name="label_catatan">
          </div>
          <div class="form-group">
            <label for="updateJumlah">Jumlah:</label>
            <input type="text" class="form-control" id="updateJumlah" name="jumlah">
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
    <h1 class="text-center">Dashboard Obat</h1>
    
    <!-- Tabel List Obat -->
    <table class="table mx-auto w-75" id="outputTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Id Rm</th>
                <th>Label Catatan</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    
    
    <!-- Formulir Obat -->
    <form class="mx-auto w-50" id="myForm">
        <center>
            <h1>Menambah Data Obat</h1>
        </center>
        <div class="form-group">
             <!-- Insert Obat Baru -->
        <div class="form-group">
            <label for="sku">SKU:</label>
            <input type="text" class="form-control" id="sku" name="sku">
        </div>
        <div class="form-group">
            <label for="id_rm">Id Rm:</label>
            <input type="text" class="form-control" id="id_rm" name="id_rm">
        </div>
        <div class="form-group">
            <label for="label">Label Catatan:</label>
            <input type="text" class="form-control" id="label_catatan" name="label_catatan">
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah">
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
