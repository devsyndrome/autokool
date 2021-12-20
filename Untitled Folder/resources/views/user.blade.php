@extends('layouts.master')
@section('title')
User
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
<h1>User</h1>
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
<h2 class="section-title">User</h2>
<p class="section-lead">Data Pengguna Aplikasi</p>

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
                            <th>Name</th>
                            <th>Email</th>
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
                    <p><b>Do you want to delete</b></p>
                    <p>*data will be deleted forever, are you sure?</p>
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
                                    <label for="name" class="col-sm-12 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Password</label>
                                    <div class="col-sm-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @error('class_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Akses Halaman</label>
                                <div class="col-sm-12">
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="user" id="user" value="1"  class="selectgroup-input">
                                          <span class="selectgroup-button">User</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="estimasi" id="estimasi" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">Estimasi</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="spk" id="spk" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">SPK</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="logistik" id="logistik" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">HPP & Markup</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="penawaran" id="penawaran" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">Penawaran</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="penawaranhpp" id="penawaranhpp" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">Penawaran vs HPP</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="checkbox" name="spkhpp" id="spkhpp" value="1" class="selectgroup-input">
                                          <span class="selectgroup-button">SPK vs HPP</span>
                                        </label>
                                      </div>
                                </div>
                            </div>
                            @error('class_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                    url: "{{route('user.index')}}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
            $('#modal-judul').html("Tambah Pengguna"); //valuenya tambah pegawai baru
            $('#tambah-edit-modal').modal('show'); //modal tampil
            $('#email').attr('readonly', false)
            
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
                        url: "{{ route('user.store') }}", //url simpan data
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
            $.get('user/' + data_id + '/edit', function (data) {
                $('#modal-judul').html("Edit Pengguna");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id_user);
                $('#name').val(data.name);
                $('#password').val('');
                $('#email').val(data.email).attr('readonly', true);
                // $('#password').val(data.password);
                if(data.user == 1){
                    $('#user').prop('checked', true);
                }else{
                    $('#user').prop('checked', false);
                }
                if(data.estimasi == 1){
                    $('#estimasi').prop('checked', true);
                }else{
                    $('#estimasi').prop('checked', false);
                }
                if(data.spk == 1){
                    $('#spk').prop('checked', true);
                }else{
                    $('#spk').prop('checked', false);
                }
                if(data.logistik == 1){
                    $('#logistik').prop('checked', true);
                }else{
                    $('#logistik').prop('checked', false);
                }
                if(data.penawaran == 1){
                    $('#penawaran').prop('checked', true);
                }else{
                    $('#penawaran').prop('checked', false);
                }
                if(data.penawaranhpp == 1){
                    $('#penawaranhpp').prop('checked', true);
                }else{
                    $('#penawaranhpp').prop('checked', false);
                }
                if(data.spkhpp == 1){
                    $('#spkhpp').prop('checked', true);
                }else{
                    $('#spkhpp').prop('checked', false);
                }
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

                url: "lecturers/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Delete'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        $('#lecturers-table').DataTable().ajax.reload();
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

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({

                url: "user/" + dataId, //eksekusi ajax ke url ini
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

    </script>
    @endpush
