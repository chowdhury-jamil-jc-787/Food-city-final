<!DOCTYPE html>
<html>
<head>
    <title>FoodCity</title>
   
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:65px;
        height:70px; 
        display: inline-block;
        vertical-align: middle;       
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .page-tools {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 1rem;
}

.action-buttons {
    display: flex;
}

.action-buttons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-left: 1px;
    padding: 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.95rem;
    color: #333;
    text-decoration: none;
}

.action-buttons a:hover {
    background-color: #f2f2f2;
}

.action-buttons a i {
    margin-right: 0.5rem;
    font-size: 1.2rem;

}

.action-buttons a[data-title="PDF"] {
    color: #d9534f;
}

.action-buttons a[data-title="PDF"] i {
    color: #d9534f;
}
.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.texty {
    display: inline-block;
    vertical-align: middle;
    font-size: 24px;
    margin-left: 10px;
  }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
    <div class="page-tools">
            <div class="action-buttons">
                <!-- <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a> -->
                <a class="btn bg-white btn-light mx-1px text-95" href="/invoiceDownload/{{ $data['transaction_id'] }}/{{ $product->id }}/{{ $quantity }}" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export as Pdf
                </a>
            </div>
        </div>
    </div>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{ $data['transaction_id'] }}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
    <p class="m-0 pt-5 text-bold w-100" style="text-align: right;">Status - <span class="gray-color">Unpaid</span></p>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>{{ $data['name'] }}</p>
                    <p>{{ $data['address'] }}</p>                    
                    <p>{{ $data['phone'] }}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                <p>{{ $data['name'] }}</p>
                    <p>{{ $data['address'] }}</p>                    
                    <p>{{ $data['phone'] }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>Shipping Cost - BDT 100</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Product ID</th>
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Subtotal</th>
        </tr>
        <tr align="center">
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $quantity }}</td>
            <td>{{ $data['amount'] }}</td>
        </tr>
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{ $data['amount'] }}</p>
                        <p>{{ $data['amount'] }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>