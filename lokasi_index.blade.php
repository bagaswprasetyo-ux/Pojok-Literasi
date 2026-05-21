@extends('layouts.app_admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Data Buku</h5>
                <br>
                <div>
                    <a href="{{ route('lokasi.create') }}" class="btn btn-primary btn-lg" style="margin-left: 25px">Tambah</a>
                </div>
                <br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderer">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Lokasi</th>
                                    <th style="color: white">Rt</th>
                                    <th style="color: white">Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->lokasi }}</th>
                                        <th>{{ $item->rt }}</th>
                                        <th>
                                            <a href="{{ route('lokasi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        </th>
                                        <th>
                                            {!! Form::open ([
                                                'route'=> ['lokasi.destroy', $item -> id],
                                                'method' => 'delete',
                                                'onsubmit'=> 'return confirm("yakin mau dihapus")',
                                           ]) !!}
                                           <button type="submit" class="btn btn-danger">Hapus</button>
                                           {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Data tidak ada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $models->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
