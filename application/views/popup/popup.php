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
        <div class="scroll">
           <?=$this->load->view($page);?>
        </div>
    </div>
</body>
	<script type='text/javascript' src='<?=base_url()?>js/settings.js'></script>
	<script type='text/javascript' src='<?=base_url()?>js/tamansri.js'></script>
</html>