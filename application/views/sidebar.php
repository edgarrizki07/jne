<?php if($this->session->userdata('SESS_USER_ID') >'0'){ ?>
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
	<?php } ?>
	<?php if($this->session->userdata('ADMIN') <='2'){ ?>
	<?php } ?>
	<?php if($this->session->userdata('ADMIN')) { ?>
	<?php } ?>
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
			<li>
				<a href="<?php echo site_url('home');?>">
					<i class="fa fa-home"></i> <span>Home</span>
				</a>
			</li>
			<?php if($this->session->userdata('ADMIN') <='3'){ ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-suitcase"></i> <span>Manajemen</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<li><a href="<?php echo base_url();?>setting"><i class="fa fa-circle-o"></i> Setting</a></li>
					<li><a href="<?php echo base_url();?>cabang"><i class="fa fa-circle-o"></i> Cabang</a></li>
				<?php } ?>
				<?php if($this->session->userdata('ADMIN') =='2'){ ?>
					<li><a href="<?php echo base_url();?>cabang"><i class="fa fa-circle-o"></i> Setting Cabang</a></li>
				<?php } ?>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<li><a href="<?php echo base_url();?>akun"><i class="fa fa-circle-o"></i> Akun</a></li>
					<li><a href="<?php echo base_url();?>akun/saldo_awal"><i class="fa fa-circle-o"></i> Saldo Awal Akun</a></li>
					<li><a href="<?php echo base_url();?>kategori"><i class="fa fa-circle-o"></i> Kategori Akun</a></li>
					<li><a href="<?php echo base_url();?>voucher"><i class="fa fa-circle-o"></i> Voucher</a></li>
				<?php } ?>
				</ul>
			</li>
			<?php } ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Personal</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
			<?php if($this->session->userdata('ADMIN') <='2'){ ?>
					<li><a href="<?php echo base_url();?>user"><i class="fa fa-circle-o"></i> User</a></li>
			<?php } ?>
					<li><a href="<?php echo base_url();?>supplier"><i class="fa fa-circle-o"></i> Supplier</a></li>
					<li><a href="<?php echo base_url();?>transportir"><i class="fa fa-circle-o"></i> Transportir</a></li>
					<li><a href="<?php echo base_url();?>customer"><i class="fa fa-circle-o"></i> Customer</a></li>
					<li><a href="<?php echo base_url();?>customer/baru"><i class="fa fa-circle-o"></i> Customer Baru</a></li>
					<li><a href="<?php echo base_url();?>alamat_kirim"><i class="fa fa-circle-o"></i> Alamat Kirim</a></li>
				</ul>
			</li>
			<?php if($this->session->userdata('ADMIN') <='4'){ ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-edit"></i> <span>Pembelian</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>beli/add"><i class="fa fa-plus"></i> Buat PO</a></li>
					<li><a href="<?php echo base_url();?>beli/wait"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliWaiting();?></small> Draft</a></li>
					<li><a href="<?php echo base_url();?>beli/prosses"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliProsses();?></small> Proses ACC</a></li>
					<li><a href="<?php echo base_url();?>beli"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliSuccess();?></small> Sudah ACC</a></li>
				<?php if($this->session->userdata('ADMIN') <='3'){ ?>
					<li><a href="<?php echo base_url();?>beli/pay"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliPay();?></small> Proses Bayar</a></li>
					<li><a href="<?php echo base_url();?>beli/paid"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliPaid();?></small> Sudah Bayar</a></li>
				<?php } ?>
					<li><a href="<?php echo base_url();?>beli/cancel"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlBeliCancel();?></small> Cancel</a></li>
					<li><a href="<?php echo base_url();?>beli/rekap"><i class="fa fa-circle-o"></i> Rekap</a></li>
				</ul>
			</li>
			<?php } ?>
			<?php if($this->session->userdata('ADMIN') <='5'){ ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-edit"></i> <span>Penjualan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>jual/add"><i class="fa fa-plus"></i> Tambah Penjualan</a></li>
					<li><a href="<?php echo base_url();?>jual"><i class="fa fa-circle-o"></i> Daftar Penjualan</a></li>
					<li><a href="<?php echo base_url();?>jual/do_list"><i class="fa fa-circle-o"></i> Daftar DO</a></li>
					<li><a href="<?php echo base_url();?>jual/wait"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualWaiting();?></small> Draft</a></li>
					<li><a href="<?php echo base_url();?>jual/prosses"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualProsses();?></small> Proses ACC</a></li>
					<li><a href="<?php echo base_url();?>jual/success"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualSuccess();?></small> Sudah ACC</a></li>
				<?php if($this->session->userdata('ADMIN') <='3'){ ?>
					<li><a href="<?php echo base_url();?>jual/pay"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualPay();?></small> Proses Bayar</a></li>
					<li><a href="<?php echo base_url();?>jual/paid"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualPaid();?></small> Sudah Bayar</a></li>
				<?php } ?>
					<li><a href="<?php echo base_url();?>jual/cancel"><i class="fa fa-circle-o"></i> <small class="badge pull-right bg-green"><?php echo $this->bbm_model->JmlJualCancel();?></small> Cancel</a></li>
					<li><a href="<?php echo base_url();?>jual/rekap"><i class="fa fa-circle-o"></i> Rekap</a></li>
				</ul>
			</li>
			<?php } ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-edit"></i> <span>Pemasaran</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				<?php if($this->session->userdata('ADMIN') =='7'){ ?>
					<li><a href="#">__________________________</a></li>
					<li><a href="<?php echo base_url();?>so/list_po"><i class="fa fa-plus"></i> Tambah SO</a></li>
					<li><a href="<?php echo base_url();?>so"><i class="fa fa-list"></i> Daftar SO</a></li>
					<li><a href="#">__________________________</a></li>
				<?php } ?>
				<?php if($this->session->userdata('ADMIN') <='2'){ ?>
					<li><a href="#">__________________________</a></li>
					<li><a href="<?php echo base_url();?>so/list_po"><i class="fa fa-plus"></i> Tambah SO</a></li>
					<li><a href="<?php echo base_url();?>so"><i class="fa fa-list"></i> Daftar SO</a></li>
					<li><a href="#">__________________________</a></li>
				<?php } ?>
					<li><a href="<?php echo base_url();?>tawaran/add_po"><i class="fa fa-plus"></i> Tambah PO Masuk</a></li>
					<li><a href="<?php echo base_url();?>tawaran/list_po"><i class="fa fa-list"></i> Daftar PO Masuk</a></li>
					<li><a href="<?php echo base_url();?>tawaran/add"><i class="fa fa-plus"></i> Buat Penawaran</a></li>
					<li><a href="<?php echo base_url();?>tawaran"><i class="fa fa-list"></i> List Penawaran</a></li>
					<li><a href="<?php echo base_url();?>tawaran/cancel"><i class="fa fa-circle-o"></i> Cancel</a></li>
					<li><a href="<?php echo base_url();?>tawaran/rekap"><i class="fa fa-circle-o"></i> Rekap</a></li>
				</ul>
			</li>
			<?php if($this->session->userdata('ADMIN') <='3'){ ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-file-text-o"></i> <span>Keuangan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#">
							<i class="fa fa-plus"></i> <span>Tambah Jurnal Umum</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php $vou = $this->db->get_where('voucher',array('proyek'=>'0')); $item = $vou->result(); $no=0; foreach($item as $rowj ): $no++;?>
							<li><a target="_blank" href="<?php echo site_url('jurnal/jurnal_umum/'.$rowj->id);?>"><i class="fa fa-edit"></i><?php echo $rowj->jenis;?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
					<li><a href="<?php echo base_url();?>beli/prepaid"><i class="fa fa-money"></i> Pelunasan Pembelian</a></li>
					<li><a href="<?php echo base_url();?>jual/prepaid"><i class="fa fa-money"></i> Pembayaran Penjualan</a></li>
					<li><a href="#">__________________________</a></li>
					<li><a href="<?php echo base_url();?>jurnal"><i class="fa fa-list"></i>Daftar Semua Jurnal</a></li>
					<li><a href="<?php echo base_url();?>jurnal_proyek"><i class="fa fa-circle-o"></i> Daftar Jurnal Transaksi</a></li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-credit-card"></i> <span>Filter by Voucher</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
									<i class="fa fa-edit"></i> <span>Jurnal Umum</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<?php $vou = $this->db->get_where('voucher',array('proyek'=>'0')); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
									<li><a href="<?php echo site_url('voucher/jurnal/'.$row->id);?>"><i class="fa fa-circle-o"></i><?php echo $row->kode;?> - <?php echo $row->jenis;?></a></li>
									<?php endforeach;?>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-edit"></i> <span>Transaksi BBM</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<?php $vou = $this->db->get_where('voucher',array('proyek !='=>'0')); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
									<li><a href="<?php echo site_url('voucher/jurnal/'.$row->id);?>"><i class="fa fa-circle-o"></i> <?php echo $row->kode;?> - <?php echo $row->jenis;?></a></li>
									<?php endforeach;?>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-tags"></i> <span>Filter by Kategori</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php $vou = $this->db->get('akun_kelompok'); $item = $vou->result(); $no=0; foreach($item as $ro ): $no++;?>
							<li class="treeview">
								<a href="#"><i class="fa fa-edit"></i> <span><?php echo $ro->nama;?></span><i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<?php $vou = $this->db->get_where('akun_kategori',array('id !='=>'0','kelompok_akun_id'=>$ro->id)); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
									<li class="treeview">
										<a href="#"><i class="fa fa-edit"></i> <span><?php echo $row->nama;?></span><i class="fa fa-angle-left pull-right"></i></a>
										<ul class="treeview-menu">
											<?php $vou = $this->db->get_where('akun_jenis',array('kategori_id'=>$row->id)); $item = $vou->result(); $no=0; foreach($item as $rows ): $no++;?>
											<li><a href="<?php echo site_url('kategori/akun/'.$rows->id);?>"><i class="fa fa-circle-o"></i> <?php echo $rows->nama;?></a></li>
											<?php endforeach;?>
										</ul>
									</li>
									<?php endforeach;?>
								</ul>
							</li>
							<?php endforeach;?>
						</ul>
					</li>
					<li><a href="#">__________________________</a></li>
					<li><a href="<?php echo base_url();?>jurnal/jurnal_penyesuaian"><i class="fa fa-edit"></i> Buat Jurnal Penyesuaian</a></li>
					<li><a href="<?php echo base_url();?>jurnal/jurnal_penutup"><i class="fa fa-edit"></i> Buat Jurnal Penutup</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-book"></i> <span>Laporan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>harga"><i class="fa fa-circle-o"></i> Harga Rata-Rata</a></li>
					<li><a href="<?php echo base_url();?>laporan_trial"><i class="fa fa-circle-o"></i> Trial Balance</a></li>
					<li><a href="<?php echo base_url();?>laporan_ledger"><i class="fa fa-circle-o"></i> General Ledger</a></li>
					<li><a href="<?php echo base_url();?>laporan_aging"><i class="fa fa-circle-o"></i> Aging</a></li>
					<li><a href="<?php echo base_url();?>laporan_keuangan"><i class="fa fa-circle-o"></i> Laba Rugi & Neraca</a></li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-book"></i> <span>BPH Migas</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>laporan_migas"><i class="fa fa-edit"></i> Input Data</a></li>
							<li><a href="<?php echo base_url();?>laporan_migas"><i class="fa fa-filter"></i> Filter Data</a></li>
							<li><a href="<?php echo base_url();?>laporan_migas/pdf"><i class="fa fa-print"></i> Cetak Laporan</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-book"></i> <span>BPH BPH</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>laporan_bph"><i class="fa fa-edit"></i> Input Data</a></li>
							<li><a href="<?php echo base_url();?>laporan_bph"><i class="fa fa-filter"></i> Filter Data</a></li>
							<li><a href="<?php echo base_url();?>laporan_bph/pdf"><i class="fa fa-print"></i> Cetak Laporan</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php } ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-envelope"></i> <span>Pesan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('pesan/tambah');?>"><i class="fa fa-pencil"></i> Tulis Pesan</a></li>
					<li><a href="<?php echo site_url('pesan/masuk');?>"><i class="fa fa-envelope-o"></i><small class="badge pull-right bg-green"><?php echo $this->m_pesan->JmlInbox($this->session->userdata('SESS_USER_ID'));?></small> Masuk</a></li>
					<li><a href="<?php echo site_url('pesan/keluar');?>"><i class="fa fa-envelope"></i><small class="badge pull-right bg-green"><?php echo $this->m_pesan->JmlOutbox($this->session->userdata('SESS_USER_ID'));?></small> Keluar</a></li>
				</ul>
			</li>
			<li>
				<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('login/logout');?>'">
					<i class="fa fa-windows"></i> <span>Log Out</span>
				</a>
			</li>
          </ul>
        </section>
      </aside>
<?php } ?>