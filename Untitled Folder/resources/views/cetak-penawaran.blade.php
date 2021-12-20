<html>

<head>
    <title>Cetak Penawaran</title>
</head>

<body onload="window.print()">
    <table align="center" border="0" cellpadding="1" style="width: 700px;">
        <tbody>
            <tr>
                <td colspan="3">
                    <div align="center">
                        {{-- <span style="font-family: Verdana; font-size: x-small;"><b><h2>Autokool</h2> --}}
                            <img src="{{asset('assets/img/logo.jpg')}}" width="300" height="80">
                        <hr />
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="0" style="width: 239px;">
                        <tbody>
                            <tr>
                                <td width="74"><span style="font-size: x-small;"><strong>Kepada YTH.</strong></span></td>
                                <td width="11">
                                </td>
                                <td width="140"></td>
                            </tr>
                            <tr>
                                <td><span style="font-size: x-small;">{{ $kepada }}</span></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td><span style="font-size: x-small;">di</span></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td><span style="font-size: x-small;">tempat</span></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
        
        <table align="center" border="0" cellpadding="1" style="width: 700px;">
            <tr>
                <td colspan="3" height="270" valign="top">
                    <div align="justify">
                        <pre><span style="font-size: x-small;">Bersama ini kami ajukan Estimasi Perbaikan Kendaraan dengan data-data sebagai berikut:</span></pre>
                        <table border="0" style="width: 352px;">
                            <tbody>
                                <tr>
                                    <td width="80"><span style="font-size: x-small;">Tanggal</span></td>
                                    <td width="10"><span style="font-size: x-small;">:</span></td>
                                    <td width="248"><span style="font-size: x-small;">{{ $estimates->tgl }}</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: x-small;">Asuransi</span></td>
                                    <td><span style="font-size: x-small;">:</span></td>
                                    <td><span style="font-size: x-small;">{{ $estimates->asuransi }}</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: x-small;">No. Pol</span></td>
                                    <td><span style="font-size: x-small;">:</span></td>
                                    <td><span style="font-size: x-small;">{{ $estimates->nopol }}</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: x-small;">Type</span></td>
                                    <td><span style="font-size: x-small;">:</span></td>
                                    <td><span style="font-size: x-small;">{{ $estimates->type }}</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: x-small;">Tahun</span></td>
                                    <td><span style="font-size: x-small;">:</span></td>
                                    <td><span style="font-size: x-small;">{{ $estimates->tahun }}</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: x-small;">Nama Tertanggung</span></td>
                                    <td><span style="font-size: x-small;">:</span></td>
                                    <td><span style="font-size: x-small;">{{ $estimates->nama_tertanggung }}</span></td>
                                </tr>
                            </table>
                            
                            <div align="center"><h6><span class="badge badge-dark">Spare Part</span></h6></div>
        <table align="center" border="1" cellpadding="1" style="width: 700px;">
            <thead>
                <tr>
                    <th><span style="font-size: x-small;">No. Part</span></th>
                    <th><span style="font-size: x-small;">Spare Part</th>
                    <th><span style="font-size: x-small;">QTY</th>
                    <th><span style="font-size: x-small;">Pricelist(ppn)</th>
                    <th><span style="font-size: x-small;">Subtotal(ppn)</th>
                </tr>
            </thead>
            <tbody>
                @php
                setlocale(LC_MONETARY,"en_ID");
                $sum_qty = 0;
                $sum_price_p = 0;
                $sum_sub_price_p = 0;
                @endphp
                @foreach ($part as $j)
                <tr>
                    <td><span style="font-size: x-small;">{{ $j->nopart }}</td>
                    <td><span style="font-size: x-small;">{{ $j->sparepart }}</td>
                    <td><span style="font-size: x-small;">{{ $j->qty }}</td>
                    <td><span style="font-size: x-small;">{{ "Rp.".number_format($j->after,0,',','.') }}</td>
                    <td><span style="font-size: x-small;">{{ "Rp.".number_format(($j->after * $j->qty ),0,',','.') }}</td>
                </tr>
                @php 
                $sum_qty += $j->qty;
                $sum_price_p += $j->after;
                $sum_sub_price_p += $j->after * $j->qty;
                @endphp
                @endforeach
                
                <tr>
                    <th colspan="2"><span style="font-size: x-small;">TOTAL</th>
                    <th><span style="font-size: x-small;">{{ $sum_qty}}</th>
                    <th><span style="font-size: x-small;">{{ "Rp.".number_format($sum_price_p,0,',','.')}}</th>
                    <th><span style="font-size: x-small;">{{ "Rp.".number_format($sum_sub_price_p,0,',','.')}}</th>
                    
                </tr>
            </tbody>
        </table>
        <hr>
        <div align="center"><h6><span class="badge badge-dark">Jasa</span></h6></div>
        <table align="center" border="1" cellpadding="1" style="width: 700px;">
            <thead>
                <tr>
                    <th><span style="font-size: x-small;">Jasa</th>
                    <th><span style="font-size: x-small;">Note</th>
                    <th><span style="font-size: x-small;">QTY</th>
                    <th><span style="font-size: x-small;">Pricelist(ppn)</th>
                    <th><span style="font-size: x-small;">Subtotal(ppn)</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                setlocale(LC_MONETARY,"en_ID");    
                $sum_qty = 0;
                $sum_price_s = 0;
                $sum_sub_price_s = 0;
                
                
                @endphp
                @foreach ($jasa as $i)
                <tr>
                    <td><span style="font-size: x-small;">{{ $i->jasa }}</td>
                    <td><span style="font-size: x-small;">{{ $i->note }}</td>
                    <td><span style="font-size: x-small;">{{ $i->qty }}</td>
                    <td><span style="font-size: x-small;">{{ "Rp.".number_format($i->price_s,0,',','.') }}</td>
                    <td><span style="font-size: x-small;">{{ "Rp.".number_format(($i->price_s * $i->qty ),0,',','.') }}</td>
                    
                </tr>
                @php 
                $sum_qty += $i->qty;
                $sum_price_s += $i->price_s;
                $sum_sub_price_s += $i->price_s * $i->qty;
                
                @endphp
                @endforeach
                
                <tr>
                <th colspan="2"><span style="font-size: x-small;">TOTAL</th>
                <th><span style="font-size: x-small;">{{ $sum_qty}}</th>
                <th><span style="font-size: x-small;">{{ "Rp.".number_format($sum_price_s,0,',','.')}}</th>
                <th><span style="font-size: x-small;">{{ "Rp.".number_format($sum_sub_price_s,0,',','.')}}</th>
                
                
            </tr>
            
            </tbody>
        </table>
        <hr>
        <table align="center" border="0" cellpadding="1" style="width: 700px;">
            
            <tr>
                
                <td width="80"><span style="font-size: x-small;"><strong>TOTAL PART & JASA</strong></span></td>
                <td width="10"><span style="font-size: x-small;">:</span></td>
                <td width="248"><span style="font-size: x-small;"><strong>{{ "Rp.".number_format(($sum_sub_price_p + $sum_sub_price_s),0,',','.')}}</strong></span></td>
            </tr>
            <tr>
                <td colspan="5">
                    <div>
                        <span style="font-size: x-small;"><i> Note : Estimasi tersebut belum termasuk perkiraan harga Spare Parts dan Jasa yang tidak terduga , dan Harga tidak mengikat
                        </i></span></div>
                    <div align="center">
<br>
                    </div>
                    <div>
                        <span style="font-size: x-small;">Cirebon      {{ $estimates->tgl }}</span>
                    </div>
                    <div align="center">
                        <br>
                                            </div>
                    <div>
                        <span style="font-size: x-small;">{{ $pengirim }}</span>
                    </div>
                </td>
            </tr>
            
        </table>
        <table align="center" border="0" cellpadding="1" style="width: 700px;position: fixed; bottom: 0;" >
            <tr>
                <td style="font-size: x-small;" align="center">
                    <hr> 
                    <p><strong>Body repair – Las / Panel Repair – Cat Oven</strong></p>
                    <p> Jl. Raya Sunan Gunung Jati no. 91 ( Pasindangan ) Tlp.: 0231-202948, 206231, Fax.: 0231- 221009, CIREBON 45151</p>
                    <p>Email : autokoolbr@gmail.com</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
