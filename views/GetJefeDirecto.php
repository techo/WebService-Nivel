  <?php
         require_once '../lib/nusoap.php';
         
         $GetJefe = new nusoap_client('http://herramientas.techo.org/aff/ws_soap/server/?wsdl', false);
         
         $param = array('token' => '248d39fda271e04a0cd208ef15c9f9e7-b27428651e90c50bba0b6dd04d3f60df',
             'mail' => 'ezequiel.cruz@techo.org'
         );
         
         $result = $GetJefe->call('GetJefeDirecto', $param);
         
         $array = ($result);
         
         echo('<pre>');
         echo(print_r($array, true));
            
            ?>