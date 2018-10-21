	<div class="footer navbar navbar-inverse navbar-lg">
		<div class="row">
			<div class="col-md-7">
				<div class="row" style="margin-top: 8px;">
					<div class="col-md-3">
						<b>Teknopedia</b>
						<p><a href="#">Tentang Kami</a></p>
						<p><a href="#">Kegiatan Kami</a></p>
					</div>
					<div class="col-md-3">
						<b>Beli</b>
						<p><a href="#">Belanja di Teknopedia</a></p>
						<p><a href="#">Cara Berbelanja</a></p>
						<p><a href="#">Pembayaran</a></p>
						<p><a href="#">Pengembalian Dana</a></p>
						<p><a href="#">Hot List</a></p>
					</div>
					<div class="col-md-3">
						<b>Jual</b>
						<p><a href="#">Jualan di Teknopedia</a></p>
						<p><a href="#">Cara Berjualan</a></p>
						<p><a href="#">Penarikan Dana</a></p>
					</div>
					<div class="col-md-3">
						<b>Bantuan</b>
						<p><a href="#">Syarat dan Ketentuan</a></p>
						<p><a href="#">Kebijakan Privasi</a></p>
						<p><a href="#">Hubungi Kami</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<h5>Contacts</h5>
				<blockquote>
					<i class="fa fa-phone"></i> +6281996073896 <br>
					<i class="fa fa-home"></i> Jl. Lintas Palembang Prabumulih KM 33 Komplek Griya Sejahtera
					<br><br>
					<img class="social-media-icons" src="<?= base_url('assets/icons/35px/facebook.png') ?>">
					<img class="social-media-icons" src="<?= base_url('assets/icons/35px/twitter.png') ?>">
					<img class="social-media-icons" src="<?= base_url('assets/icons/35px/instagram.png') ?>">
				</blockquote>
			</div>
		</div>
		<hr style="margin-left: -2%; margin-right: -2%;">
		<center>
			<div style="margin-top: -1%;">
				<small>&copy; Teknopedia 2016. All rights reserved</small>				
			</div>
		</center>
	</div>
	
	<!-- JS Includes -->
	<script type="text/javascript" src="<?= base_url('assets/flatui/dist/js/flat-ui.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/angularjs/angular.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/script.js') ?>"></script>

	<script type="text/javascript">
		var docHeight = $(window).height();
		var footerHeight = $('.footer').height();
		var footerTop = $('.footer').position().top + footerHeight;

		if (footerTop < docHeight) {
			$('.footer').css('margin-top', (docHeight - footerTop - 15) + 'px');
		}


	</script>

	<?php if ($title == 'Login | Teknopedia - Tempatnya jual-beli barang-barang teknologi secara online'): ?>
		<script type="text/javascript">
			$('#login-container').css('height', ($(window).height() - 190) + 'px');
		</script>
	<?php endif; ?>
</body>
</html>