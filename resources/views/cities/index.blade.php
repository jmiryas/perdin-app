@extends("layouts.master")

@section("title")
Daftar Kota
@endsection

@section("content")
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Kota/Kabupaten</h5>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Provinsi</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Lat</th>
                  <th scope="col">Long</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cities as $city)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $city->province->name }}</td>
                  <td>{{ $city->name }}</td>
                  <td>{{ $city->latitude }}</td>
                  <td>{{ $city->longitude }}</td>
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