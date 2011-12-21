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


include "vnca_api.php";

	// echo "DUMP REGIONS\n";
        // var_dump(vnca_api_did('regions', array('country'=>'CA')));

        // echo "DUMP Ratecenters\n";
        // var_dump(vnca_api_did('ratecenters', array('country'=>'USA', 'region'=>'TN')));

        // echo "DUMP DID List\n";
	// var_dump(vnca_api_did('list', array('country'=>'USA', 'region'=>'DC', 'ratecenter'=>'Washington Zone 1', 'limit'=>'3')));

        // echo "DUMP DID Info\n";
        var_dump(vnca_api_did('didinfo', array('did'=>'2025911612')));

        // echo "DUMP DID Order\n";
        // var_dump(vnca_api_did('orderdid', array('did'=>'883510009050008', 'package_id'=>'15', 'peer_id'=>'60499')));

        // echo "DUMP DID UpdatePeerID\n";
        // var_dump(vnca_api_did('updatepeerid', array('did'=>'2024590982', 'peer_id'=>'60499')));

        //echo "DUMP PeerList\n";
        // var_dump(vnca_api_peer('list', NULL));

        // echo "DUMP PeerInfo\n";
        // var_dump(vnca_api_peer('peerinfo', array('peer_id'=>'60499')));

        // echo "DUMP Peer create statis\n";
        // var_dump(vnca_api_peer('createstatic', array('desc'=>'test peer 1', 'ip'=>'190.124.41.6')));

?>
