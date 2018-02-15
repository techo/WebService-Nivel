  <?php
         require_once '../lib/nusoap.php';
         
         $GetJefe = new nusoap_client('http://herramientas.techo.org/aff/ws_soap/server/?wsdl', false);
         
         $param = array('token' => '248d39fda271e04a0cd208ef15c9f9e7-444e3db2ce67915f94e8c17405aea9b3',
             'mail' => 'ezequiel.cruz@techo.org'
         );
         
         $result = $GetJefe->call('GetJefeDirecto', $param);
         
         $array = ($result);
         
         echo('<pre>');
         echo(print_r($array, true));
            
            ?>