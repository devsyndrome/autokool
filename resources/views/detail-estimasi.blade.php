@extends('layouts.master')
@section('title')
Estimasi
@endsection
@push('link-asset')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
    integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
@endpush
@section('username')
Admin
@endsection
@section('judul')
<h1>Jasa </h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Forms</a></div>
    <div class="breadcrumb-item">Advanced Forms</div>
</div>
@endsection
@section('section-header')
{{ $estimates->nopol }}
@endsection
@section('content')
<h2 class="section-title">Detail</h2>
<p class="section-lead">Data Estimasi Part & Jasa</p>

<div class="section-body">
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <table>
                    <tr>
                        <th>Tanggal</th>
                        <th>:</th>
                        <th>{{ $estimates->tgl }}</th>
                    </tr>
                    <tr>
                        <th>Asuransi</th>
                        <th>:</th>
                        <th>{{ $estimates->asuransi }}</th>
                    </tr>
                    <tr>
                        <th>No. Pol</th>
                        <th>:</th>
                        <th>{{ $estimates->nopol }}</th>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>:</th>
                        <th>{{ $estimates->tahun }}</th>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <th>{{ $estimates->nama_tertanggung }}</th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <th><span class="badge badge-success">{{ $estimates->status }}</span></th>
                    </tr>
                </table>
                
                <hr>
                
                <a href="javascript:void(0)" class="btn btn-warning" id="tombol-tambah"><i class="far fa-edit">Konfirmasi</i></a>
                <p><pre>*NOTE: Jika data sudah benar maka klik tombol konfirmasi untuk melanjutkan ke bagian Logistik</pre></p>
                <hr>
                <h4><span class="badge badge-dark">Spare Part</span></h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No. Part</th>
                            <th>Spare Part</th>
                            <th>QTY</th>
                            <th>Pricelist(ppn)</th>
                            <th>Sub Total(ppn)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        setlocale(LC_MONETARY,"en_ID");    
                        @endphp
                        @foreach ($part as $j)
                        <tr>
                            <td>{{ $j->nopart }}</td>
                            <td>{{ $j->sparepart }}</td>
                            <td>{{ $j->qty }}</td>
                            <td>{{ "Rp.".number_format($j->price_p,0,',','.') }}</td>
                            <td>{{ "Rp.".number_format(($j->price_p * $j->qty ),0,',','.') }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">TOTAL</th>
                            <th>{{ "Rp.".number_format($totalpart->total,0,',','.')}}</th>
                        </tr>
                    </tbody>
                </table>
                <h4><span class="badge badge-dark">Jasa</span></h4>
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Jasa</th>
                            <th>Note</th>
                            <th>Qty</th>
                            <th>Pricelist(ppn)</th>
                            <th>Sub Total(ppn)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        setlocale(LC_MONETARY,"en_ID");    
                        @endphp
                        @foreach ($jasa as $i)
                        <tr>
                            <td>{{ $i->jasa }}</td>
                            <td>{{ $i->note }}</td>
                            <td>{{ $i->qty }}</td>
                            <td>{{ "Rp.".number_format($i->price_s,0,',','.') }}</td>
                            <td>{{ "Rp.".number_format(($i->price_s * $i->qty ),0,',','.') }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">TOTAL</th>
                            <th>{{ "Rp.".number_format($totaljasa->total,0,',','.') }}</th>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    @endsection
    @push('modal')
    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">WARNING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Yakin ingin hapus data?</b></p>
                    <p>*Data akan terhapus oleh sistem, pastikan data yang dipilih benar.</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->

    <!-- MULAI MODAL FORM TAMBAH/EDIT-->
    <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" id="id_e" name="id_e" value="{{ $id }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="jasa" class="col-sm-12 control-label">Jasa</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="jasa" name="jasa" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note" class="col-sm-12 control-label">Note</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="note" name="note" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="col-sm-12 control-label">Qty</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="qty" name="qty" min="0" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pricelist" class="col-sm-12 control-label">Price List</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="price_s" name="price_s" min="0" value="" required>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                        value="create">Submit
                                    </button>
                                </div>
                            </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR MODAL -->
    @endpush
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"
        integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        //Token CSRF
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        

    </script>
    @endpush