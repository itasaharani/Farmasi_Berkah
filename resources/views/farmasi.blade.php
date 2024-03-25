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
            function get_obat(){
                // 1. Create a new XMLHttpRequest object
                let xhr = new XMLHttpRequest();

                // 2. Configure it: GET-request for the URL /article/.../load
                xhr.open('GET', 'http://localhost/silk2024-slim-main/public/obat');

                // 3. Send the request over the network
                xhr.send();

                // 4. This will be called after the response is received
                xhr.onload = function() {
                if (xhr.status != 200 && xhr.status != 201) { // analyze HTTP status of the response
                    alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
                } else { // show the result
                    // alert(`Done, got ${xhr.response.length} bytes`); // response is the server response
                    // document.getElementById("myCards").innerHTML=xhr.responseText;
                    let table = document.getElementById("outputTable");
                    let data = JSON.parse(xhr.responseText);
                    data.forEach(function(item){
                        var row = document.createElement("tr");

                        // var id = document.createElement("td");
                        // id.textContent = item.id;
                        // row.appendChild(id);

                        var sku = document.createElement("td");
                        sku.textContent = item.sku;
                        row.appendChild(sku);

                        var label_catatan = document.createElement("td");
                        label_catatan.textContent = item.label_catatan;
                        row.appendChild(label_catatan);

                        var jumlah = document.createElement("td");
                        jumlah.textContent = item.jumlah;
                        row.appendChild(jumlah);

                        table.appendChild(row);
                    });
                            }
                        };

                        xhr.onerror = function() {
                            alert("Request failed");
                        };
                    }

                    window.onload = get_obat;
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

        <div class="content-wrapper">
            <div class="content-left">
            <table id="outputTable" border="13">
                                    <tr>
                                        <th>SKU</th>
                                        <th>Label</th>
                                        <th>Jumlah</th>
                                    </tr>

                                </table> 
               
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <p>Hak Cipta &copy; 2024 Contoh Perusahaan.</p>
    </footer>
</body>
</html>
