<style type="text/css">

  table {
    background: #fff;
 
  }
  tr, td {
    border: table-cell;
    border: 1px  solid #444;
  }
  tr,td {
    vertical-align: top!important;
  }
  #right {
    border-right: none !important;
  }
  #left {
    border-left: none !important;
  }
  .isi {
    height: 300px!important;
  }
  .disp {
    text-align: center;
    padding: 1.5rem 0;
    margin-bottom: .5rem;
  }
  .logodisp {
    float: left;
    position: relative;
    width: 110px;
    height: 110px;
    margin: 0 0 0 1rem;
  }
  #lead {
    width: auto;
    position: relative;
    margin: 25px 0 0 75%;
  }
  .lead {
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: -10px;
  }
  .tgh {
    text-align: center;
  }
  #nama {
    font-size: 2.1rem;
    margin-bottom: -1rem;
  }
  #alamat {
    font-size: 16px;
  }
  .up {
    text-transform: uppercase;
    margin: 0;
    line-height: 2.2rem;
    font-size: 1.5rem;
  }
  .status {
    margin: 0;
    font-size: 1.3rem;
    margin-bottom: .5rem;
  }
  #lbr {
    font-size: 20px;
    font-weight: bold;
  }
  .separator {
    border-bottom: 2px solid #616161;
    margin: -1.3rem 0 1.5rem;
  }
  @media print{
    body {
      font-size: 12px;
      color: #212121;
    }
    nav {
      display: none;
    }
    table {
      width: 100%;
      font-size: 12px;
      color: #212121;
    }
    tr, td {
      border: table-cell;
      border: 1px  solid #444;
      padding: 8px!important;

    }
    tr,td {
      vertical-align: top!important;
    }
    #lbr {
      font-size: 20px;
    }
    .isi {
      height: 200px!important;
    }
    .tgh {
      text-align: center;
    }
    .disp {
      text-align: center;
      margin: -.5rem 0;
    }
    .logodisp {
      float: left;
      position: relative;
      width: 80px;
      height: 80px;
      margin: .5rem 0 0 .5rem;
    }
    #lead {
      width: auto;
      position: relative;
      margin: 15px 0 0 75%;
    }
    .lead {
      font-weight: bold;
      text-decoration: underline;
      margin-bottom: -10px;
    }
    #nama {
      font-size: 20px!important;
      font-weight: bold;
      text-transform: uppercase;
      margin: -10px 0 -20px 0;
    }
    .up {
      font-size: 17px!important;
      font-weight: normal;
    }
    .status {
      font-size: 17px!important;
      font-weight: normal;
      margin-bottom: -.1rem;
    }
    #alamat {
      margin-top: -15px;
      font-size: 13px;
    }
    #lbr {
      font-size: 17px;
      font-weight: bold;
    }
    .separator {
      border-bottom: 2px solid #616161;
      margin: -1rem 0 1rem;
    }

  }

  .container{
    padding: 0 1.5rem;
    margin: 0 auto;
    max-width: 1280px;
    width: 90%;
  }

</style>
 
