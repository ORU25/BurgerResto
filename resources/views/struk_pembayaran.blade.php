<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('image/logo_BR.png') }}" type="image/x-icon"/>
    <title>Struk Pembayaran</title>
    <style>
        td{
            padding:5px;
            
        }
        h3{
            padding: 5px;
            text-align: center;
        }
        h5{
            padding: 5px;
            text-align: center;
        }
        
        @media print{
            .noprint{
                display:none;
            }
        }
        .beranda{
            padding: 20px;
            background-color: rgb(60, 60, 236);
            color: white;
            text-transform: uppercase    
            font-size: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .beranda2{
            padding: 20px;
            background-color: rgb(65, 241, 65);
            color: white;
            text-transform: uppercase    
            font-size: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .footer{

            padding-bottom: 30px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        .outro{
            text-align: center
        }
    </style>
</head>
<body>
    <h3>Burger Resto</h3>
    <h5>Struk ini bukti pembayaran pesanan anda</h5>
    <table>
        <tr>
            <td>Kasir</td>
            <td>: {{ $pembayaran->pesanan->user->username }}</td>
        </tr>
        @if ($pembayaran->pesanan->meja->nomor_meja == 0)
            <tr>
                <td>No Meja</td>
                <td>: Bawa Pualng</td>
            </tr>
        @else
            <tr>
                <td>No Meja</td>
                <td>: {{ $pembayaran->pesanan->meja->nomor_meja }}</td>
            </tr>
        @endif
        <tr>
            <td>No Pesanan</td>
            <td>: {{ $pembayaran->pesanan_id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ $pembayaran->pesanan->created_at }}</td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%;">
        <tr>
            <td style="font-weight: bold">Menu</td>
            <td style="font-weight: bold">Harga</td>
            <td style="font-weight: bold">Jumlah</td>
            <td style="font-weight: bold">Total</td>
        </tr>
        @foreach ($pembayaran->pesanan->detail_pesanan as $detail)
            <tr>
                <td>
                    
                        {{ $detail->menu->nama }}
                    
                </td>
                <td>
                    
                        Rp{{ number_format($detail->menu->harga, 2,",",".") }}
                    
                </td>
                <td>
                    
                        {{ $detail->jumlah }}
                    
                </td>
                <td>
                    
                        Rp{{ number_format($detail->menu->harga * $detail->jumlah, 2,",",".") }}
                    
                </td>
            </tr>                                           
        @endforeach
            <tr style="margin-top: 3px">
                <td></td>
                <td></td>
                <td style="font-weight: bold">Total Harga: </td>
                <td>
                    
                        Rp{{ number_format($pembayaran->total_harga, 2,",",".") }}
                    
                </td>
            </tr>
            <tr style="margin-top: 3px">
                <td></td>
                <td></td>
                <td style="font-weight: bold">Tunai: </td>
                <td>
                    
                        Rp{{ number_format($pembayaran->detail_pembayaran->tunai, 2,",",".") }}
                    
                </td>
            </tr>
            <tr style="margin-top: 3px">
                <td></td>
                <td></td>
                <td style="font-weight: bold">Kembalian: </td>
                <td>
                    
                        Rp{{ number_format($pembayaran->detail_pembayaran->kembalian, 2,",",".") }}
                    
                </td>
            </tr>
    </table>

    <h5 class="outro">jangan lupa untuk datang lagi, karena kamu istimewa</h5>
    
    <div class="footer noprint">
        
        <a href="" onclick="window.print()" class="beranda2 noprint">Print Struk</a>
        <a href="{{ route('pembayaran.index') }}" class="beranda noprint">Kembali Ke Beranda</a>
    </div>
    <script>
        window.addEventListener("load", window.print());
        
    </script>
</body>
</html>