@extends("layouts.master")

@section("title")
Daftar Perjalanan Dinas
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
                            Daftar Perjalanan Dinas
                        </h6>

                        <div>
                            <a href="{{ route('travels.create') }}" class="btn btn-sm btn-primary">Tambah Perdin</a>
                            <a href="#" class="btn btn-sm btn-secondary">Tambah Perdin LN</a>
                        </div>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($filtered_travels as $travel)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <span>
                                        {{ $travel->getTitleCase($travel->currentCity->name) }}
                                        <i class="ri-arrow-right-fill"></i>
                                        {{
                                        $travel->destinationCity == NULL ? $travel->getTitleCase($travel->country->name)
                                        : $travel->getTitleCase($travel->destinationCity->name)
                                        }}
                                    </span>
                                </td>
                                <td>
                                    {{ $travel->start_date->format("d M Y") }} - {{
                                    $travel->end_date->format("d M Y")
                                    }} ({{ $travel->travelDurationDays() }} hari)
                                </td>
                                <td>{{ $travel->description ?? "-" }}</td>
                                <td>{{ $travel->travelStatus->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>Tidak ada perjalanan dinas apapun</td>
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