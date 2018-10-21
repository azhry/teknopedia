<?php  
	$data = [];
	foreach ($item as $row)
	{
		$data['id']				= $row->id;
		$data['id_penjual']		= $row->id_penjual;
		$data['nama'] 			= $row->nama;
		$data['harga']			= $row->harga;
		$data['stok']			= $row->stok;
		$data['deskripsi']		= $row->deskripsi;
		$data['spesifikasi']	= json_decode($row->spesifikasi);
	}
?>
<div class="container" style="margin-bottom: 24px;">
	<div class="row">
		<div class="col-md-5">
			<center>
				<h6><?= $data['nama'] ?></h6>
				<img src="<?= base_url('img/barang/'.$data['id'].'.png') ?>" style="width: 70%; height: 250px; border: 1px solid grey; box-shadow: 2px 2px grey;">
			</center>
			<br>
			<div class="details" style="border: 1px solid grey; width: 100%; padding: 12px; font-size: 15px; color: black; box-shadow: 2px 2px grey;">
				<table class="table table-bordered">
					<tr>
						<td style="width: 30%;">Harga</td>
						<td><?= $data['harga'] ?></td>
					</tr>
					<tr>
						<td>Stok</td>
						<td><?= $data['stok'] ?></td>
					</tr>
					<?php if (isset($data['spesifikasi'])): ?>
						<?php foreach ($data['spesifikasi'] as $key => $value): ?>
							<tr>
								<td><?= ucfirst($key) ?></td>
								<td><?= $value ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
			<br>
			<center id="hapus-wrapper">
				<button id="hapus" class="btn btn-danger btn-lg">Hapus item ini</button>
				<br>
				<p>Jika tidak sesuai dengan <a href="#">syarat &amp; ketentuan</a> yang berlaku</p>
			</center>
			<div id="form-wrapper" style="display: none;">
				<?= form_open('admin/detail/'.$data['id'], ['id' => 'delete-form']) ?>
					<input type="hidden" name="id_barang" value="<?= $data['id'] ?>">
					<input type="hidden" name="id_penjual" value="<?= $data['id_penjual'] ?>">
					<input type="hidden" name="hapus" value="HAPUS">
					<textarea name="keterangan" class="form-control" rows="5" placeholder="Mengapa anda menghapus item ini?"></textarea>
					<br>
					<center>
						<input class="btn btn-danger" type="submit" value="HAPUS" onclick="popup(); return false;">
					</center>
				<?= form_close() ?>
			</div>
		</div>
		<div class="col-md-7">
			<div class="container" style="width: 100%; text-align: justify;">
				<h6>Description</h6>
				<p><?= $data['deskripsi'] ?></p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#hapus').on('click', function() {
			$('#hapus-wrapper').css('display', 'none');
			$('#form-wrapper').css('display', 'block');
		});
	});

	function popup() {
		swal({
			title: "Apakah anda yakin ingin menghapus item ini?",
			text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				$('#delete-form').submit();
				return true;
			} else {
				return false;
			}
		});

		return false;
	}
</script>