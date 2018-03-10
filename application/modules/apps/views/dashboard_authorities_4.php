<?php 
$user_data = $this->session->userdata('data_users');
$authorities = $user_data['authorities']; ?>
<script src="<?php echo base_url();?>app/apps_search.js"> </script>
<?php if($authorities ==3 || $authorities == 5){ ?>
<script src="<?php echo base_url();?>app/apps_search_p2.js"> </script>
<?php } ?>
<?php if($authorities ==4 ){ ?>
<script src="<?php echo base_url();?>app/apps_search_p3.js"> </script>
<?php } ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?php echo base_url();?>public/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<section class="content">
<div class="row">
	<div class="col-md-12">
		
		<?php if($authorities ==1|| $authorities == 2 || $authorities == 4){ ?>
		<div class="col-md-3">
			<a class="btn btn-primary"href="<?php echo base_url('cms/order_new');?>" ><i class="fa  fa-cart-plus"> </i>  Thêm mới đơn hàng</a>
		</div>
		<div class="col-md-3">
			<a class="btn btn-success" target="_blank" href="<?php echo base_url()."excel_export?code=".$excel_customer_command; ?>" ><i class="fa  fa-file-excel-o"> </i>  download {total_customer} khách hàng </a>
		</div>
		<?php } ?>
		<?php if($authorities ==3 || $authorities == 5){ ?>
		<div class="col-md-6">
		
		</div >
		<?php } ?>
		<div class="col-md-6" >
			<div class="col-md-6">
				<div class="form-group">
					<select id="index_search_option" class="form-control" name="index_search_option">
						<option value="1"> Tìm kiếm thường</option>
						<option value="2"> Tìm kiếm nâng cao </option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div id="normal_search" >
					<form id="frm_normal_search">
						<div class="form-group">
						  <input id="inbox_normal_search" type="text" name="q" class="form-control" placeholder="Từ khóa..." required>
						</div>
						<div class="form-group">
							<select class="form-control" name="finds" >
								<option value="1"> Tìm kiếm khách hàng</option>
								<option value="2"> Tìm kiếm đơn hàng</option>
								<?php if($authorities ==4){ ?>
								<option value="3"> Tìm kiếm lịch gọi lại</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="hidden" name="search" value="1">
							<button type="button"  id="btn_normal_search" class="btn btn-flat"><i class="fa fa-search"></i>Tìm kiếm </button>
						</div>
						
				   </form>
				</div>
			</div>
			<div id="advanced_search" class="col-md-12">
				<form id="frm_advanced_search">
				<div class="form-group" id="date_ranger">
					<div class="input-group">
					  <button type="button" class="btn btn-default pull-right" id="daterange-btn" >
						<span> 
							<i class="fa fa-calendar"></i> Chọn ngày Tìm kiếm
						</span>
						<input id="search_date" type="hidden" name="date_search" value="" required>
						<i class="fa fa-caret-down"></i>
					  </button>
					</div>
				</div>
				<div class="form-group">
				  <input id="inbox_normal_search" type="text" name="q" class="form-control" placeholder="Từ khóa..." required>
				</div>
				<input type="hidden" name="search" value="2">
				<button type="button"  class="btn btn-flat" id="btn_advanced_search"> <i class="fa fa-search" > </i> Tìm kiếm nâng cao</button>
			  </form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
		<div class="col-md-12">
			<div id="ResponseResults"></div>
		</div>
		<div class="col-md-12"> 
			<div id="ResponseResultsInfo"></div>
		</div>
	</div>
	
</div>
</section>
<script>
  $(function () {
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
		var date_search = start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY');
        $('#daterange-btn span').html(date_search);
        $('#search_date').val(date_search);
      }
    )
  })
</script>