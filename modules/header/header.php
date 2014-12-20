<?php defined('SITE') or die('No direct script access.');

class ModuleHeader extends Module {

    public $module_name = 'header';

    function __construct() {
        parent::__construct();

        $this->render();
    }

    public function render() {
        return <<<EOT
            <script type="text/javascript" src="{$this->script_path}"></script>
            <header class="{$this->module_name}">
                <h1 class="{$this->module_name}-title"><a class="header-link" href="/">Сайтик</a></h1>
                <span class="{$this->module_name}-currency" title="Демо XML-RPC">{$this->getCurrency()}</span>
                <span class="{$this->module_name}-layout pseudo-button">Изменить раскладку <span>(in progress)</span></span>
            </header>
EOT;
    }

    private function getCurrency () {
        global $config;

        $xmlrpc_server = $config['server']['xmlrpc']['server'];

        $request = xmlrpc_encode_request('getCurrency', array('USD'));

        $context = stream_context_create(array('http' => array(
            'method' => 'GET',
            'header' => "Content-Type: text/xml\r\nUser-Agent: PHPRPC/1.0\r\n",
            'content' => $request
        )));

        $server = "http://{$xmlrpc_server}/index2.php?mod=currency&action=rate";
        $file = file_get_contents($server, false, $context);

        $response = xmlrpc_decode($file);

        return $response;
    }

}
