<div class="container" style="margin-bottom: 24px;">
	<div class="row">
		<?= ($id_role == 1) ? form_open_multipart('user/setting', ['id' => 'formID']) : form_open_multipart('admin/setting', ['id' => 'formID']) ?>
			<div class="col-md-6">
				<h5><i class="glyphicon glyphicon-cog"></i> Pengaturan profil</h5>
				<div class="container">
					<?php 
						$newUser = $this->session->userdata($nama . '_setting');
						if (isset($newUser)) {
					?>
						<div class="alert alert-success">
							Lengkapi terlebih dahulu data identitas anda
						</div>
					<?php
						} 
						$this->session->unset_userdata($nama . '_setting');
					?>
					<?php  
						$profile_photos = scandir(realpath(APPPATH . '../img/profile'));
						if (in_array($id . '.png', $profile_photos)):
					?>
						<div id="photo_display">
							<img style="box-shadow: 5px 5px rgba(0, 0, 0, 0.2); border: 3px solid rgba(0, 0, 0, 0.2); box-sizing: border-box;" src="<?= base_url('img/profile/' . $id . '.png') ?>" width="200" height="200">
						</div>
					<?php else: ?>
						<div id="photo_display">
							
						</div>
						<div id="placeholder" style="width: 200px; height: 200px; border: 1px solid grey; padding: 12px; color: grey; font-style: italic;">
							You have not uploaded your profile picture
						</div>
					<?php endif; ?>
					<br>
					<div id="progress-wrp" class="progress" style="display: none; width: 40%; height: 20px; position: relative;">
						<div class="progress-bar"></div>
						<div class="status" style="top: -5px; left: 48%; position: absolute; display: inline-block; color: black;"><small class="percent">0%</small></div>
					</div>
					<input type="file" name="upload" id="upload_photo">
					<button id="upload" class="btn btn-success">Upload</button>
				</div>
			</div>
			<div class="col-md-6" style="border-left: 1px dashed rgb(26, 188, 156);">
				<?php
					$msg = $this->session->flashdata('msg'); 
					if(isset($msg)) echo $msg;
				?>
				<div class="form-group">
					<label for="nama">Fullname</label>
					<input class="form-control" type="text" name="nama" value="<?= $nama ?>">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" type="text" name="email" value="<?= $email ?>">
				</div>
				<div class="form-group">
					<label for="alamat">Address</label>
					<input class="form-control" type="text" name="alamat" value="<?= $alamat ?>">
				</div>
				<div class="form-group">
					<?php  
						$date = explode('-', $tanggal_lahir);
						$tahun 	= $date[0];
						$bulan 	= $date[1];
						$hari	= $date[2];
					?>
					<label for="tanggal_lahir">Date of Birth</label>					
					<div class="form-inline">
						<select class="form-control" name="tanggal">
							<?php
								echo '<option value="'.$hari.'">'.$hari.'</option>';
								for ($i = 1; $i <= 31; $i++)
									if ($i != $hari)
										echo '<option value="'.$i.'">'.$i.'</option>';
							?>
						</select>
						<select class="form-control" name="bulan">
							<?php  
								$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
								echo '<option value="'.$months[$bulan - 1].'">'.$months[$bulan - 1].'</option>';
								foreach ($months as $month)
									if ($month != $months[$bulan - 1])
										echo '<option value="'.$month.'">'.$month.'</option>';
							?>
						</select>
						<select class="form-control" name="tahun">
							<?php  
								echo '<option value="'.$tahun.'">'.$tahun.'</option>';
								for ($i = 2016; $i >= 1945; $i--)
									if ($i != $tahun)
										echo '<option value="'.$i.'">'.$i.'</option>';
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="no_hp">Mobile Number</label>
					<input class="form-control" type="text" name="no_hp" value="<?= $no_hp ?>">
				</div>
				<input class="btn btn-success" type="submit" name="submit" value="Submit">
				<br>
				<small><i>Last login on <?= $last_login ?></i></small>
			</div>
		<?= form_close() ?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#upload').on('click', function() {
			var formData = new FormData($('#formID')[0]);
			var progress_bar_id = '#progress-wrp';
			$(progress_bar_id).css('display', 'block');
			$.ajax({
			    url : '<?= ($id_role == 1) ? base_url('user/upload_photo') : base_url('admin/upload_photo') ?>',
			    type: "POST",
			    data : formData,
			    contentType: false,
			    cache: false,
			    processData:false,
			    xhr: function(){
			        //upload Progress
			        var xhr = $.ajaxSettings.xhr();
			        if (xhr.upload) {
			            xhr.upload.addEventListener('progress', function(event) {
			                var percent = 0;
			                var position = event.loaded || event.position;
			                var total = event.total;
			                if (event.lengthComputable) {
			                    percent = Math.ceil(position / total * 100);
			                }
			                //update progressbar
			                $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
			                $(progress_bar_id + " .percent").text(percent +"%");
			            }, true);
			        }
			        
			        return xhr;
			    },
			    mimeType:"multipart/form-data",
			    success: function(response) {
			    	$('#photo_display').html('<img style="box-shadow: 5px 5px rgba(0, 0, 0, 0.2); border: 3px solid rgba(0, 0, 0, 0.2); box-sizing: border-box;" src="<?= base_url('img/profile/' . $id . '.png?' . time()) ?>" width="200" height="200">');
			    }
			}).done(function(response){ //
			    $('#upload_photo').val(''); //reset form
			    $('#placeholder').css('display', 'none');
			});

			return false;
		});
	});
</script>