<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<section class="content">
<div class="row">
  <div class="col-md-12">
   <form action="#" method="POST" enctype="multipart/form-data">
	<div class="col-md-12">
		<div class="form-group">
			<label>Tiêu đề email</label>
			<input class="form-control" name="title_email" value="" placeholder="Tiêu đề  thư"/>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label>Nội dung cần gửi email</label>
			<textarea class="col-md-12 form-control" cols="50"  rows="10" id="listUid" name="contentEmail" placeholder="Nội dung thư"></textarea>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
				<div class="form-group">
					<label>Đường dẫn tới file Email (.txt) (Tối đa 100,000 Email 1 lần) </label>
					<input id="fileuploadID" type="file" name="file"><br>
					<label>Example: <a target="_blank" href="<?php echo base_url('text_export/dowload')?>"> Email File Mẫu </a>(lưu ý không hỗ trợ định dạng khác ngoài file.txt) dowload file mẫu. </label>
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
</section><script>
 $(function () {
     CKEDITOR.replace('listUid')
    $('.textarea').wysihtml5()
  });
</script>