@extends('layouts.admin')

@section('title')
    <title>Mass Upload</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload Via Excel</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.saveBulk') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="file">File Excel</label>
                                    <input type="file" name="file" class="form-control" value="{{ old('file') }}" required>
                                    <p class="text-danger">{{ $errors->first('file') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload Via Marketplace</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.marketplace') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Marketplace</label>
                                    <select name="marketplace" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="shopee">Shopee</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('marketplace') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                    <p class="text-danger">{{ $errors->first('username') }}</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Jadwalkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection