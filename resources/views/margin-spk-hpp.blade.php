@extends('layouts.master')
@section('title')
Check Gross Margin - SPK vs HPP
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
<h2 class="section-title">Check Gross Margin - SPK vs HPP</h2>
<p class="section-lead">Data Sparepart & Jasa</p>

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
                        <th>{{ $estimates->type }}</th>
                    </tr>
                    <tr>
                        <th>Tahun</th>
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
                        <th>
                            @if ($estimates->status == "Estimates")
                                <span class="badge badge-success">{{ $estimates->status }}</span>
                            @elseif (($estimates->status == "Logistik"))
                            <span class="badge badge-warning">{{ $estimates->status }}</span>
                            @else
                            <span class="badge badge-info">{{ $estimates->status }}</span>
                            @endif
                            
                        </th>
                    </tr>
                </table>
                
                <hr>
                @if ($estimates->status == "Logistik")
                <a href="javascript:void(0)" class="btn btn-warning" id="tombol-tambah">Konfirmasi</a>
                <p><pre>*NOTE: Jika data sudah benar maka klik tombol konfirmasi dan pilih penawaran untuk melanjutkan ke bagian Penawaran</pre></p>
                <p><pre>*Pilih estimasi untuk mengembalikan ke bagian estimator</pre></p>
                <hr>
                @endif
                <h4><span class="badge badge-dark">Gross Margin - SPK vs HPP</span></h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Subtotal Spare Parts (HPP)</th>
                            <th>Subtotal Jasa (HPP)</th>
                            <th>Total Sparepart & Jasa (HPP)</th>
                            <th>Subtotal Spare Parts (Penawaran)</th>
                            <th>Subtotal Jasa (Penawaran)</th>
                            <th>Total Sparepart & Jasa (Penawaran)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        setlocale(LC_MONETARY,"en_ID");
                        $sum_qty = 0;
                        $sum_price_p = 0;
                        $sum_sub_price_p = 0;
                        $sum_netto = 0;
                        $sum_subtotal_dpp = 0; 
                        $sum_subtotal_hpp_p = 0;
                        $sum_subtotal_hpp_s = 0;
                        $sum_asuransi_p = 0;
                        $sum_asuransi_s = 0;  
                        @endphp
                        @foreach ($jasa as $i)
                        @php
                            $sum_asuransi_s += $i->price_asuransi_s;
                            $sum_subtotal_hpp_s += $i->subtotal_dpp;
                        @endphp
                        @endforeach
                        @foreach ($part as $j)
                        {{-- <tr>
                            <td>{{ $j->nopart }}</td>
                            <td>{{ $j->sparepart }}</td>
                            <td>{{ $j->qty }}</td>
                            <td>{{ "Rp.".number_format($j->price_asuransi_p,0,',','.') }}</td>
                            <td>{{ "Rp.".number_format(($j->price_asuransi_p * $j->qty ),0,',','.') }}</td>
                            <td>{{ number_format($j->diskon_asuransi_p,0,',','.')."%" }}</td>
                            <td>{{ "Rp.".number_format($j->netto,0,',','.') }}</td>
                            <td>{{ "Rp.".number_format($j->subtotal_dpp,0,',','.') }}</td>
                        </tr> --}}
                        @php 
                        $sum_qty += $j->qty;
                        $sum_price_p += $j->price_p;
                        $sum_sub_price_p += $j->price_p * $j->qty;
                        $sum_netto += $j->netto;
                        $sum_subtotal_hpp_p += $j->subtotal_dpp;
                        
                        $sum_asuransi_p += $j->price_asuransi_p;
                        
                        $total_hpp = $sum_subtotal_hpp_p + $sum_subtotal_hpp_s;
                        $total_spk = $sum_asuransi_p + $sum_asuransi_s;
                        @endphp
                        @endforeach
                        @php
                        $part_dpp = $sum_asuransi_p / 1.1;  
                        $jasa_dpp = $sum_asuransi_s / 1.1;  
                        $total_dpp = $total_spk / 1.1;
                        $part_ppn = $sum_subtotal_hpp_p * 1.1;
                        $jasa_ppn = $sum_subtotal_hpp_s * 1.1;
                        $total_ppn = $total_hpp * 1.1;
                        $margin_part_dpp = $part_dpp - $sum_subtotal_hpp_p;
                        $margin_jasa_dpp = $jasa_dpp - $sum_subtotal_hpp_s;
                        $margin_total_dpp = $total_dpp - $total_hpp;

                        $margin_part_ppn = $sum_asuransi_p - $part_ppn;
                        $margin_jasa_ppn = $sum_asuransi_s - $jasa_ppn;
                        $margin_total_ppn = $total_spk - $total_ppn;
                        @endphp
                        <tr>
                            <th>DPP</th>
                            <th>{{ "Rp.".number_format($sum_subtotal_hpp_p,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($sum_subtotal_hpp_s,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($total_hpp,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($part_dpp,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($jasa_dpp,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($total_dpp,0,',','.')}}</th>
                        </tr>
                        <tr>
                            <th colspan="4">Gross Margin(DPP)</th>
                            <th>{{ "Rp.".number_format($margin_part_dpp,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($margin_jasa_dpp,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($margin_total_dpp,0,',','.')}}</th>
                        </tr>
                        <tr>
                            <th colspan="4">%</th>
                            <th>@php if($margin_part_dpp > 0){echo round(($margin_part_dpp / $part_dpp)* 100)."%";  }@endphp</th>
                            <th>@php if($margin_jasa_dpp > 0){echo round(($margin_jasa_dpp / $jasa_dpp)* 100)."%";  }@endphp</th>
                            <th>{{ round(($margin_total_dpp / $total_dpp)* 100)."%"  }}</th>
                        </tr>
                        <tr>
                            <th>PPN</th>
                            <th>{{ "Rp.".number_format($part_ppn,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($jasa_ppn,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($total_ppn,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($sum_asuransi_p,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($sum_asuransi_s,0,',','.')}}</th>
                            <th>{{ "Rp.".number_format($total_spk,0,',','.')}}</th>
                        </tr>
                        <tr>
                            <th colspan="4">Gross Margin(PPN)</th>
                            <th>{{ "Rp.".number_format($margin_part_ppn,0,',','.')}}</th>
                                <th>{{ "Rp.".number_format($margin_jasa_ppn,0,',','.')}}</th>
                                <th>{{ "Rp.".number_format($margin_total_ppn,0,',','.')}}</th>
                        </tr>
                        <tr>
                            <th colspan="4">%</th>
                            <th>@php if($margin_part_ppn > 0){echo round(($margin_part_ppn / $sum_asuransi_p)* 100)."%";  }@endphp</th>
                            <th>@php if($margin_jasa_ppn > 0){echo round(($margin_jasa_ppn / $sum_asuransi_s)* 100)."%";  }@endphp</th>
                            <th>{{ round(($margin_total_ppn / $total_spk)* 100)."%"  }}</th>
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
                                <div class="form-group">
                                    <label for="status" class="col-sm-12 control-label">Status</label>
                                    <div class="col-sm-12">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Penawaran">Penawaran</option>
                                            <option value="Estimasi">Estimasi</option>
                                        </select>
                                    </div>
                                </div>
                                <p><pre>Pilih penawaran jika data sudah benar, jika ada perubahan data pilih estimasi untuk mengembalikan kepada estimator!</pre></p>
                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                        value="create">Lanjutkan
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
        
//TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function () {
            $("#id").attr('readonly', false)
            $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Konfirmasi"); //valuenya tambah pegawai baru
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
                        url: "{{ route('asuransi.create') }}", //url simpan data
                        type: "GET", //karena simpan kita pakai method POST
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
                            location.reload();
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }
    </script>
    @endpush
