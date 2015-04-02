<!DOCTYPE html>
<html lang="en">
<head>        
    <title>Taman Sriwedari</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="icon" type="image/ico" href="favicon.ico"/>
    
    <link href="<?=base_url()?>css/stylesheets.css" rel="stylesheet" type="text/css" />        
    
    <script type='text/javascript' src='<?=base_url()?>js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='<?=base_url()?>js/plugins/jquery/jquery-ui.min.js'></script>   
    <script type='text/javascript' src='<?=base_url()?>js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?=base_url()?>js/plugins/jquery/globalize.js'></script>    
    <script type='text/javascript' src='<?=base_url()?>js/plugins/bootstrap/bootstrap.min.js'></script>
    
    <script type='text/javascript' src='<?=base_url()?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='<?=base_url()?>js/plugins/uniform/jquery.uniform.min.js'></script>
    <script type='text/javascript' src='<?=base_url()?>js/plugins/datatables/jquery.dataTables.min.js'></script>
	
	<script type='text/javascript' src='<?=base_url()?>js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
    <script type='text/javascript' src='<?=base_url()?>js/plugins/validationengine/jquery.validationEngine.js'></script>
    
    <script type='text/javascript' src='<?=base_url()?>js/plugins.js'></script>   
    <script type='text/javascript' src='<?=base_url()?>js/actions.js'></script>
</head>
<body class="bg-img-num1"> 
    <div class="container">        
       <?=$this->load->view('template/menu')?>
        <div class="scroll">
           <?php //echo $this->load->view('template/breadcum')?>
		   <?=$this->load->view('page/'.$page)?>
        </div>
    </div>
	
	<div class="modal" id="modal_default_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
				<form id="form_modal" method="post" action="">
                <div class="modal-body clearfix">
                </div>
                <div class="modal-footer">                
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-clean">Simpan</button>
                </div>
				</form>
            </div>
        </div>
    </div>
	
	<div class="modal" id="modal_default_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body clearfix">
                </div>
                <div class="modal-footer">                
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal modal-danger" id="modal_default_9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
				<div class="modal-body clearfix">
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="modalcloseok btn btn-default btn-clean" data-direction="" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal modal-danger" id="modal_default_10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
				<div class="modal-body clearfix">
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default btn-clean" data-direction="" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
</body>
	<script type='text/javascript' src='<?=base_url()?>js/settings.js'></script>
	<script type='text/javascript' src='<?=base_url()?>js/tamansri.js'></script>
	<script type='text/javascript' src='<?=base_url()?>js/hapus.js'></script>
</html>