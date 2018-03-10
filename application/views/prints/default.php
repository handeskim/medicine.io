<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/dist/css/AdminLTE.min.css">

<style type="text/css">
@media print
{
    .header { display: none; }
    #printable { display: block; }
    @page { margin: 0; }
      body { margin: 1.6cm; }
}
.header_info_cart {
    margin: 10px;
    background: #ecf0f5;
    height: 45px;
    padding: 15px;
    text-align: left;
    text-transform: uppercase;
    color: #333;
    border-bottom: 2px solid #fff212;
    font-size: 16px;
}
</style>
</head>
<body>
<div >
<div class="header" style="margin-bottom: 50px; width: 100%;float: left;">
<button class="btn btn-default header_li" onClick="window.print()">Print this page</button>
</div>
</div>
	<div class="container">
	
		<div class="row">
			<div class="col-md-12">
				
			</div>
			<div class="col-md-12">
				<?php echo $content; ?>
			</div>
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
<div >
<div class="header" style="margin-bottom: 50px; width: 100%;float: left;">
<button class="btn btn-default header_li" onClick="window.print()">Print this page</button>
</div>
</div>
	
<style>
.invoice_total{
	text-align: right;
	
}
.invoice-box {
	max-width: 1000px;
	margin: auto;
	padding: 30px;
	border: 1px solid #eee;
	box-shadow: 0 0 10px rgba(0, 0, 0, .15);
	font-size: 16px;
	line-height: 24px;
	font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	color: #555;
}

.invoice-box table {
	width: 100%;
	line-height: inherit;
	text-align: left;
}

.invoice-box table td {
	padding: 5px;
	vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
	text-align: right;
}

.invoice-box table tr.top table td {
	padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
	font-size: 45px;
	line-height: 45px;
	color: #333;
}

.invoice-box table tr.information table td {
	padding-bottom: 40px;
}

.invoice-box table tr.heading td {
	background: #eee;
	border-bottom: 1px solid #ddd;
	font-weight: bold;
}

.invoice-box table tr.details td {
	padding-bottom: 20px;
}

.invoice-box table tr.item td{
	border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
	border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
	border-top: 2px solid #eee;
	font-weight: bold;
}

@media only screen and (max-width: 600px) {
	.invoice-box table tr.top table td {
		width: 100%;
		display: block;
		text-align: center;
	}
	
	.invoice-box table tr.information table td {
		width: 100%;
		display: block;
		text-align: center;
	}
}

/** RTL **/
.rtl {
	direction: rtl;
	font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
	text-align: right;
}

.rtl table tr td:nth-child(2) {
	text-align: left;
}
</style>	
</body>