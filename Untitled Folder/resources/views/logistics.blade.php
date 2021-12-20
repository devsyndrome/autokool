@extends('layouts.master')
@section('title')
Logistik
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
{{ Auth::user()->name }}
@endsection
@section('judul')
<h1>Logistik</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Forms</a></div>
    <div class="breadcrumb-item">Advanced Forms</div>
</div>
@endsection
@section('section-header')
Kelola Data
@endsection
@section('content')
<h2 class="section-title">Logistik</h2>
<p class="section-lead">Data HPP Sparepart & Jasa(DPP)</p>

<div class="section-body">
    <div class="section-body">
        <div class="card">
            <div class="card-body">
               
                <table id="users-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Asuransi</th>
                            <th>No. Pol</th>
                            <th>Type</th>
                            <th>Tahun</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
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

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="tgl" class="col-sm-12 control-label">Tanggal</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="tgl" name="tgl" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asuransi" class="col-sm-12 control-label">Asuransi</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="asuransi" name="asuransi" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nopol" class="col-sm-12 control-label">No. Pol</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nopol" name="nopol" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-12 control-label">Type</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="type" name="type" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tahun" class="col-sm-12 control-label">Tahun</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="tahun" name="tahun" min="1900"
                                            max="2099" step="1" value="2021" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-sm-12 control-label">Nama Tertanggung</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama" value="" required>
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
        //READ - Tampil Data
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{route('logistik.index')}}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tgl',
                        name: 'tanggal'
                    },
                    {
                        data: 'asuransi',
                        name: 'asuransi'
                    },
                    {
                        data: 'nopol',
                        name: 'nopol'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'nama_tertanggung',
                        name: 'nama'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        "render": function ( data, type, row, meta ) {
                        if(data == "Estimasi"){
                            return '<div class="badge badge-success">'+data+'</div>';
                        }else if(data == "Logistik"){
                            return '<div class="badge badge-warning">'+data+'</div>';
                        }else{
                            return '<div class="badge badge-info">'+data+'</div>';
                        }
                            
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                order: [
                    [0, 'asc']
                ]
            });
        });

    </script>
    @endpush
