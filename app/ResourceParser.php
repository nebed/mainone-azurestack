<?php

namespace App;

class ResourceParser
{

	public function __construct()
	{

	}

	public function parse($resource_type,$resource)
	{
		$result = [];
		$yes = 0;

		switch ($resource_type) {
		    case 'Microsoft.Compute/virtualMachines':
		        $data = json_decode($resource);
		        $result = [
		        	'vmsize' => $data->properties->hardwareProfile->vmSize, 
		        	'os_type'=> $data->properties->storageProfile->osDisk->osType, 
		        	'state'=> $data->properties->provisioningState,
		        			];
		        break;
		    case 'Microsoft.Network/publicIpAddresses':
		        $yes = 1;
		        break;
		    case 'Microsoft.Storage/storageaccounts':
		        $yes = 1;
		        break;
		    default:
		        $yes = 1;
		}

		return $result;
	}
}