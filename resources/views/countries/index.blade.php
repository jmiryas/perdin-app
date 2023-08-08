@extends("layouts.master")

@section("title")
Daftar Negara
@endsection

@section("content")
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Negara</h5>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kode</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($countries as $country)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $country->name }}</td>
                  <td>{{ $country->sortname }}</td>
                </tr>
                @empty
                <tr>
                    <td>Tidak ada negara apapun</td>
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