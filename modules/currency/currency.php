<?php

class ModuleCurrency extends Module {

    public $module_name = 'currency';

    public function action_rate() {
        $request_xml = file_get_contents("php://input");

        function getCurrency($method_name, $args) {
            return $args[0] . ': ' . 67 . ' RUB';
        }

        $xmlrpc_server = xmlrpc_server_create();

        xmlrpc_server_register_method($xmlrpc_server, 'getCurrency', 'getCurrency');

        header('Content-Type: text/xml');

        echo xmlrpc_server_call_method($xmlrpc_server, $request_xml, array());
    }

} 
