<?php

require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

// See the Vuforia Web Services Developer API Specification - https://developer.vuforia.com/resources/dev-guide/retrieving-target-cloud-database
// The UpdateTarget sample demonstrates how to update the attributes of a target using a JSON request body. This example updates the target's metadata.

class UpdateTarget{

	//Server Keys
	private $access_key 	= "799ce8022954b3b320c850f25620c0e12622afdf";
	private $secret_key 	= "f4c058afa7a70b31e2d772fe9d428cc95f4cb2f6";

	private $targetId 		= "";//"[ target id ]";
	private $url 			= "https://vws.vuforia.com";
	private $requestPath 	= "/targets/";
	private $request;
	private $jsonBody 		= "";
	
	function UpdateTarget(){

		$this->requestPath = $this->requestPath . $this->targetId;
		
		$helloBase64 = base64_encode("hello world!");
		
		$this->jsonBody = json_encode( array( 'application_metadata' => $helloBase64 ) );

		//$this->execUpdateTarget();

	}

	function UpdateTargetByTargetID($targetID, $active = 1, $jsonFile)
	{

		$this->targetId = $targetID;
        $this->requestPath = $this->requestPath . $this->targetId;
        $this->jsonBody = json_encode (
        	array(
        		'application_metadata' => base64_encode($jsonFile),
                'active_flag' => $active
			)
		);
        $this->execUpdateTarget();
	}

	public function execUpdateTarget(){

		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_PUT );
		$this->request->setBody( $this->jsonBody );

		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));

		$this->request->setURL( $this->url . $this->requestPath );

		// Define the Date and Authentication headers
		$this->setHeaders();


		try {

			$response = $this->request->send();

			if (200 == $response->getStatus()) {

				echo $response->getBody();
			} else {
				return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase(). ' ' . $response->getBody();
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
		$this->request->setHeader("Content-Type", "application/json" );
		// Generate the Auth field value by concatenating the public server access key w/ the private query signature for this request
		$this->request->setHeader("Authorization" , "VWS " . $this->access_key . ":" . $sb->tmsSignature( $this->request , $this->secret_key ));

	}
}

?>
