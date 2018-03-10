<section class="content">
<div class="row">
  <div class="col-md-2 col-sm-6 col-xs-12"><a target="_blank" href="<?php echo base_url()."excel_export?code=".$excel_command; ?>" ><span class="info-box-icon bg-yellow"><i class="fa fa-file-excel-o"></i></span></a></div>
  <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user-secret"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total customers</span>
              <span class="info-box-number">{total_customer}</span>
            </div>
          </div>
        </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $content; ?>
  </div>
</div>
</section>