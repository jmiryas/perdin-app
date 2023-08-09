@extends("layouts.master")

@section("title")
Tambah Role
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Role</h5>

                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Role</label>
                        <div class="col-sm-10">
                            <input name="name" placeholder="Masukkan nama role" class="form-select"></input>

                            @error("name")
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