<table>
	<tbody> 
		<tr>
			<td width="190" rowspan="3" valign="top"><p style="padding: 32px"><img src="<?= base_url('assets/img/'.$logo['logo']) ?>" class="img-responsive" id="image_upload_preview" style="width: 100px"></p></td>
			<td width="367" colspan="2" rowspan="3" valign="top"><p align="center"></p>

				<p align="center">RISALAH RAPAT</p> 	 
			</td>
			<td width="122" valign="top" colspan="4"><p>No. Dokumen</p></td>
			<td width="147" valign="top"><p><?= $data['no_dokumen'] ?></p></td>
		</tr>
		<tr>
			<td width="122" valign="top" colspan="4"><p>No. Revisi</p></td>
			<td width="147" valign="top"><p>: <?= $data['no_revisi'] ?></p></td>
		</tr>
		<tr>
			<td width="122" valign="top" colspan="4"><p>Halaman</p></td>
			<td width="147" valign="top"><p>: </p></td>
		</tr>
		<tr>
			<td width="396" colspan="3" valign="top"><p>&nbsp;</p>
				<p>Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?=  $data['no_agenda'] ?><br />
					Hari / Tgl : <?= tgl_indonesia($data['tanggal']) ?><br />
					Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :<br />
					Tempat&nbsp;&nbsp;  : <?= $data['place'] ?></p></td>
					<td width="430" colspan="5" valign="top"><p>Jenis    Rapat :<br />
						<?= $data['jenis_rapat'] ?>
					</td>
				</tr>
				<tr>
					<td colspan="5" valign="top"><p align="center"><strong>AGENDA</strong></p></td>
					<td width="430" colspan="3" valign="top"><p align="center"><strong>DIHADIRI OLEH</strong></p></td>
				</tr>
				<tr>
					<td colspan="5" valign="top"><p align="center"><?= $data['agenda'] ?></p></td>
					<td width="430" colspan="3" valign="top"><p align="center">Terlampir</p>
						<p align="center"><a href="<?= base_url('assets/absensi/'.$data['absensi']) ?>">File</a></p></td>
					</tr>
					<tr>
						<td  colspan="8" valign="top"><p align="center"><strong>PIMPINAN RAPAT</strong></p></td>
					</tr>
					<tr>
						<td colspan="8" valign="top"><p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p align="center">
							PM</p> <br /><center>
							<?php if($param == 'no_image'): ?>
								<?php else: ?>
								<img src="<?= base_url('assets/absensi/'.($data['tdd_pimpinan'])) ?>" class="img-responsive" style = "width: 60px;height: 60px">
								<?php endif; ?>	

								<br />
								(&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;)<br /><b><?= $data['pimpinan_rapat'] ?></b></center></td>
							</tr>
						</tbody>
				 
						<tr>
							<td colspan="8" valign="top"><p align="center">DISTRIBUSI</p></td>
						</tr>
						<tr>
							<td valign="top" colspan="2"><p><strong>No</strong></p></td>
							<td valign="top" colspan="2"><p><strong>Eksternal</strong></p></td>
							<td valign="top" colspan="2"><p><strong>No</strong></p></td>
							<td valign="top" colspan="2"><p><strong>Internal</strong></p></td>
						</tr>
						<?php $no=1; foreach($this->db->get('divisi')->result_array() as $sql): ?>
						<tr>
							<td valign="top" colspan="2"><p><?= $no ?></p></td>
							<td valign="top" colspan="2"><p>&nbsp;</p></td>
							<td valign="top" colspan="2"><p><?= $no ?></p></td>
							<td valign="top" colspan="2"><p><?= $sql['nama_divsi'] ?></p></td>
						</tr>
						<?php $no++; endforeach; ?>

						<tr>
							<td colspan="2" valign="top"><p><em>Catatan:</em><br>
							Risalah Rapat ini harap dibawah pada    saat rapat berikutnya</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p></td>
							<td colspan="8" valign="top"><p><em>Notulis:</em><br>
								<?= $data['notulis'] ?></p></td>
							</tr>
						 
							<tbody>

								<tr>
									<td colspan="8">

										<p><strong>RISALAH RAPAT</strong></p>

									&nbsp;</td>
								</tr>


								<td colspan="3">
									<p>No. Dokumen</p>
								</td>
								<td colspan="5">
									<p><?= $data['no_dokumen'] ?></p>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<p>No. Revisi</p>
								</td>
								<td colspan="5">
									<p>: 2</p>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<p>Halaman</p>
								</td>
								<td colspan="5">
									<p>: 1 dari 10</p>
								</td>
							</tr>
							<tr>
								<td>
									<p><strong>NO</strong></p>
								</td>
								<td>
									<p><strong>PERMASALAHAN</strong></p>
								</td>
								<td >
									<p><strong>KEPUTUSAN</strong></p>
								</td>
								<td >
									<p><strong>PENANGGUNG JAWAB (PIC)</strong></p>
								</td>
								<td >
									<p><strong>TANGGAL TEMUAN</strong></p>
								</td>
								<td>
									<p><strong>DUE DATE</strong></p>
								</td>
								<td >
									<p><strong>REVISI DATE</strong></p>
								</td>
								<td>
									<p><strong>KEJELASAN / STATUS</strong></p>
								</td>
							</tr>
							<?php $no=1; foreach($this->db->get_where('notulen_detail',array('id_notulen'=>$data['id_notulen']))->result_array() as $sql): ?>
							<tr>
								<td>
									<p><?= $no ?></p>
								</td>
								<td>
									<p><?= $sql['issue'] ?></p>
								</td>
								<td>
									<p><?= $data['agenda'] ?></p>
								</td>
								<td>
									<p><?= $data['pimpinan_rapat'] ?></p>
								</td>
								<td>
									<p><?= $sql['date_created'] ?></p>
								</td>
								<td>
									<p><?= $sql['due_dete'] ?></p>
								</td>
								<td>
									<p><?= $sql['date_created'] ?></p>
								</td>
								<td >
									<?= ($sql['status'] == 'N') ? 'Close' :'Open'; ?>
								</td>
							</tr>
							<?php $no++; endforeach ?>

						</tbody>
					</table>  
