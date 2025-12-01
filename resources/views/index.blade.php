<!DOCTYPE html>
<html>
<head>
    <title>Daftar Catatan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f4e1ff, #d7c7ff, #f8f1ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        .container {
            width: 900px;
        }

        h1 {
            text-align: center;
            color: #5a2a83;
            font-size: 32px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .add-btn {
            display: inline-block;
            padding: 12px 20px;
            background: linear-gradient(135deg, #b37bff, #8c52ff);
            color: white;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: 0.3s ease;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background: linear-gradient(135deg, #a56bff, #7a41f9);
            box-shadow: 0 10px 25px rgba(122, 65, 249, 0.3);
            transform: translateY(-3px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
        }

        th {
            background: rgba(255, 255, 255, 0.5);
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
            color: #4b2b63;
            text-align: left;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.35);
            color: #3f2458;
            font-size: 15px;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.4);
            transition: 0.2s ease;
        }

        tr:last-child td {
            border-bottom: none;
        }

    </style>
</head>

<body>

    <div class="container">
        
        <h1>Daftar Catatan</h1>

        <a class="add-btn" href="{{ route('catatan.create') }}">
            + Tambah Catatan
        </a>

        <table>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Dibuat</th>
            </tr>

            @foreach($catatan as $c)
            <tr>
                <td>{{ $c->judul }}</td>
                <td>{{ $c->deskripsi }}</td>
                <td>{{ $c->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach

        </table>
    </div>

</body>
</html>
