<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pesanan</title>
    <style>
        td{
            padding:5px;
        }
        h3{
            padding: 5px;
        }
        
        
    </style>
</head>
<body>
    <h3>Burger Resto</h3>
    <table>
        <tr>
            <td>Kasir</td>
            <td>: {{ $pembayaran->pesanan->user->username }}</td>
        </tr>
        <tr>
            <td>No Meja</td>
            <td>: {{ $pembayaran->pesanan->meja->nomor_meja }}</td>
        </tr>
        <tr>
            <td>No Pesanan</td>
            <td>: {{ $pembayaran->pesanan_id }}</td>
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
    </table>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>
</html>