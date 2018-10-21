<nav class="navbar navbar-inverse navbar-lg" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="<?= base_url() ?>">Teknopedia</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <?php 
        $id_role = $this->session->userdata('id_role');
        if (isset($id_role)): 
      ?>
        <li><a href="<?= ($id_role == 1) ? base_url('user') : base_url('admin') ?>">Dashboard</a></li>
        <li><a href="<?= ($id_role == 1) ? base_url('user/status') : '' ?>"><?= ($id_role == 1) ? 'Transaksi' : '' ?></a></li>
      <?php endif; ?>
    </ul>
    <div class="navbar-right" style="color:white;">
      <?php  
        $user_id = $this->session->userdata('id');
        if (isset($user_id)):
      ?>
        <?php $profile_photos = scandir(realpath(APPPATH . '../img/profile')); ?>
        <div class="btn-group">
          <button class="navbar-btn btn btn-default dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false"><img width="25" height="25" src="<?= (in_array($user_id . '.png', $profile_photos)) ? base_url('img/profile/' . $user_id . '.png') : 'https://s-media-cache-ak0.pinimg.com/originals/28/c7/ad/28c7adffc9af705dcd8a8b77b1a9c0e8.jpg' ?>" id="profile_photo"> &nbsp; <?= $this->session->userdata('nama') ?> <span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?= ($id_role == 1) ? base_url('user/setting') : base_url('admin/setting') ?>"><i class="glyphicon glyphicon-cog"></i> Setting</a></li>
            <li class="divider"></li>
            <li><a href="<?= ($id_role == 1) ? base_url('user/logout') : base_url('admin/logout') ?>"><i class="glyphicon glyphicon-arrow-left"></i> Logout</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a href="<?= base_url('login') ?>" class="btn btn-default navbar-btn">Login</a>
        <a href="<?= base_url('register') ?>" class="btn btn-default navbar-btn">Create an account</a>
      <?php endif; ?>
    </div>
    <!-- <form class="navbar-form navbar-right" action="#" role="search"> -->
    <?= form_open('home/search', ['class' => 'navbar-form navbar-right', 'role' => 'search']) ?>
      <div class="form-group" data-toggle="tooltip" data-placement="left" title="Tips pencarian berdasarkan spesifikasi. Contoh RAM:4">
        <div class="input-group">
          <input name="search" class="form-control" id="navbarInput-01" type="search" placeholder="Search">
          <span class="input-group-btn">
            <button type="submit" class="btn"><span class="fui-search"></span></button>
          </span>
        </div>
      </div>
    <?= form_close() ?>
    <!-- </form> -->
  </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->