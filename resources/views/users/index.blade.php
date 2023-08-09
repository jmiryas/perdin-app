@extends("layouts.master")

@section("title")
Daftar Pengguna
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
              Daftar Pengguna
            </h6>

            <div>
              <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">Tambah Pengguna</a>
            </div>
          </div>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @if (count($user->roles) > 0)
                  {{ $user->roles->pluck("name")->implode(", ") }}
                  @else
                  <span>N/A</span>
                  @endif
                </td>
                <td>
                  <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                    @csrf
                    @method("DELETE")

                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>

                    @if (!$user->hasRole("admin"))
                    <button class="btn btn-sm btn-danger">Hapus</button>
                    @endif
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td>Tidak ada pengguna apapun</td>
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