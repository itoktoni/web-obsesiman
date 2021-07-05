<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice_{{ str_replace("SO","INV",$master->laundry_id ?? '') }}</title>

    <style>
    body {
        margin: 10px;
    }

    .print-only {
        display: none !important
    }

    * {
        background: transparent !important;
        color: black !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        text-shadow: none !important;
        -webkit-filter: none !important;
        filter: none !important;
        -ms-filter: none !important
    }

    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    a,
    a:visited {
        text-decoration: underline
    }

    a[href]:after {
        content: "("attr(href) ")"
    }

    abbr[title]:after {
        content: "("attr(title) ")"
    }

    .ira:after,
    a[href^="javascript:"]:after,
    a[href^="#"]:after {
        content: ""
    }

    pre,
    blockquote {
        border: 1px solid #999;
        page-break-inside: avoid
    }

    thead {
        display: table-header-group
    }

    tr,
    img {
        page-break-inside: avoid
    }

    img {
        max-width: 100% !important;
        vertical-align: middle;
        max-height: 100% !important
    }

    table {
        border-collapse: collapse
    }

    th,
    td {
        padding: 0.25em 8px;
        vertical-align: top
    }

    dl {
        margin: 0
    }

    dd {
        margin: 0
    }

    @page {
        margin: 1.25cm 0.5cm
    }

    p,
    h2,
    h3 {
        orphans: 3;
        widows: 3
    }

    h2,
    h3 {
        page-break-after: avoid
    }

    .hide-on-print {
        display: none !important
    }

    .print-only {
        display: block !important
    }

    .hide-for-print {
        display: none !important
    }

    .show-for-print {
        display: inherit !important
    }

    .break-page-after {
        page-break-after: always;
        page-break-inside: avoid
    }

    html {
        overflow-x: visible
    }

    body {
        font-size: 12px;
        line-height: 1.5;
        font-family: "sans-serif",
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: normal
    }

    h1 a,
    h2 a,
    h3 a,
    h4 a,
    h5 a,
    h6 a {
        font-weight: inherit
    }

    h2 {
        font-size: 2em;
        line-height: 1.5;
        margin-bottom: 0.75em
    }

    h3 {
        font-size: 1.5em;
        line-height: 1;
        margin-top: 2em;
        margin-bottom: 1em
    }

    h4 {
        font-size: 1.25em;
        line-height: 2.4
    }

    h5 {
        font-weight: bold;
        margin-top: 2.25em;
        margin-bottom: 0.75em
    }

    h6 {
        text-transform: uppercase;
        margin-top: 2.25em;
        margin-bottom: 0.75em
    }

    #page {
        width: 100%;
        position: relative
    }

    .bukalapak-transaction-slip {
        padding: 8px 9px;
        border: solid 1px #000;
        margin-bottom: 18px;
        width: 100%;
        position: relative
    }

    .bukalapak-transaction-slip--brand {
        height: 27px;
        display: block;
        float: left
    }

    .bukalapak-transaction-slip--heading {
        margin-top: 0;
        display: block;
        float: right;
        line-height: 1;
        font-size: 18px
    }

    .bukalapak-transaction-slip--courier {
        margin-top: -5px;
        display: block;
        float: right;
        font-size: 14px;
        position: relative;
        width: 100%;
        text-align: right
    }

    .bukalapak-transaction-slip-buyer {
        margin-top: 9px;
        margin-bottom: 9px;
        padding-right: 18px;
        clear: both;
        float: left;
        width: 62%;
        border-right: dotted 1px #000
    }

    .bukalapak-transaction-slip-buyer--heading {
        font-weight: bold;
        margin-top: 0
    }

    .bukalapak-transaction-slip-buyer--label {
        display: block;
        float: left;
        clear: both;
        width: 25%
    }

    .bukalapak-transaction-slip-buyer--label:after {
        content: ":"
    }

    .bukalapak-transaction-slip-buyer--name,
    .bukalapak-transaction-slip-buyer--phone {
        font-weight: bold
    }

    .bukalapak-transaction-slip-buyer--address {
        display: block;
        float: left;
        font-weight: bold;
        width: 75%;
        white-space: -moz-pre-wrap !important;
        white-space: -pre-wrap;
        white-space: -o-pre-wrap;
        white-space: pre-wrap;
        white-space: normal
    }

    .bukalapak-transaction-slip-seller {
        display: block;
        float: left;
        width: 38%;
        margin-top: 9px;
        margin-bottom: 9px;
        padding-left: 18px
    }

    .bukalapak-transaction-slip-seller--heading {
        font-weight: bold;
        margin-top: 0em
    }

    .bukalapak-transaction-slip-seller--lapak,
    .bukalapak-transaction-slip-seller--name {
        white-space: nowrap
    }

    .bukalapak-transaction-slip--footer {
        display: block;
        width: 100%;
        clear: both;
        margin-top: 18px;
        border-top: solid 1px #000;
        padding-top: 5px;
        font-size: 9px
    }

    .bukalapak-transaction-product {
        clear: both;
        position: relative;
        width: 100%
    }

    .bukalapak-transaction-product-item {
        width: 80%
    }

    .bukalapak-transaction-product-quantity {
        width: 20%
    }

    .address p {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    #description {
        line-height: 0.9px !important;
    }

    #logo {
        height: 100px;
        margin-top: 0px;
    }

    #box {
        position: absolute;
        right: 0;
        text-align: right;
        top: -20px;
    }

    #box h1 {
        margin-bottom: 0px;
        margin-right: -15px;
        font-size: 25px;
        text-align: left;
    }

    #box h2 {
        position: absolute;
        top: 55px;
        left: -3;
        text-align: left;
        font-size: 12px;
    }

    #box table {
        position: absolute;
        top: 40px;
        z-index: 9;
        padding: 0px;
        right: 0px;
        width: 280px;
        font-size: 10px;
    }

    #box table .head {
        width: 110px;
        text-align: right;
    }

    #address {
        margin-bottom: 20px;
        position: absolute;
        top: 55px;
        margin-left: 0px;
    }

    #address h4 {
        font-size: 12px;
    }

    #address p {
        margin-top: -25px;
        font-size: 10px;
        margin-bottom: 50px;
    }

    #container {
        margin-top: 100px;
    }

    #container table {
        margin-top: 60px;
        width: 100% !important;
    }

    #container table .destination td {
        text-align: left;
    }

    #container table .contact {
        text-align: center;
    }

    #container table .contact strong {
        font-size: 15px;
    }

    #container table .person {
        margin-top: 20px;
    }

    #container table .contact td {
        padding-top: 0px;
        padding-bottom: 5px;
    }

    #container table .contact td p {
        line-height: 1px;
        margin-bottom: 0px;
    }

    #container table .rest {
        text-align: left;
    }

    #container #headline {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        padding-top: 5px;
        padding-bottom: 0px;
        margin: 0px;
    }

    #container table .message {
        margin-top: -15px !important;
        vertical-align: middle !important;
        padding-bottom: 20px !important;
    }

    #container table .message p {
        margin-bottom: -15px !important;
        line-height: 15px !important;
    }

    #container table .header td {
        padding-bottom: 7px;
    }

    #container table .header .no {
        width: 15px;
    }

    #container table .header .product {
        width: 150px;
    }

    #container table .header .qty {
        width: 50px;
        text-align: right;
    }

    #container table .header .price {
        width: 50px;
        text-align: right;
    }

    #container table .header .total {
        width: 120px;
    }

    #container table .item td {
        vertical-align: middle !important;
    }

    #container table .item .no {
        text-align: center;
    }

    #container table .item .qty {
        text-align: right;
    }

    #container table .item .price {
        text-align: right;
    }

    #container table .item .total {
        text-align: left;
    }

    #container table .item .total span {
        position: relative;
        font-weight: bold;
        display: block;
        right: 0px;
        font-size: 7px;
        margin-left: 5px;
    }

    #container table .item .product h1 {
        font-size: 12px;
        margin: 0px;
    }

    #container table .item .product h2 {
        font-size: 10px;
        font-weight: bold;
        margin: 0px;
    }

    #container table .item .product h3 {
        font-size: 10px;
        text-align: left;
        font-weight: bold;
        margin: 0px;
        margin-top: 5px;
    }

    #container table .item .product p {
        font-size: 11px;
        text-align: left;
        margin: 0px;
    }

    #container table .item .product span {
        position: relative;
        font-weight: bold;
        display: block;
        right: 0px;
        font-size: 10px;
        margin-left: 5px;
        margin-top: 20px;
    }

    #container table .total_product td {
        text-align: right;
        font-weight: bold;
    }

    #container table .total_discount td {
        text-align: right;
        padding-bottom: 10px;
    }

    #container table .total_tax td {
        text-align: right;
        background-color: #F5F5F5 !important;
        padding-bottom: 10px;
    }

    #container table .total_sumary td {
        text-align: right;
        background-color: lightgray !important;
        padding-bottom: 10px;
        font-weight: bold;
    }

    #paraf {
        margin-top: 10px;
        width: 100%;
        font-size: 10px;
        margin-bottom: -50px;
    }

    #paraf .header td {
        background-color: #F5F5F5 !important;
    }

    #paraf .content .sign {
        height: 130px;
        vertical-align: bottom !important;
        text-align: center;
    }


    #paraf .content .description {
        vertical-align: middle !important;
        text-align: left;
        line-height: 1px;
    }

    #paraf .header .sign {
        width: 150px;
        text-align: center;
    }

    #paraf .header .term {
        text-align: left;
    }

    table td {
        padding: 0px 5px;
    }

    .page_break {
        page-break-before: always;
    }

    .page:after {
        content: counter(page, decimal);
    }

    @page {
        padding:0px;
    }

    .pagination{
        padding-bottom:3px;
        border:none !important;
    }

    .bawah{
        position: fixed;
        bottom: 20px;
    }

    #box table td{
        border: dotted 1px #000;
    }

    .header td{
        border: dotted 1px #000;
    }

    .item td{
        border: dotted 1px #000;
    }

    #tanda td{
        border: dotted 1px #000;
    }

    .total_product td{
        border: dotted 1px #000;
    }

    .nomer td{
        font-size: 12px;
    }

    </style>

