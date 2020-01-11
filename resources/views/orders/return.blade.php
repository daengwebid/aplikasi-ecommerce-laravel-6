@extends('layouts.admin')

@section('title')
    <title>Detail pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">View Order</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Detail pesanan
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Detail Pelanggan</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Nama Pelanggan</th>
                                            <td>{{ $order->customer_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telp</th>
                                            <td>{{ $order->customer_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alasan Return</th>
                                            <td>{{ $order->return->reason }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rekening Pengembalian Dana</th>
                                            <td>{{ $order->return->refund_transfer }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{!! $order->return->status_label !!}</td>
                                        </tr>
                                    </table>
                                    
                                    @if ($order->return->status == 0)
                                    <form action="{{ route('orders.approve_return') }}" onsubmit="return confirm('Kamu Yakin?');" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <select name="status" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="1">Terima</option>
                                                <option value="2">Tolak</option>
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary btn-sm">Proses Return</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h4>Foto Barang Return</h4>
                                    <img src="{{ asset('storage/return/' . $order->return->photo) }}" class="img-responsive" height="200" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
