<div class="container" style="margin-bottom: 24px;">
	<?= form_open_multipart('user/form', ['id' => 'formID']) ?>
		<div class="row">
			<div class="col-md-6">
				<center>
					<div id="image_display" style="border: 1px solid grey; width: 300px; height: 300px;"></div>
					<br>
					<div id="progress-wrp" class="progress" style="display: none; width: 40%; height: 20px; position: relative;">
						<div class="progress-bar"></div>
						<div class="status" style="top: -5px; left: 48%; position: absolute; display: inline-block; color: black;"><small class="percent">0%</small></div>
					</div>
					<label class="btn btn-primary btn-file">
						Browse image <input type="file" name="upload" id="upload_photo" style="display: none;">
					</label>
				</center>
				<br>
				<div class="form-group">
					<textarea class="form-control" rows="10" name="deskripsi" placeholder="Deskripsi . . ."></textarea>
				</div>
			</div>
			<div class="col-md-6" style="border-left: 1px dashed rgb(26, 188, 156);">
				<div class="form-group">
					<input class="form-control" type="text" name="nama" placeholder="Nama Barang">
				</div>
				<div class="form-group">
					<input class="form-control" type="number" name="harga" placeholder="Harga Per Barang (in Rp.)">
				</div>
				<div class="form-group">
					<input class="form-control" type="number" name="stok" placeholder="Stok">
				</div>
				<div class="form-group">
					<select id="tipe" class="form-control" name="tipe">
						<option>Kategori</option>
						<?php  
							foreach ($kategori as $type)
								echo '<option value="'.$type->nama.'">' . $type->nama . '</option>';
						?>
					</select>
				</div>
				<div id="spesifikasi">
					
				</div>
				<div class="form-group">
					<select class="form-control" name="status">
						<option>Status</option>
						<option value="Baru">Baru</option>
						<option value="Bekas">Bekas</option>
					</select>
				</div>
				<input class="btn btn-success btn-lg" type="submit" name="submit" value="Submit">
			</div>
		</div>
	<?= form_close() ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tipe').on('change', function() {
			var tipe = $('#tipe').val();
			if (tipe == 'Laptop' || tipe == 'Smartphone' || tipe == 'Tablet')
				$('#spesifikasi').load('<?= base_url('assets/component/computer.html') ?>');
			else if (tipe == 'Flashdisk' || tipe == 'Harddisk')
				$('#spesifikasi').load('<?= base_url('assets/component/storage.html') ?>');
			else if (tipe == 'Keyboard' || tipe == 'Mouse')
				$('#spesifikasi').load('<?= base_url('assets/component/iodevice.html') ?>');
			else if (tipe == 'Charger Laptop' || tipe == 'Charger HP')
				$('#spesifikasi').load('<?= base_url('assets/component/charger.html') ?>')
		});

		$('#upload_photo').on('change', function() {
			var formData = new FormData($('#formID')[0]);
			var progress_bar_id = '#progress-wrp';
			$(progress_bar_id).css('display', 'block');
			$.ajax({
				url: '<?= base_url('user/upload_photo/_temp') ?>',
				type: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				xhr: function() {
					var xhr = $.ajaxSettings.xhr();
					if (xhr.upload)
					{
						xhr.upload.addEventListener('progress', function(event) {
							var percent = 0;
							var position = event.loaded || event.position;
							var total = event.total;
							if (event.lengthComputable)
								percent = Math.ceil(position / total * 100);
							$(progress_bar_id +" .progress-bar").css("width", + percent +"%");
			                $(progress_bar_id + " .percent").text(percent +"%");
						}, true)
					}

					return xhr;
				},
				mimeType: 'multipart/form-data',
			    success: function(response) {
			    	$('#image_display').html('<img style="box-shadow: 5px 5px rgba(0, 0, 0, 0.2); border: 3px solid rgba(0, 0, 0, 0.2); box-sizing: border-box;" src="<?= base_url('img/temp/' . $id . '_temp.png?' . time()) ?>" width="300" height="300">');
			    }
			}).done(function(response){
			    $('#placeholder').css('display', 'none');
			});

			return false;
		});
	});
</script>