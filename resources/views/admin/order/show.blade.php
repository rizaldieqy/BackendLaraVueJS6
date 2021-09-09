@extends('layouts.app', ['title' => 'Detail Order'])


@section('content')

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i>DETAIL ORDER</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 25%">NO. INVOICE</td>
                            <td style="width: 1%">:</td>
                            <td>{{ $invoice->invoice }}</td>
                        </tr>
                        <tr>
                            <td>NAMA LENGKAP</td>
                            <td>:</td>
                            <td>{{ $invoice->name }}</td>
                        </tr>
                        <tr>
                            <td>NO. TELP/WA</td>
                            <td>:</td>
                            <td>{{ $invoice->phone }}</td>
                        </tr>
                        <tr>
                            <td>KURIR/SERVICE/COST</td>
                            <td>:</td>
                            <td>{{ $invoice->courier }} / {{ $invoice->service }} / {{ number_format($invoice->cost_courier) }}</td>
                        </tr>
                        <tr>
                            <td>ALAMAT LENGKAP</td>
                            <td>:</td>
                            <td>{{ $invoice->address }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL PEMBELIAN</td>
                            <td>:</td>
                            <td>{{ number_format($invoice->grand_total) }}</td>
                        </tr>
                        <tr>
                            <td>STATUS</td>
                            <td>:</td>
                            <td>{{ $invoice->status }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 rounded shadow mt-4">
                <div class="card-body">
                    <h5><i class="fa fa-shopping-cart"></i>DETAIL ORDER</h5>
                    <hr>
                    <table class="table" style="border-style: solid !important;border-color:rgb(198, 206, 214) !important;">
                        <tbody>
                            @foreach($invoice->orders()->get() as $product)
                            <tr style="background: #edf2f7">
                                <td class="b-none" width="25%">
                                    <div class="wrapper-image-cart">
                                        <img src="{{ $product->image }}" style="width: 100%;border-radius: .5rem">
                                    </div>
                                </td>
                                <td class="b-none text-right">
                                    <p class="m-0 font-weight-bold">{{ number_format($product->price) }}</p>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection