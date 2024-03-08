<!DOCTYPE html>
<html lang="id">

<head>
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css" rel="stylesheet">
    .formatted-content {
        margin-top: 1px;
        margin-bottom: 1px;
        /* padding: 10px; */
        /* border: 1px solid #ccc; */
        /* border-radius: 5px; */
    }

    p {
        margin: 0;
        /* You can adjust the value as needed */
    }
    </style>
</head>

<body>
    <center>
        <p class="font-weight-bold" style="font-size: 20px; margin-bottom:1.5em">
            LIBRARY</p>
    </center>
    <main style="font-size: 12px;">
        <table class="table table-bordered table-striped" id="table-header">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Genre</th>
                    <th>Penerbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->genre_name }}</td>
                        <td>{{ $book->penerbit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

table {
    page-break-inside: avoid !important;
}

table tr {
    page-break-inside: avoid !important;
}

table tr td,
table tr th {
    page-break-inside: avoid !important;
    padding: 5px !important;
}

table tr th {
    padding: 5px !important;
    vertical-align: middle !important;
}

table tr td .title {
    width: 40% !important;
}

table tr td .separator {
    width: 5% !important;
    text-align: center;
}
</style>