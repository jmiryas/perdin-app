@extends("layouts.master")

@section("title")
Pengajuan Perdin Sdr. {{ $travel->pegawai->name }}
@endsection

@section("content")
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        Pengajuan Perdin Sdr. {{ $travel->pegawai->name }}
                    </h6>

                    <hr>

                    <h6 class="card-title">
                        Deskripsi
                    </h6>

                    <p class="small fst-italic">
                        {{ $travel->description }}
                    </p>

                    <h6 class="card-title">
                        Tentang Perjalanan Dinas
                    </h6>

                    <div class="row">
                        <div class="col-12 col-md-3 fw-bold">
                            SDM
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->divSDM->name }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Pegawai
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->pegawai->name }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Tanggal
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->start_date->format("d M Y") }}
                            -
                            {{ $travel->end_date->format("d M Y") }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Durasi
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->travelDurationDays() }} hari
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Kota
                        </div>

                        <div class="col-12 col-md-9">
                            <span>
                                {{ $travel->getTitleCase($travel->currentCity->name) }}
                                <i class="ri-arrow-right-fill"></i>
                                {{ $travel->getTitleCase($travel->destinationCity->name) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Jarak
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->getDistance(
                            $travel->currentCity->latitude, $travel->currentCity->longitude,
                            $travel->destinationCity->latitude, $travel->destinationCity->longitude
                            ) }} km
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Uang Saku Total
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->is_domestic ? "Rp" : "USD" }}
                            {{ number_format($travel->allowance, 2) }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Uang Saku Harian
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->is_domestic ? "Rp" : "USD" }}
                            {{ number_format($travel->allowance / $travel->travelDurationDays(), 2) }} / hari
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Jenis Perdin
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->is_domestic ? "Dalam Negeri" : "Luar Negeri" }}
                        </div>
                    </div>

                    @if ($travel->is_domestic)
                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Satu Pulau
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->isSameIsland($travel->currentCity, $travel->destinationCity) }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Satu Provinsi
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $travel->isSameProvince($travel->currentCity, $travel->destinationCity) }}
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3 mb-3">
                        <div class="col-12 col-md-3 fw-bold">
                            Status
                        </div>

                        <div class="col-12 col-md-9">
                            @if ($travel->travelStatus->name == "Pending")
                            <span class="fw-bold" style="color: #227093">{{ $travel->travelStatus->name }}</span>
                            @elseif ($travel->travelStatus->name == "Accepted")
                            <span class="text-success fw-bold">{{ $travel->travelStatus->name }}</span>
                            @else
                            <span class="text-danger fw-bold">{{ $travel->travelStatus->name }}</span>
                            @endif
                        </div>
                    </div>

                    <h6 class="card-title">
                        Aksi
                    </h6>

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-grid gap-2 mt-3" style="width: 30%;">
                            <form action="{{ route('sdm.travels.reject') }}" method="POST">
                                @csrf

                                <input name="travel_id" type="hidden" value="{{ $travel->id }}">

                                <button style="width: 100%; background-color: #303952; color: white;" class="btn"
                                    type="submit">Reject</button>
                            </form>
                        </div>

                        <div class="d-grid gap-2 mt-3" style="width: 30%;">
                            <form action="{{ route('sdm.travels.accept') }}" method="POST">
                                @csrf

                                <input name="travel_id" type="hidden" value="{{ $travel->id }}">

                                <button style="width: 100%;" class="btn btn-success" type="submit">Accept</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection