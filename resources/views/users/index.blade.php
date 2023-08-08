@extends("layouts.master")

@section("title")
Daftar Pengguna
@endsection

@section("content")
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pengguna</h5>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if ($user->roles)
                    {{ $user->roles->pluck("name")->implode(", ") }}                        
                    @else
                    -
                    @endif
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