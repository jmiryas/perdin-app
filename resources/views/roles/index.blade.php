@extends("layouts.master")

@section("title")
Daftar Role
@endsection

@section("content")
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session()->get("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="card-title">
                            Daftar Role
                        </h6>

                        <div>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">Tambah Perdin</a>
                        </div>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                        @csrf
                                        @method("DELETE")

                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada role apapun</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection