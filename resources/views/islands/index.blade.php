@extends("layouts.master")

@section("title")
Daftar Pulau
@endsection

@section("content")
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pulau</h5>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($islands as $island)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $island->name }}</td>
                </tr>
                @empty
                <tr>
                    <td>Tidak ada pulau apapun</td>
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