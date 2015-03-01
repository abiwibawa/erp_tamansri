<script>
/* function tree_klik(e){
	var id = e.attr("id-id");
	var vurl=$(".treelink").attr("direct-link");
	alert(id);
} */
</script>
<div class="row">  
	<div class="col-md-12">
		<div class="block">
			<div class="content">
				<div class="header">
					<h2>Master Perkiraan</h2>
					<div class="side pull-right">
						<a href="#modal_default_2" data-toggle="modal" class="addmaster btn btn-primary" data-direction="<?=base_url('master_perkiraan/addmodal')?>" data-wd="700px" data-original-title="Tambah Tanda Tangan" data-href="<?=base_url('master_perkiraan/tambah')?>">
							<i class="icon-plus-sign-alt"></i>&nbsp;&nbsp;tambah
						</a>
						<a href="#modal_default_2" data-toggle="modal" class="editmaster btn btn-primary" data-direction="<?=base_url('master_perkiraan/editmodal')?>" data-wd="700px" data-original-title="Tambah Tanda Tangan" data-href="<?=base_url('master_perkiraan/edit')?>">
							<i class="icon-plus-sign-alt"></i>&nbsp;&nbsp;Edit
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block block-fill-white">
				<div class="content treelink">
				<?php
					$this->tree->setFolderImage('assets/images/');
					$this->tree->addToArray(10,'Kode Perkiraan',0);
					foreach($menu_tree->result_array() as $rows) {
						//print_r($rows);
						$this->tree->addToArray($rows['id_perkiraan'],$rows['uraian'],$rows['parent'], base_url().'web/'.$rows['id_perkiraan']);
						//$this->tree->addToArray($rows['SatuanOrganisasiID'], $rows['Nama'],$rows['parent'], base_url().'web/'.$rows['SatuanOrganisasiID']);
					}
					$this->tree->writeCSS();
					$this->tree->writeJavascript();
					$this->tree->drawTree();
				?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block block-fill-white">
				<div class="content">
					<div class="form-row">
						<div class="col-md-4">Kode Perkiraan</div>
						<div class="col-md-4"><?=form_input('kode','','class="form-control" id="kode" readonly="readonly"')?></div>
					</div>
					<div class="form-row">
						<div class="col-md-4">Uraian</div>
						<div class="col-md-4"><?=form_input('uraian','','class="form-control" id="uraian" readonly="readonly"')?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>