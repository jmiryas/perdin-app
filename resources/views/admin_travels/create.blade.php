@extends("layouts.master")

@section("title")
Tambah Perdin
@endsection

@section("custom_css")
<link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Perdin</h5>

                <form method="POST" action="{{ route('admin.travels.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Div. SDM</label>
                        <div class="col-sm-10">
                            <select class="form-select div_sdm" name="div_sdm_id" style="width: 100%;">
                                @forelse ($users_sdm as $sdm)
                                <option value="{{ $sdm->id }}">{{ $sdm->name }}</option>
                                @empty
                                <option value="">-</option>
                                @endforelse
                            </select>

                            @error("div_sdm_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pegawai</label>
                        <div class="col-sm-10">
                            <select class="form-select pegawai_id" name="pegawai_id" style="width: 100%;">
                                @forelse ($users_pegawai as $pegawai)
                                <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                @empty
                                <option value="">-</option>
                                @endforelse
                            </select>

                            @error("pegawai_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kota Asal</label>
                        <div class="col-sm-10">
                            <select class="form-select current_city" name="current_city_id" style="width: 100%;">
                                @forelse ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @empty
                                <option value="">-</option>
                                @endforelse
                            </select>

                            @error("current_city_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kota Tujuan</label>
                        <div class="col-sm-10">
                            <select class="form-select destination_city" name="destination_city_id"
                                style="width: 100%;">
                                @forelse ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @empty
                                <option value="">-</option>
                                @endforelse
                            </select>

                            @error("destination_city_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input name="start_date" type="date" class="form-select" placeholder="Tanggal Awal">

                            @error("start_date")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-10">
                            <input name="end_date" type="date" class="form-select" placeholder="Tanggal Awal">

                            @error("end_date")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="description" cols="30" rows="3" placeholder="Masukkan deskripsi"
                                class="form-select"></textarea>

                            @error("description")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("custom_js")
<script src="{{ asset('select2/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.pegawai_id').select2();
        $('.div_sdm').select2();
        $('.current_city').select2();
        $('.destination_city').select2();
    });
</script>
@endsection