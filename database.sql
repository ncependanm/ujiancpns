CREATE TABLE IF NOT EXISTS `cpns_kategori_soal` (
  `kategori_soal_id` int(11) NOT NULL,
  `kategori_soal_jenis` varchar(3) NOT NULL,
  `kategori_soal_key` varchar(10) NOT NULL,
  `kategori_soal_nama` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_materi` (
  `materi_id` int(11) NOT NULL,
  `materi_kategori_soal_id` int(11) NOT NULL,
  `materi_isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_paket_detail` (
  `paket_detail_id` int(11) NOT NULL,
  `paket_detail_paket_parent_id` int(11) NOT NULL,
  `paket_detail_soal_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1784 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_paket_parent` (
  `paket_parent_id` int(11) NOT NULL,
  `paket_parent_nama` varchar(100) NOT NULL,
  `paket_parent_ket` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_soal` (
  `soal_id` int(11) NOT NULL,
  `soal_type` varchar(5) NOT NULL,
  `soal_kategori_id` int(11) NOT NULL,
  `soal_sesi` varchar(50) NOT NULL,
  `soal_pertanyaan` text NOT NULL,
  `soal_jawaban_a` text NOT NULL,
  `soal_jawaban_b` text NOT NULL,
  `soal_jawaban_c` text NOT NULL,
  `soal_jawaban_d` text NOT NULL,
  `soal_jawaban_e` text NOT NULL,
  `soal_kunci_jawaban` varchar(1) NOT NULL,
  `soal_penyelesaian` text NOT NULL,
  `soal_nilai_a` int(11) NOT NULL,
  `soal_nilai_b` int(11) NOT NULL,
  `soal_nilai_c` int(11) NOT NULL,
  `soal_nilai_d` int(11) NOT NULL,
  `soal_nilai_e` int(11) NOT NULL,
  `soal_nilai_benar` int(11) NOT NULL,
  `soal_nilai_salah` int(11) NOT NULL,
  `soal_nilai_kosong` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1559 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_tes_detail` (
  `tes_detail_id` int(11) NOT NULL,
  `tes_detail_tes_id` int(11) NOT NULL,
  `tes_detail_soal_id` int(11) NOT NULL,
  `tes_detail_jawaban` varchar(1) NOT NULL,
  `tes_detail_nilai` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=313901 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_tes_parent` (
  `tes_parent_id` int(11) NOT NULL,
  `tes_parent_user_id` int(11) NOT NULL,
  `tes_parent_ujian_id` int(11) NOT NULL,
  `tes_parent_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tes_parent_waktu_selesai` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tes_parent_ind` varchar(1) NOT NULL DEFAULT 'N',
  `tes_parent_ket` varchar(1) NOT NULL DEFAULT 'B' COMMENT 'U = "Ujian", B = "Biasa"'
) ENGINE=InnoDB AUTO_INCREMENT=3140 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_ujian` (
  `ujian_id` int(11) NOT NULL,
  `ujian_nama` varchar(50) NOT NULL,
  `ujian_tgl_mulai` varchar(20) NOT NULL,
  `ujian_tgl_akhir` varchar(20) NOT NULL,
  `ujian_paket_parent_id` int(11) NOT NULL,
  `ujian_durasi` varchar(10) NOT NULL,
  `ujian_ind` varchar(2) NOT NULL COMMENT 'UF = Ujian Free, UP = Ujian Premium',
  `ujian_keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cpns_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_no_hp` varchar(20) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_akses` varchar(1) NOT NULL COMMENT 'A = Admin, G = Guru, S = Siswa',
  `user_status` varchar(1) NOT NULL DEFAULT '0',
  `user_ind` varchar(1) NOT NULL COMMENT 'F = Free, S = Super, D = Deluxe, P = Premium',
  `user_foto` varchar(50) NOT NULL DEFAULT 'no_image.jpg',
  `user_tgl_lahir` varchar(15) NOT NULL,
  `user_alamat` varchar(250) NOT NULL,
  `user_asal_sekolah` varchar(150) NOT NULL,
  `user_kelas` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4425 DEFAULT CHARSET=latin1;
--
-- Indexes for table `cpns_kategori_soal`
--
ALTER TABLE `cpns_kategori_soal`
  ADD PRIMARY KEY (`kategori_soal_id`);

--
-- Indexes for table `cpns_materi`
--
ALTER TABLE `cpns_materi`
  ADD PRIMARY KEY (`materi_id`);

--
-- Indexes for table `cpns_paket_detail`
--
ALTER TABLE `cpns_paket_detail`
  ADD PRIMARY KEY (`paket_detail_id`);

--
-- Indexes for table `cpns_paket_parent`
--
ALTER TABLE `cpns_paket_parent`
  ADD PRIMARY KEY (`paket_parent_id`);

--
-- Indexes for table `cpns_soal`
--
ALTER TABLE `cpns_soal`
  ADD PRIMARY KEY (`soal_id`);

--
-- Indexes for table `cpns_tes_detail`
--
ALTER TABLE `cpns_tes_detail`
  ADD PRIMARY KEY (`tes_detail_id`);

--
-- Indexes for table `cpns_tes_parent`
--
ALTER TABLE `cpns_tes_parent`
  ADD PRIMARY KEY (`tes_parent_id`);

--
-- Indexes for table `cpns_ujian`
--
ALTER TABLE `cpns_ujian`
  ADD PRIMARY KEY (`ujian_id`);

--
-- Indexes for table `cpns_user`
--
ALTER TABLE `cpns_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpns_kategori_soal`
--
ALTER TABLE `cpns_kategori_soal`
  MODIFY `kategori_soal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_materi`
--
ALTER TABLE `cpns_materi`
  MODIFY `materi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cpns_paket_detail`
--
ALTER TABLE `cpns_paket_detail`
  MODIFY `paket_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_paket_parent`
--
ALTER TABLE `cpns_paket_parent`
  MODIFY `paket_parent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_soal`
--
ALTER TABLE `cpns_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_tes_detail`
--
ALTER TABLE `cpns_tes_detail`
  MODIFY `tes_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_tes_parent`
--
ALTER TABLE `cpns_tes_parent`
  MODIFY `tes_parent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_ujian`
--
ALTER TABLE `cpns_ujian`
  MODIFY `ujian_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `cpns_user`
--
ALTER TABLE `cpns_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
