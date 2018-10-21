<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active item">
        	<img src="<?= base_url('img/slider/Untitled-1.png') ?>" class="img-responsives" style="width: 100%; height: 100%;">
        </div>
        <div class="item"><img src="<?= base_url('img/slider/keduanya.png') ?>" class="img-responsives" style="width: 100%; height: 100%;"></div>
        <div class="item">
        	<img src="<?= base_url('img/slider/ketiga.jpg') ?>" class="img-responsives" style="width: 100%; height: 100%;">
        </div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
</div> <!-- ./carousel -->

<br>

<div class="container">
	<center>
		<h4>Hot List</h4>
		<hr style="border-color: rgb(26, 188, 156);">
	</center>
	<?php $i = 1; foreach($hot_list as $row): ?>
		<?php  
			if ($i == 1 && $i != 3 && $i != 6)
				echo '<div class="row">';
		?>
		<div class="col-md-4">
			<div class="panel panel-default">
			  <a href="<?= base_url('home/details/' . $row->id) ?>" class="panel-body">
			  	<center>
			  		<img src="<?= base_url('img/barang/'. $row->id . '.png') ?>" width="320" height="220"
			  		style="border: 1px solid grey; box-sizing: border-box; box-shadow: 2px 2px grey;">
			  		<b><?= $row->nama ?></b>				  		
			  	</center>
			  </a>
			</div>
		</div>
		<?php  
			if ($i == count($hot_list))
				echo '</div>';
			else if ($i == 3 && $i == 6)
			{
				echo '</div>';
				echo '<div class="row">';
			}
		?>
	<?php $i++; endforeach; ?>
</div>
<div class="container" style="border-top: 1px dashed rgb(26, 188, 156); padding-top: 12px; margin-top: 12px;">
	<div class="row">
		<div class="col-md-12">
			<b>Teknopedia - Tempatnya jual-beli barang-barang teknologi secara online</b>
			<p>Teknopedia merupakan pasar / mal teknologi online terbesar di Indonesia yang memungkinkan individu maupun pemilik usaha di Indonesia untuk membuka dan mengelola toko teknologi online mereka secara mudah dan gratis, sekaligus memberikan pengalaman berbelanja online yang lebih aman dan nyaman. Jual beli online menjadi lebih menyenangkan. Punya online shop? Buka cabang nya di Teknopedia sekarang! Gratis!</p>
		</div>
	</div>
</div>