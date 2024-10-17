<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>List Buku</title>
</head>
<body class="p-4">
    @if(count($data_buku))
        <div class="alert alert-success">
            Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata: 
            <strong>{{ $cari }}</strong>
        </div>

    @else
    <div class="alert alert-warning">
        <h4>Data {{ $cari }} tidak ditemukan</h4>
        <a href="/buku" class="btn btn-warning">Kembali</a>
    </div>
    @endif


    <form action="{{ route('buku.search') }}" method="get">
    @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari ..." 
        style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: left;">
    </form>

    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>

            @foreach($data_buku as $buku)
            <tr>
                <div>
                    <td>{{ $buku->id}}</td>
                    <td id="baris-1{{ $buku->id }}">{{ $buku->judul }}</td>
                    <td id="baris-2{{ $buku->id }}">{{ $buku->penulis }}</td>
                    <td id="baris-3{{ $buku->id }}">{{ "Rp. ".number_format($buku->harga, 2, ',','.') }}</td>
                    <td id="baris-4{{ $buku->id }}">{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                </div>

                <form action="{{ route ('buku.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $buku->id }}">
                    <td id="form-edit-0{{ $buku->id }}" style="display: none;"><input type="text" name="judul" value="{{ $buku->judul }}"></td>
                    <td id="form-edit-1{{ $buku->id }}" style="display: none;"><input type="text" name="penulis" value="{{ $buku->penulis }}"></td>
                    <td id="form-edit-2{{ $buku->id }}" style="display: none;"><input type="text" name="harga" value="{{ $buku->harga }}"></td>
                    <td id="form-edit-3{{ $buku->id }}" style="display: none;"><input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></td>
                    <td id="form-edit-4{{ $buku->id }}" style="display: none;"><button type="submit" class="btn btn-success">Update</button></td>
                </form>

                <td id="hps-{{ $buku->id }}">
                    <form action="{{ route ('buku.destroy', $buku->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')"
                            type="submit"
                            class="btn btn-danger">Hapus</button>
                    </form>
                </td>

                <td>
                    <button class="btn btn-outline-warning" onclick="toggleEditForm('{{ $buku->id }}')">Edit</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total Harga Buku</strong></td>
                <td colspan="5"><strong>Rp. {{ number_format($total_harga, 2, ',', '.') }}</strong></td>
            </tr>
                
        </tbody>
    </table>
                                                                                                                                                                                               
    <div>
        {{ $data_buku->links('pagination::bootstrap-5') }}
    </div>
    <div>
        <strong>Jumlah Buku: {{ $jumlah_buku }}</strong>
    </div>

    <script src="/js/toggleEdit.js"></script>
</body>

</html>