<html>
<head>
<style>

    td {
        text-align: center;
        border: 1px grey solid;
    }

    th {
        text-align: center;
        border: 1px #373737 solid;
        background: #373737;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

</style>
</head>

<body style="font-family: 'Trebuchet MS', Tahoma, sans-serif; ">

    <div>
        <div>
            <div>
                <img style="width: 210px; margin-bottom: 15px;" src="https://backend.ecutech.gr/icons/logos/logowhite.png">
                <div>
                    <h3 style="margin-left: 0;">EcuTech Greece</h3>
                </div>
            </div>
            <div style="float: right;">
                <p><span class="" style="color:#888888;">Invoice :</span> <span>{{$invoice->invoice_id}}</span></p>
            </div>
        </div>
        <div>
            <div>
                <h2 style="width: 50%;">Total Amount: €{{$invoice->price_payed}}</h2>
            </div>
            <div style="float: right;">
                <p><span style="color:#888888;">Invoice Date :</span><span>{{$date}}</span></p>
            </div>
        </div>
        <div>
            <div>
                <p style="width: 50%;">Sampsountos 4A, Giannitsa 58100, Greece.</p>
                <p>files@ecutech.gr</p>
                <p>+302382700100</p>
            </div>
            <div style="float: right;">
                <p style="color:#888888;">Billed To</p>
                <p>{{$client->name}}</p>
                <p>{{$client->address}}</p>
                <p>{{$client->email}}</p>
                <p>{{$client->phone}}</p>
            </div>
        </div>
    </div>
    <div>
        <table style="width: 100%; margin-top: 200px;">
            <thead>
                <tr style="color: white;">
                    <th scope="col"> #</th>
                    <th scope="col">Items</th>
                    <th class="text-right" scope="col">Qty</th>
                    <th class="text-right" scope="col">Price</th>
                    <th class="text-right" scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$invoice->invoice_id}}</td>
                    <td class="text-right">1</td>
                    <td class="text-right">€{{$invoice->price_payed}}</td>
                    <td class="text-right">€{{$invoice->price_payed}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="float: right; margin-top: 10px;">
        <p class="">Subtotal : €{{$invoice->price_payed}}</p>
        <p class="">Tax amount :  €0,00  </p>
        <span class="col-sm-8 col-7 grand-total-title">
            <span style="font-size:20px;">Grand Total</span><span>: €{{$invoice->price_payed}}</span>
        </span> 
    </div>

    <div style="margin-top: 150px; border-top: 1px grey solid;">
        <p>Note: Thank you for doing Business with us.</p>    
    </div>
       
</body>
</html>