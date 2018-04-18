  <?php
         require_once '../lib/nusoap.php';
         
         $GetJefe = new nusoap_client('http://herramientas.techo.org/aff/ws_soap/server/?wsdl', false);
         
         $param = array('token' => '248d39fda271e04a0cd208ef15c9f9e7-b8acaa3e64004303ac6f43e77c3a39ce',
             'mail' => 'ezequiel.cruz@techo.org'
         );
         
         $result = $GetJefe->call('GetJefeDirecto', $param);
         
         $array = ($result);
         
         echo('<pre>');
         echo(print_r($array, true));
            
            ?>