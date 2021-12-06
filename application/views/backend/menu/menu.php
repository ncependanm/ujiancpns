<?php if($this->session->userdata('user_akses')=='A') {?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php if($menu=="beranda"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/beranda" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Beranda</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="user"){echo "active open";}?>">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User</span>
					<span class="arrow"></span>
                </a>
				<ul class="sub-menu">
                    <li class="nav-item start <?php if($subMenu=="admin"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/user" class="nav-link ">
                            <span class="title">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if($subMenu=="siswa"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/siswa" class="nav-link ">
                            <span class="title">Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if($subMenu=="guru"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/guru" class="nav-link ">
                            <span class="title">Guru</span>
                        </a>
                    </li>
				</ul>
            </li>
            <li class="nav-item start <?php if($menu=="soal"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/soal" class="nav-link nav-toggle">
                    <i class="fa fa-question"></i>
                    <span class="title">Soal</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="paket"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/paket" class="nav-link nav-toggle">
                    <i class="fa fa-clone"></i>
                    <span class="title">Paket</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="ujian"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/ujian" class="nav-link nav-toggle">
                    <i class="fa fa-clone"></i>
                    <span class="title">Ujian</span>
					<span class="arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } else if($this->session->userdata('user_akses')=='G') {?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php if($menu=="beranda"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/beranda" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Beranda</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="soal"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/soal" class="nav-link nav-toggle">
                    <i class="fa fa-book"></i>
                    <span class="title">Soal</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="paket"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/paket" class="nav-link nav-toggle">
                    <i class="fa fa-clone"></i>
                    <span class="title">Paket</span>
					<span class="arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } else if($this->session->userdata('user_akses')=='S') {?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php if($menu=="beranda"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/beranda" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Beranda</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="ujian"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/ujianKu" class="nav-link nav-toggle">
                    <i class="fa fa-clone"></i>
                    <span class="title">Ujian Ku</span>
					<span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($menu=="statistik"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/statistik" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Statistik</span>
					<span class="arrow"></span>
                </a>
				<ul class="sub-menu">
                    <li class="nav-item start <?php if($subMenu=="twk"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/statistik/twk" class="nav-link ">
                            <span class="title">Statistik TWK</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if($subMenu=="tiu"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/statistik/tiu" class="nav-link ">
                            <span class="title">Statistik TIU</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if($subMenu=="tkp"){echo "active open";}?>">
                        <a href="<?=base_url();?>backend/statistik/tkp" class="nav-link ">
                            <span class="title">Statistik TKP</span>
                        </a>
                    </li>
				</ul>
            </li>
            <li class="nav-item start <?php if($menu=="profile"){echo "active open";}?>">
                <a href="<?=base_url();?>backend/profile" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Profile</span>
					<span class="arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>

