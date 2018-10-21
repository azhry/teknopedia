<div class="container" id="login-container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h5>Login di Teknopedia</h5>
			</center>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php  
						$msg = $this->session->flashdata('msg');
						if (isset($msg)) echo $msg;
					?>
					<?= form_open('login') ?>
						<div class="form-group">
							<input class="form-control" type="email" name="email" placeholder="Email">
						</div>
						<div class="form-group">
							<input class="form-control" type="password" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<a href="#">Forgot password?</a>
						</div>
						<input class="btn btn-success" type="submit" name="login" value="Login">
					<?= form_close() ?>	
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>
</div>