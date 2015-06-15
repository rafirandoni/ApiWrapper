<?php

/**
 * TVdb Wrapper
 *
 * Created by : Rafi Randoni
 * @version 1.0.0 First Release
 * @license http://opensource.org/licenses/MIT MIT
 *
 * Description : 
 * Use tvdb api more easier
 */

class TvdbWrapper {

    protected $api_key;
    protected $cache_folder;

    // All datas
    public $datas = array();

    // All errors 
    public $errors = array();

    protected $mirror_path = 'http://thetvdb.com/';

    public function __construct($api_key, $cache_folder)
    {
        $this->api_key = $api_key;
        $this->cache_folder = $cache_folder;

        $this->_getMirror();
    }

    protected function _getMirror()
    {
        $url = $this->mirror_path.'api/'.$this->api_key.'/mirrors.xml';
        $data = file_get_contents($url);
        $xml = simplexml_load_string($data);

        if ($xml) {
            $this->mirror_path = $xml->Mirror->mirrorpath;
            return true;
        }

        return false;

    }

}

$tvdb = new TvdbWrapper('9DAF49C96CBF8DAC', 'cache');
var_dump($tvdb->_getMirror());
?>