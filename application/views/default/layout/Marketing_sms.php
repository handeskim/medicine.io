
<section class="content">
<div class="row">
  <div class="col-md-12">
   <form action="#" method="POST" enctype="multipart/form-data">
	<div class="col-md-12">
		<div class="form-group">
			<label>Nội dung SMS ( viết không dấu)</label>
			<input class="form-control" name="title_email" value="" placeholder="Tiêu đề "/>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
				<div class="form-group">
					<label>Đường dẫn tới file SMS (.txt) (700đ/1sms) </label>
					<input id="fileuploadID" type="file" name="file"><br>
					<label>Example: <a target="_blank" href="<?php echo base_url('text_export/dowload_sms')?>"> SMS File Mẫu </a>(lưu ý không hỗ trợ định dạng khác ngoài file.txt) dowload file mẫu. </label>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" style="margin-top: 10px;">
			<div class="col-md-6">
				<input type="hidden" name="cmd" value="c1"/>
				<input id="btnConvert" name="submit" value="Start Send" type="submit" class="btn btn-primary"> </input>
			</div>	
		</div>	
	</div>
</form>
  </div>
</div>
</section>