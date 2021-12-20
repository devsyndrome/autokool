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
{{ Auth::user()->name }}
@endsection
@section('judul')
<h1>Estimasi</h1>
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
<h2 class="section-title">Estimasi</h2>
<p class="section-lead">Data Estimasi</p>

<div class="section-body">
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-info" id="tombol-tambah"><i class="far fa-edit">Tambah
                        Data</i></a>
                <hr>
                <table id="users-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Surveyor</th>
                            <th>Asuransi</th>
                            <th>No. Pol</th>
                            <th>Type</th>
                            <th>Tahun</th>
                            <th>Warna</th>
                            <th>No. Rangka</th>
                            <th>No. Mesin</th>
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
                                    <label for="asuransi" class="col-sm-12 control-label">Surveyor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="surveyor" name="surveyor" value=""
                                            required>
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
                                    <label for="asuransi" class="col-sm-12 control-label">Warna</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="warna" name="warna" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asuransi" class="col-sm-12 control-label">No. Rangka</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="norangka" name="norangka" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asuransi" class="col-sm-12 control-label">No. Mesin</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nomesin" name="nomesin" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-sm-12 control-label">Nama Tertanggung</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asuransi" class="col-sm-12 control-label">Alamat</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="alamat" name="alamat" value=""
                                            required>
                                    </div>
                                </div><div class="form-group">
                                    <label for="asuransi" class="col-sm-12 control-label">Telp</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="telp" name="telp" value=""
                                            required>
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
                scrollX: true,
                ajax: {
                    url: "{{route('estimasi.index')}}",
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
                        data: 'surveyor',
                        name: 'surveyor'
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
                        data: 'warna',
                        name: 'warna'
                    },
                    {
                        data: 'norangka',
                        name: 'norangka'
                    },
                    {
                        data: 'nomesin',
                        name: 'nomesin'
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
                            return '<div class="badge badge-danger">'+data+'</div>';
                        }else if(data == "Logistik"){
                            return '<div class="badge badge-warning">'+data+'</div>';
                        }else if(data == "Penawaran"){
                            return '<div class="badge badge-success">'+data+'</div>';
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
        //TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function () {
            $("#id").attr('readonly', false)
            $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Data Estimasi"); //valuenya tambah pegawai baru
            $('#tambah-edit-modal').modal('show'); //modal tampil
        });

        //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');

                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('estimasi.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        success: function (data) { //jika berhasil 
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#tambah-edit-modal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            // var oTable = $('#lecturers-table').dataTable();
                            $('#users-table').DataTable().ajax.reload();
                            // oTable.fnDraw(false); //reset datatable
                            iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data saved',
                                message: '{{ Session('
                                success ')}}',
                                position: 'bottomRight'
                            });
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }

        //TOMBOL EDIT DATA PER PEGAWAI DAN TAMPIKAN DATA BERDASARKAN ID PEGAWAI KE MODAL
        //ketika class edit-post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function () {
            $("#id").attr('readonly', true)
            var data_id = $(this).data('id');
            $.get('estimasi/' + data_id + '/edit', function (data) {
                $('#modal-judul').html("Edit Estimasi");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#tgl').val(data.tgl);
                $('#surveyor').val(data.surveyor);
                $('#asuransi').val(data.asuransi);
                $('#nopol').val(data.nopol);
                $('#type').val(data.type);
                $('#tahun').val(data.tahun);
                $('#warna').val(data.warna);
                $('#norangka').val(data.norangka);
                $('#nomesin').val(data.nomesin);
                $('#nama').val(data.nama_tertanggung);
                $('#alamat').val(data.alamat);
                $('#telp').val(data.telp);
            })
        });

        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({

                url: "estimasi/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Delete'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        $('#users-table').DataTable().ajax.reload();
                        // var oTable = $('#table_pegawai').dataTable();
                        // oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data deleted',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

    </script>
    @endpush
