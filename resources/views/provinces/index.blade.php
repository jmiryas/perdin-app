@extends("layouts.master")

@section("title")
Daftar Provinsi
@endsection

@section("content")
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Provinsi</h5>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Pulau</th>
                  <th scope="col">Nama Provinsi</th>
                  <th scope="col">Lat</th>
                  <th scope="col">Long</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($provinces as $province)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $province->island->name }}</td>
                  <td>{{ $province->name }}</td>
                  <td>{{ $province->latitude }}</td>
                  <td>{{ $province->longitude }}</td>
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