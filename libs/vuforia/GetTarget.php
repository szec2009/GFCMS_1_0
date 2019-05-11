<?php

require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

// See the Vuforia Web Services Developer API Specification - https://developer.vuforia.com/resources/dev-guide/retrieving-target-cloud-database
// The GetTarget sample demonstrates how to query a single target by target id.
class GetTarget{
	
	//Server Keys
	private $access_key 	= "799ce8022954b3b320c850f25620c0e12622afdf";
	private $secret_key 	= "f4c058afa7a70b31e2d772fe9d428cc95f4cb2f6";
	
	public $targetId 	= ""; //062f6cde8470426493a5c1a898a81c06
	private $url 		= "https://vws.vuforia.com";
	private $requestPath = "/targets/";// . $targetId;
	private $request;
	
	function GetTarget(){

		$this->requestPath = $this->requestPath . $this->targetId;
	}

	function GetTargetByTargetID($_targetId)
    {
        $this->requestPath = $this->requestPath . $_targetId;
        return $this->execGetTarget();
    }
	
	public function execGetTarget(){

	    $returnResult = null;
		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_GET );
		
		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));
		
		$this->request->setURL( $this->url . $this->requestPath );
		
		// Define the Date and Authentication headers
		$this->setHeaders();
		
		
		try {
		
			$response = $this->request->send();
		
			if (200 == $response->getStatus()) {
				//echo $response->getBody();
                $returnResult = $response->getBody();
                return $returnResult;
			} else {
				//echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $returnResult =$response->getBody();
                return $returnResult;
			}
		} catch (HTTP_Request2_Exception $e) {
			//echo 'Error: ' . $e->getMessage();
            $returnResult = $e->getMessage();
		}

		return $returnResult;
		
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