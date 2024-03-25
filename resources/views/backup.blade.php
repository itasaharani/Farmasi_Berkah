<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Healthcare</title>
    <!-- Style CSS (dapat disimpan dalam file terpisah jika diinginkan) -->
    <style>

        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Membuat konten terisi setidaknya seluruh tinggi layar */
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        nav {
            background-color: #f0f0f0;
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
        }
        .container {
            flex: 1; /* Mengisi ruang yang tersisa */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        .content-left, .content-right {
            flex-grow: 1; /* Mengambil ruang yang tersisa */
        }
        .content-right img {
            max-width: 100%; 
            height: auto;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>

<script type="text/javascript" language="javascript">

   function get_obat() {
    // Isi kode untuk melakukan GET request dan menampilkan data di tabel
    let xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://localhost/silk2024-slim-main/public/obat');

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

                var label_catatan = document.createElement("td");
                label_catatan.textContent = item.label_catatan;
                row.appendChild(label_catatan);

                var jumlah = document.createElement("td");
                jumlah.textContent = item.jumlah;
                row.appendChild(jumlah);

                var actions = document.createElement("td");
                var updateButton = document.createElement("button");
                updateButton.textContent = 'Update';
                updateButton.onclick = function() {
                    editData(item.sku);
                };
                actions.appendChild(updateButton);

                var deleteButton = document.createElement("button");
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = function() {
                    deleteData(item.sku);
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
        xhr.open('POST', 'http://localhost/silk2024-slim-main/public/obat');
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

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk melakukan submit default

            let data = {
                sku: document.getElementById('sku').value,
                label_catatan: document.getElementById('label_catatan').value,
                jumlah: document.getElementById('jumlah').value
            };

            post_obat(data);
        });

        window.onload = get_obat;// Memanggil get_obat() agar data muncul saat halaman pertama kali dimuat
    });
</script>





</head>
<body>
    <header>
        <h1>Welcome to Dashboard Healthcare</h1>
    </header>



    <nav>
        <ul>
            @foreach($menuItems as $menuItem => $link)
                <li><a href="{{ route('dashboard.page', ['page' => $link]) }}">{{ $menuItem }}</a></li>
            @endforeach
        </ul>
    </nav>


    
   

    <div class="container">

    <h1>Form Insert Data Obat</h1>
    
    <form id="myForm">
        <table>
            <tr>
                <td><label for="sku">SKU</label></td>
                <td><input type="text" id="sku" name="sku"></td>
            </tr>
            <tr>
                <td><label for="label_catatan">Label</label></td>
                <td><input type="text" id="label_catatan" name="label_catatan"></td>
            </tr>
            <tr>
                <td><label for="jumlah">Jumlah</label></td>
                <td><input type="text" id="jumlah" name="jumlah"></td>
            </tr>
            
        </table><br>
        <center>
            <button type="submit">Submit</button>
        </center>
    </form>
    <br>


    <center>
        <h2> Data Obat </h2>
        <div class="content-wrapper">
            <div class="content-left">

            <table id="outputTable" border="2">
                <tr>
                    <th>SKU</th>
                    <th>Label</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
                <!-- Contoh baris data -->
                <tr>
                    <td>SKU1</td>
                    <td>Label1</td>
                    <td>1</td>
                    <td>
                        <button onclick="editData('SKU1')">Update</button>
                        <button onclick="deleteData('SKU1')">Delete</button>
                    </td>
                </tr>
            </table>

               
                @yield('content')
            </div>
        </div>
    </center>
    </div>

    <footer>
        <p>Hak Cipta &copy; 2024 Healthcare.</p>
    </footer>
</body>
</html>
