<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('database','session','form_validation','getdatatabel','periode','pagination','createnosurat','terbilang_lib');
$autoload['helper'] = array('url','file','form','array');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('simpan','update','hapus','m_master_jenis_barang');