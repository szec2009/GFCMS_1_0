<?php

require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

// See the Vuforia Web Services Developer API Specification - https://developer.vuforia.com/resources/dev-guide/retrieving-target-cloud-database
// The DeleteTarget sample demonstrates how to delete a target from its Cloud Database using the target's target id.
// * note that targets cannot be 'Processing' and must be inactive to be deleted.

class DeleteTarget{

	//Server Keys
	private $access_key 	= "799ce8022954b3b320c850f25620c0e12622afdf";
	private $secret_key 	= "f4c058afa7a70b31e2d772fe9d428cc95f4cb2f6";
	
//	private $targetId 		= "[ target id ]";
	private $url 			= "https://vws.vuforia.com";
	private $requestPath 	= "/targets/";
	private $request;
	
//	function DeleteTarget(){
//
//		$this->requestPath = $this->requestPath . $this->targetId;
//
//		$this->execDeleteTarget();
//
//	}

	function DeleteTargetByTargetID($targetId)
	{
        $this->requestPath = $this->requestPath . $targetId;
        $this->execDeleteTarget();
	}

	public function execDeleteTarget(){

		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_DELETE );
		
		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));

		$this->request->setURL( $this->url . $this->requestPath );

		// Define the Date and Authentication headers
		$this->setHeaders();


		try {

			$response = $this->request->send();

			if (200 == $response->getStatus()) {
                $result = $response->getBody();
                return $result;
			} else {
                return $response->getBody();
			}
		} catch (HTTP_Request2_Exception $e) {
            return 'Error: ' . $e->getMessage();
		}


	}

	private function setHeaders(){
		$sb = 	new SignatureBuilder();
		$date = new DateTime("now", new DateTimeZone("GMT"));

		// Define the Date field using the proper GMT format
		$this->request->setHeader('Date', $date->format("D, d M Y H:i:s") . " GMT" );
		// Generate the Auth field value by concatenating the public server access key w/ the private query signature for this request
		$this->request->setHeader("Authorization" , "VWS " . $this->access_key . ":" . $sb->tmsSignature( $this->request , $this->secret_key ));

	}
}

?>
