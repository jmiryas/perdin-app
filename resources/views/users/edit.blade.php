@extends("layouts.master")

@section("title")
Edit Pengguna
@endsection

@section("custom_css")
<link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Pengguna</h5>

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method("PUT")

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" value="{{ $user->name }}" type="text" placeholder="Masukkan nama"
                                class="form-select"></input>

                            @error("name")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" value="{{ $user->email }}" type="email" placeholder="Masukkan email"
                                class="form-select"></input>

                            @error("email")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role Sekarang</label>
                        <div class="col-sm-10">
                            @if (count($user->roles) > 0)
                            <input type="text" value="{{ ucwords($user->getRoleNames()->implode(" , ")) }}" disabled
                                style="width: 100%;">
                            @else
                            <input type="text" value="N/A" disabled style="width: 100%;">
                            @endif
                        </div>
                    </div>

                    @if (!$user->hasRole("admin"))
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Role</label>
                        <div class="col-sm-10">
                            <select class="form-select role" name="role_id" style="width: 100%;">
                                @forelse ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @empty
                                <option value="">-</option>
                                @endforelse
                            </select>

                            @error("role_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    @endif

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
        $('.role').select2();
    });
</script>
@endsection