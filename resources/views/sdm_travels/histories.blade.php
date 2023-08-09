@extends("layouts.master")

@section("title")
Riwayat Perjalanan Dinas
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
                            Riwayat Perjalanan Dinas
                        </h6>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($travels as $travel)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $travel->pegawai->name }}</td>
                                <td>
                                    <span>
                                        {{ $travel->getTitleCase($travel->currentCity->name) }}
                                        <i class="ri-arrow-right-fill"></i>
                                        {{ $travel->getTitleCase($travel->destinationCity->name) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $travel->start_date->format("d M Y") }} - {{
                                    $travel->end_date->format("d M Y")
                                    }} ({{ $travel->travelDurationDays() }} hari)
                                </td>
                                <td>{{ $travel->description ?? "-" }}</td>
                                <td>
                                    @if ($travel->travelStatus->name == "Pending")
                                    <span class="text-warning fw-bold">{{ $travel->travelStatus->name }}</span>
                                    @elseif ($travel->travelStatus->name == "Accepted")
                                    <span class="text-success fw-bold">{{ $travel->travelStatus->name }}</span>
                                    @else
                                    <span class="text-danger fw-bold">{{ $travel->travelStatus->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sdm.travels.show', $travel) }}"
                                        class="btn btn-sm btn-primary">Selengkapnya</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada perjalanan dinas apapun</td>
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