</head>

<body>
    <div id='page'>
        <div>
            <div id="box">
                <h1>
                    <span>
                        {{ config('website.name') }} <small style="font-size: 15px;">Laundry and Rental</small>
                    </span>
                </h1>
                <h2>
                    {{ config('website.address') }}
                </h2>
                <table>
                    <tr class="nomer">
                        <td class="head">
                            No. Surat Jalan
                        </td>
                        <td>
                            {{ $master->laundry_id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="head">
                            Tanggal
                        </td>
                        <td>
                            {{ $master->laundry_date->isoformat('dddd, D MMMM Y') ?? '' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="container">
            <table cellpadding="" 5 cellspacing="0" width="100%">
                <tr>
                    <td align='left' colspan='8' valign='middle'>
                        <h1 id="headline">
                            FORMULIR SERAH TERIMA LINEN BERSIH
                        </h1>
                    </td>
                </tr>
                <tr class="contact">
                    <td colspan='8'>
                        <strong>
                            {{ $master->customer->crm_customer_name ?? '' }}
                        </strong>
                        <p>
                            {{ $master->customer->crm_customer_contact_address ?? '' }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p>
                            @php
                            $total_delivery = intval($detail->sum('total'));
                            $total_discount = $master->laundry_discount_percent * $total_delivery / 100;
                            $total_tax = $total_delivery * $master->laundry_tax_percent / 100;
                            $grand_total = intval($total_delivery - $total_discount) + intval($total_tax);
                            @endphp
                        </p>
                    </td>
                </tr>
                @php
                $jumlah = count($detail);
                $nomer = 1;
                @endphp
                @if($jumlah > 1)
               
                <tr class="header">
                    <td class="no" align="center">
                        <strong>No.</strong>
                    </td>
                    <td class="product" align="center" colspan="4">
                        <strong>Jenis Linen</strong>
                    </td>
                    <td class="price">
                        <strong>Yang dikirim</strong>
                    </td>
                    <td class="qty">
                        <strong>Yang diantar</strong>
                    </td>
                    <td class="total" align="center">
                        <strong>Keterangan</strong>
                    </td>
                </tr>
                @foreach($detail as $item)
                
                <tr class="item">
                    <td class="no" align="center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="product" colspan="4">
                        <p>
                            {{ $item->laundry_detail_product_name ?? '' }}
                        </p>
                    </td>
                    <td class="price">
                        {{ $item->laundry_detail_kotor ?? '' }}
                    </td>
                    <td class="qty">
                        {{ $item->laundry_detail_bersih ?? '' }}
                    </td>
                    <td class="total">
                        {{ $item->laundry_detail_notes ?? '' }}
                    </td>
                </tr>

                @endforeach
                @endif

                <tr class="total_product">
                    <td class="product" colspan="5">
                        Total Linen
                    </td>
                    <td class="qty">
                        {{ $detail->sum('laundry_detail_kotor') ?? '' }}
                    </td>
                    <td class="qty">

                        {{ $detail->sum('laundry_detail_bersih') ?? '' }}
                    </td>
                    <td class="total">

                    </td>
                </tr>

            </table>

        </div>
        <div style="width: 100%;margin-top:5px">
            <table id="tanda" style="text-align: center;margin:0px auto !important" width="100%" border="0"
                style="margin-top:5px;width:70% !important;font-size:10px;margin-bottom:-50px">
                <tr>
                    <td align="center"></td>
                    <td align="center">Petugas RS</td>
                    <td align="center">Petugas Laundry</td>
                    <td align="center">Perawat</td>
                </tr>
                <tr>
                    <td style="width: 25%;vertical-align: middle;">
                        Penyerahan Kotor
                    </td>
                    <td style="width: 25%;">

                    </td>
                    <td style="width: 25%;text-align:center;vertical-align: bottom;">
                        {{ $master->user->name ?? '' }}
                    </td>
                    <td>
                        <br>
                        <br>
                    </td>
                </tr>

                <tr>
                    <td style="width: 25%;vertical-align: middle;">
                        Penyerahan Bersih
                    </td>
                    <td style="width: 25%;">

                    </td>
                    <td style="width: 25%;text-align:center;vertical-align: bottom;">
                        {{ $master->user->name ?? '' }}
                    </td>
                    <td>
                        <br>
                        <br>
                    </td>
                </tr>

            </table>
        </div>

</body>

</html>