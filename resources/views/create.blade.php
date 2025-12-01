<!DOCTYPE html>
<html>
<head>
    <title>Tambah Catatan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f4e1ff, #d7c7ff, #f8f1ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 420px;
            padding: 35px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: fadeIn 0.7s ease;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #5a2a83;
            font-size: 28px;
            font-weight: 700;
        }

        label {
            font-weight: 600;
            color: #4b2b63;
            font-size: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 12px;
            border: 1px solid rgba(147, 112, 219, 0.4);
            background: rgba(255, 255, 255, 0.65);
            outline: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        input:focus, textarea:focus {
            box-shadow: 0 0 8px #c8a4ff;
            border: 1px solid #b280ff;
        }

        textarea {
            height: 110px;
            resize: none;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #b37bff, #8c52ff);
            border: none;
            border-radius: 15px;
            font-size: 16px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
            letter-spacing: 0.5px;
        }

        button:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #a56bff, #7a41f9);
            box-shadow: 0 10px 25px rgba(122, 65, 249, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    {{-- Popup sukses --}}
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    {{-- Popup error validasi --}}
    @if ($errors->any())
        <script>
            alert("{{ implode('\n', $errors->all()) }}");
        </script>
    @endif

    <div class="card">
        <h1>Tambah Catatan</h1>

        <form action="{{ route('catatan.store') }}" method="POST">
            @csrf

            <label>Judul</label>
            <input type="text" name="judul" placeholder="Masukkan judul...">

            <br><br>

            <label>Isi Catatan</label>
            <textarea name="deskripsi" placeholder="Tulis catatanmu di sini..."></textarea>

            <button type="submit">Simpan</button>
        </form>
    </div>

</body>
</html>
