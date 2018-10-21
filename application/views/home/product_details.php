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
		<?= $this->session->flashdata('msg') ?>
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
						<td><?= 'Rp. ' . number_format($data['harga'], 0 , '' , '.') . ' ,-' ?></td>
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
			<center id="form-pembelian">
				<button id="tombol-beli" onclick="beli()" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> BELI</button>
				<?= form_open('user/beli/'.$data['id'], ['style' => 'display: none;', 'id' => 'formBeli']) ?>
				<input type="hidden" name="id_pembeli" value="<?= $this->session->userdata('id') ?>">
				<input type="hidden" name="id_penjual" value="<?= $data['id_penjual'] ?>">
				<input type="hidden" name="id_barang" value="<?= $data['id'] ?>">
				<input type="hidden" name="harga" value="<?= $data['harga'] ?>">
				<input max="<?= $data['stok'] ?>" min="1" placeholder="Quantity" type="number" id="quantity" name="quantity" class="form-control">
				<span id="total">Total: Rp. 0 ,-</span>
				<br>
				<input type="submit" class="btn btn-success btn-lg" name="beli" value="BELI" <?= ($data['stok'] <= 0) ? 'disabled' : 'enabled' ?>>
				<?= form_close() ?>
			</center>
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
	function beli() {
		$('#formBeli').css('display', 'block');
		$('#tombol-beli').css('display', 'none');
	}

	function toRp(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.\t'+e(d)+',00'}

	$(document).ready(function() {
		var harga = parseInt('<?= $data['harga'] ?>');
		$('#quantity').on('change', function() {

			$('#total').text('Total: ' + toRp(harga * $('#quantity').val()));
		});
	});
</script>