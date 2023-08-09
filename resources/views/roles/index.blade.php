@extends("layouts.master")

@section("title")
Daftar Role
@endsection

@section("content")
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Role</h5>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $role->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada role apapun</td>
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