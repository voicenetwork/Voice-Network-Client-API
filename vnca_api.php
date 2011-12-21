<?php
/*
        VNCA CLIENT API
        Version: MPL 1.1

        The contents of this file are subject to the Mozilla Public License Version
        1.1 (the "License"); you may not use this file except in compliance with
        the License. You may obtain a copy of the License at
        http://www.mozilla.org/MPL/

        Software distributed under the License is distributed on an "AS IS" basis,
        WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
        for the specific language governing rights and limitations under the
        License.

        The Original Code is VoiceNetwork.ca API Client Lib

        The Initial Developer of the Original Code is
        Ken Rice 
        Portions created by the Initial Developer are Copyright (C) 2011
        the Initial Developer. All Rights Reserved.

        Contributor(s):
        Ken Rice 

*/


function vnca_api_did($call, $params) {

	switch(strtolower($call)) {
		case 'regions':
			return get_did_regions($params);
			break;
		case 'ratecenters':
			return get_did_ratecenters($params);
			break;
		case 'list':
			return get_did_list($params);
			break;
		case 'didinfo':
			return get_did_info($params);
			break;
		case 'orderdid':
			return get_did_order($params);
			break;
		case 'updatepeerid':
			return get_did_update_peer_id($params);
			break;
		case 'forward':
			return NULL;
			break;
	}
}

function do_curl_get($method_in, $get_params){

	$api_key='API_KEY_GOES_HERE';
	// $api_key='TESTLK83MGAPIJL56LR5LKKEYGQEUJL5UYAFZDAG';

	$post_fields = '';

	if(is_array($get_params)) {
		foreach($get_params as $key => $val){
			$post_fields .= "$key=" . urlencode($val) . "&";
		}
	}

	$post_fields .= 'X-API-KEY='.$api_key.'&format=json';

	$method = 'http://api.voicenetwork.ca/api/v1/' . $method_in . "?" . $post_fields;;
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,$method);
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);

	return $buffer;
}

function get_did_regions($params) {
	if (!isset($params['country'])){
		return false;
	} 

	$results = json_decode(do_curl_get('did/regions', $params), true);
	
	if ($results['status'] != 'success') {
		return false;
	} else { 

		return $results['regions'];
	}
}

function get_did_ratecenters($params) {
	if (!isset($params['country'])){
		return false;
	} 

	$data = json_decode(do_curl_get('did/RateCenters', $params), true);

	if ($data['status'] != 'success') {
		return false;
	} else { 
		$ratecenters = $data['ratecenters'];
		if (isset($params['region'])) {
			$x = 0;
			foreach($ratecenters as $ratecenter) {
				$rc =  $ratecenter;
				if ($rc['region'] == $params['region']) {
					$results[$x] = $rc;
					$x++;
				}
			}
		} else { 
			$x = 0;
			foreach($ratecenters as $ratecenter) {
				$rc =  $ratecenter;
				$results[$x] = $rc;
				$x++;
			}
		}
		return $results;
	}
}

function get_did_list($params) {
	if (!isset($params['country'])){
		echo "no Country";
		return false;
	} 
	if (!isset($params['region'])){
		echo "no region";
		return false;
	} 
	if (!isset($params['ratecenter'])){
		echo "no ratecenter";
		return false;
	} 


	$results = json_decode(do_curl_get('did/list', $params), true);

	if ($results['status'] != 'success') {
		print_r($results);
		return false;
	} else { 
		return $results['dids'];
	}
}

function get_did_info($params) {
	if (!isset($params['did'])){
		return false;
	} 

	$results = json_decode(do_curl_get('did/didinfo', $params), true);

	if ($results['status'] != 'success') {
		return false;
	} else { 
		return array('dids' => $results['dids'], 'packages' => $results['packages']);
	}
}

function get_did_order($params) {
	if (!isset($params['did'])){
		return false;
	} 
	if (!isset($params['package_id'])){
		return false;
	} 

	$results = json_decode(do_curl_get('did/orderdid', $params), true);

	if ($results['status'] != 'success') {
		return false;
	} else { 
		return $results['success'];
	}
}

function get_did_update_peer_id($params) {

	if (!isset($params['did'])){
		return false;
	} 
	if (!isset($params['peer_id'])){
		return false;
	} 

	$results = json_decode(do_curl_get('did/updatepeerid', $params), true);

	if ($results['status'] != 'success') {
		return false;
	} else { 
		return $results['success'];
	}
}

?>
