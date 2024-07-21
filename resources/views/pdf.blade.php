<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style account="text/css">
        .logoSalvus {
            float: left;
            height: 30px;
        }

        .companyAddress {
            margin-top: 80px;
            margin-left: 260px;
        }

        .box1 {
            height: 180px;
            border: 1px solid black;
            padding: 10px;
        }

        .box2 {
            height: 380px;
            border: 1px solid black;
            width: 320px;
            float: left;
            padding: 10px;
        }

        .box3 {
            height: 380px;
            border: 1px solid black;
            width: 340px;
            float: right;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            {{-- <img src='{{ public_path() . '/images/salvus-logo.png' }}' class="logoSalvus"> --}}
            <div class="companyAddress">
                <table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <p class="name"><b>Bukti Pembayaran</b></p>
                                {{-- <p style="font-size: 12px">No : 568383 / SURYA ANDRITAMA, PT</p> --}}
                                {{-- <p style="font-size: 12px">REF : 568383</p> --}}
                            </td>
                            {{-- <td style="width: 280px"></td>
                            <td style="width: 200px; justify-content:">
                                <p style="font-size: 12px;">Issue Date : <b style="font-size: 14px !important">14
                                        September
                                        2023</b></p>
                            </td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </header>
        <main>
            <hr>
            <center>
                {{-- <p><b style="font-size: 14px;">THIS PREMIUM NOTE IS NOT A RECEIPT NOR PROOF OF PAYMENT</b></p> --}}
            </center>
            <div class="box1">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Order ID</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->id }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Pasien</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->Pasien->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Alamat</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->Pasien->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Email</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->Pasien->email }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">No Telepon</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->Pasien->no_hp }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Tanggal</td>
                            <td>: </td>
                            <td style="font-size: 12px">{{ @$data->tanggal }}</td>
                        </tr>
                        <tr>
                            <td style="width: 140px; font-size: 12px">Jam</td>
                            <td>: </td>
                            <td style="width: 300px; font-size: 12px">
                                {{ @$data->jam }}
                            </td>
                            <td style="font-size: 12px">Tanggal Pembayaran</td>
                            <td style="font-size: 12px"> <b
                                    style="font-size: 14px !important">{{ date('d-m-Y', strtotime(@$data->updated_at)) }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="box2">
                <p style="font-size: 11px">Berikut adalah detail perawatan yang telah dilakukan :</p>
                <table>
                    <tbody>
                        <tr>
                            <td style="font-size: 12px; font-weight: bold;">Klinik</td>
                            <td style="font-size: 12px; font-weight: bold;">: </td>
                            <td style="font-size: 12px; font-weight: bold;">{{ @$data->Klinik->name }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; font-weight: bold;">Service</td>
                            <td style="font-size: 12px; font-weight: bold;">: </td>
                            <td style="font-size: 12px; font-weight: bold;">{{ @$data->Service->name }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; font-weight: bold;">Dokter</td>
                            <td style="font-size: 12px; font-weight: bold;">: </td>
                            <td style="font-size: 12px; font-weight: bold;">{{ @$data->Dokter->name }}</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 11px">Terima kasih atas kepercayaan Anda kepada kami. Jika ada pertanyaan atau
                    kejelasan, silakan hubungi kami di:</p>

                <table>
                    <tbody>
                        <tr>
                            <td style="font-size: 11px">Alamat</td>
                            <td style="font-size: 11px">: </td>
                            <td style="font-size: 11px">{{ @$data->Klinik->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px">Email</td>
                            <td style="font-size: 11px">: </td>
                            <td style="font-size: 11px">doktergigi_@gmail.com</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px">Telepon/Whatsapp</td>
                            <td style="font-size: 11px">: </td>
                            <td style="font-size: 11px">{{ @$data->Klinik->no_tlpn }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <b style="font-size: 11px">Disclaimer:</b>
                <p style="font-size: 11px"><i>Invoice ini hanya mencakup biaya pelayanan dokter gigi dan tidak mencakup
                        obat-obatan atau bahan tambahan lainnya, kecuali dinyatakan sebaliknya.</i></p>
                <p style="font-size: 11px"><i>Semua informasi pasien yang terkandung dalam invoice ini dijaga
                        kerahasiaannya sesuai dengan kebijakan privasi yang berlaku. Informasi ini hanya digunakan untuk
                        keperluan administratif dan penagihan.</i></p>
            </div>
            <div class="box3">
                <table>
                    <tbody>
                        <tr>
                            <td style="font-size: 12px; width: 200px;"><b>Metode Pembayaran</b></td>
                            <td style="font-size: 12px">: </td>
                            <td style="font-size: 12px">{{ @$data->pembayaran }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; width: 200px;"><b>TOTAL BIAYA</b></td>
                            <td style="font-size: 12px">: </td>
                            <td style="font-size: 12px">Rp.
                                {{ number_format(@$data->biaya ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </main>
    </div>
</body>

</html>
