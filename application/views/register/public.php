<div class="container" style="margin-bottom: 24px;">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h5>TEKNOPEDIA</h5>
				<h6>Daftar Secara Gratis di Teknopedia</h6>
			</center>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" style="box-sizing: border-box;">
			<center>
				<div style="width: 300px; height: 300px;">
					<img src="<?= base_url('img/slider/logox.png') ?>" width="300" height="300">
				</div>
			</center>
		</div>
		<div class="col-md-6" style="box-sizing: border-box; border-left: 1px dashed rgb(26, 188, 156);">
			<?php  
				$msg = $this->session->flashdata('msg');
				if (isset($msg))
					echo $msg;
			?>
			<?= form_open('register') ?>
				<div id="nama" class="form-group">
					<?= form_error('nama', '<div class="text-danger">','</div>') ?>
					<input class="form-control" type="text" name="nama" placeholder="Fullname">
				</div>
				<div id="no_hp" class="form-group">
					<?= form_error('no_hp', '<div class="text-danger">','</div>') ?>
					<input class="form-control" type="text" name="no_hp" placeholder="Mobile Number">
				</div>
				<div id="email" class="form-group">
					<?= form_error('email', '<div class="text-danger">','</div>') ?>
					<input class="form-control" type="email" name="email" placeholder="Email Address">
				</div>
				<div id="password" class="form-group">
					<?= form_error('password', '<div class="text-danger">','</div>') ?>
					<input class="form-control" type="password" name="password" placeholder="Password">
				</div>
				<div id="gender" class="form-group">
					<?= form_error('gender', '<div class="text-danger">','</div>') ?>
					<input type="radio" name="gender" value="l"> Male 
					<input type="radio" name="gender" value="p"> Female
				</div>
				<div id="tanggal_lahir" class="form-group">
					<?= form_error('tanggal', '<div class="text-danger">','</div>') ?>
					<?= form_error('bulan', '<div class="text-danger">','</div>') ?>
					<?= form_error('tahun', '<div class="text-danger">','</div>') ?>
					<label for="tanggal_lahir">Date of Birth</label>					
					<div class="form-inline">
						<select class="form-control" name="tanggal">
							<?php  
								for ($i = 1; $i <= 31; $i++)
									echo '<option value="'.$i.'">'.$i.'</option>';
							?>
						</select>
						<select class="form-control" name="bulan">
							<?php  
								$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
								foreach ($months as $month)
									echo '<option value="'.$month.'">'.$month.'</option>';
							?>
						</select>
						<select class="form-control" name="tahun">
							<?php  
								for ($i = 2016; $i >= 1945; $i--)
									echo '<option value="'.$i.'">'.$i.'</option>';
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<small>
						By clicking Register Account, I confirm I have agreed to <a href="#">Terms &amp; Condition</a>, and <a href="#">Security Privacy</a> of Teknopedia. 
					</small>
				</div>
				<input class="btn btn-success" type="submit" name="register" value="Register an account">
			<?= form_close() ?>
		</div>
	</div>
</div>