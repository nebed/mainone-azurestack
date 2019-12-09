<?php

use Illuminate\Database\Seeder;

class MetersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meters')->insert([
        	['meterid' => 'F271A8A388C44D93956A063E1D2FA80B', 'name'=>'Static IP Address Usage', 'unit' => 'IP Addresses', 'type'=>'Network'],
        	['meterid' => '9E2739BA86744796B465F64674B822BA', 'name'=>'Dynamic IP Address Usage', 'unit' => 'IP addresses','type'=>'Network'],
        	['meterid' => 'B4438D5D-453B-4EE1-B42A-DC72E377F1E4', 'name'=>'TableCapacity', 'unit' => 'GB*hours', 'type'=>'Storage'],
        	['meterid' => '9E2739BA86744796B465F64674B822BA', 'name'=>'Dynamic IP Address Usage', 'unit' => 'IP addresses','type'=>'Network'],
        	['meterid' => 'B5C15376-6C94-4FDD-B655-1A69D138ACA3', 'name'=>'PageBlobCapacity', 'unit' => 'GB*hours', 'type'=>'Storage'],

        ]);
    }
}



['meterid'=> 'B03C6AE7-B080-4BFA-84A3-22C800F315C6',
'name'=> 'QueueCapacity',
'unit'=> 'GB*hours'],
['meterid'=> '09F8879E-87E9-4305-A572-4B7BE209F857',
'name'=> 'BlockBlobCapacity',
'unit'=> 'GB*hours'],
['meterid'=> 'B9FF3CD0-28AA-4762-84BB-FF8FBAEA6A90',
'name'=> 'TableTransactions',
'unit'=> "Request count in 10,000's"
],
['meterid'=> '50A1AEAF-8ECA-48A0-8973-A5B3077FEE0D',
'name'=> 'TableDataTransIn',
'unit'=> 'Ingress data in GB'],
['meterid'=> '1B8C1DEC-EE42-414B-AA36-6229CF199370'
'name'=> 'TableDataTransOut'
'unit'=> 'Egress in GB'],
['meterid'=> '43DAF82B-4618-444A-B994-40C23F7CD438'
'name'=> 'BlobTransactions'
'unit'=> "Requests count in 10,000's"],
['meterid'=> "9764F92C-E44A-498E-8DC1-AAD66587A810"
'name'=> "BlobDataTransIn"
'unit'=> 'Ingress data in GB'],
['meterid'=> '3023FEF4-ECA5-4D7B-87B3-CFBC061931E8'
'name'=> 'BlobDataTransOut'
'unit'=> 'Egress in GB'],
['meterid'=> 'EB43DD12-1AA6-4C4B-872C-FAF15A6785EA'
'name'=> 'QueueTransactions'
'unit'=> "Requests count in 10,000's"],
['meterid'=> 'E518E809-E369-4A45-9274-2017B29FFF25'
'name'=> 'QueueDataTransIn'
'unit'=> 'Ingress data in GB'],
['meterid'=> 'DD0A10BA-A5D6-4CB6-88C0-7D585CEF9FC2'
'name'=> 'QueueDataTransOut'
'unit'=> 'Egress in GB'],

Compute
'meterid'=> 'FAB6EB84-500B-4A09-A8CA-7358F8BBAEA5'
'name'=> 'Base VM Size Hours'
'unit'=> 'Virtual core hours'

'meterid'=> '9CD92D4C-BAFD-4492-B278-BEDC2DE8232A'
'name'=> 'Windows VM Size Hours'
'unit'=> 'Virtual core hours'

'meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793'
'name'=> 'VM size hours'
'unit'=> 'VM hours'

Managed Disks
'meterid'=> 380874f9-300c-48e0-95a0-d2d9a21ade8f
'name'=> S4 - Standard Managed Disk - 32 GB
'unit'=> Count of Disks*month 

'meterid'=> 1b77d90f-427b-4435-b4f1-d78adec53222
'name'=> S6 - Standard Managed Disk - 64 GB
'unit'=> Count of Disks*month 

'meterid'=> d5f7731b-f639-404a-89d0-e46186e22c8d
'name'=> S10 - Standard Managed Disk - 128 GB
'unit'=> Count of Disks*month

'meterid'=> ff85ef31-da5b-4eac-95dd-a69d6f97b18a
'name'=> S15 - Standard Managed Disk - 256 GB
'unit'=> Count of Disks*month

'meterid'=> 88ea9228-457a-4091-adc9-ad5194f30b6e
'name'=> S20 - Standard Managed Disk - 512 GB
'unit'=> Count of Disks*month

'meterid'=> 5b1db88a-8596-4002-8052-347947c26940
'name'=> S30 - Standard Managed Disk - 1024 GB
'unit'=> Count of Disks*month 

'meterid'=> 7660b45b-b29d-49cb-b816-59f30fbab011
'name'=> P4 - Premium Managed Disk - 32 GB
'unit'=> Count of Disks*month 

'meterid'=> 817007fd-a077-477f-bc01-b876f27205fd
'name'=> P6 - Premium Managed Disk - 64 GB
'unit'=> Count of Disks*month

'meterid'=> e554b6bc-96cd-4938-a5b5-0da990278519
'name'=> P10 - Premium Managed Disk - 128 GB
'unit'=> Count of Disks*month 

'meterid'=> cdc0f53a-62a9-4472-a06c-e99a23b02907
'name'=> P15 - Premium Managed Disk - 256 GB
'unit'=> Count of Disks*month 

'meterid'=> b9cb2d1a-84c2-4275-aa8b-70d2145d59aa
'name'=> P20 - Premium Managed Disk - 512 GB
'unit'=> Count of Disks*month

'meterid'=> 06bde724-9f94-43c0-84c3-d0fc54538369
'name'=> P30 - Premium Managed Disk - 1024 GB
'unit'=> Count of Disks*month

'meterid'=> 7ba084ec-ef9c-4d64-a179-7732c6cb5e28
'name'=> ActualStandardDiskSize
'unit'=> GB*month

'meterid'=> daef389a-06e5-4684-a7f7-8813d9f792d5
'name'=> ActualPremiumDiskSize
'unit'=> GB*month

'meterid'=> 108fa95b-be0d-4cd9-96e8-5b0d59505df1
'name'=> ActualStandardSnapshotSize
'unit'=> GB*month

'meterid'=> 578ae51d-4ef9-42f9-85ae-42b52d3d83ac
'name'=> ActualPremiumSnapshotSize
'unit'=> GB*month

'meterid'=> 5d76e09f-4567-452a-94cc-7d1f097761f0
'name'=> S4 - Standard Managed Disk - 32 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> dc9fc6a9-0782-432a-b8dc-978130457494
'name'=> S6 - Standard Managed Disk - 64 GB (Deprecated)
'unit'=> Count of Disks*hours

'meterid'=> e5572fce-9f58-49d7-840c-b168c0f01fff
'name'=> S10 - Standard Managed Disk - 128 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 9a8caedd-1195-4cd5-80b4-a4c22f9302b8
'name'=> S15 - Standard Managed Disk - 256 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 5938f8da-0ecd-4c48-8d5a-c7c6c23546be
'name'=> S20 - Standard Managed Disk - 512 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 7705a158-bd8b-4b2b-b4c2-0782343b81e6
'name'=> S30 - Standard Managed Disk - 1024 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 5c105f5f-cbdf-435c-b49b-3c7174856dcc
'name'=> P4 - Premium Managed Disk - 32 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 518b412b-1927-4f25-985f-4aea24e55c4f
'name'=> P6 - Premium Managed Disk - 64 GB (Deprecated)
'unit'=> Count of Disks*hours

'meterid'=> 5cfb1fed-0902-49e3-8217-9add946fd624
'name'=> P10 - Premium Managed Disk - 128 GB (Deprecated)
'unit'=> Count of Disks*hours

'meterid'=> 8de91c94-f740-4d9a-b665-bd5974fa08d4
'name'=> P15 - Premium Managed Disk - 256 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> c7e7839c-293b-4761-ae4c-848eda91130b
'name'=> P20 - Premium Managed Disk - 512 GB (Deprecated)
'unit'=> Count of Disks*hours 

'meterid'=> 9f502103-adf4-4488-b494-456c95d23a9f
'name'=> P30 - Premium Managed Disk - 1024 GB (Deprecated)
'unit'=> Count of Disks*hours

'meterid'=> 8a409390-1913-40ae-917b-08d0f16f3c38
'name'=> ActualStandardDiskSize (Deprecated)
'unit'=> Byte*hours

'meterid'=> 1273b16f-8458-4c34-8ce2-a515de551ef6
'name'=> ActualPremiumDiskSize (Deprecated)
'unit'=> Byte*hours

'meterid'=> 89009682-df7f-44fe-aeb1-63fba3ddbf4c
'name'=> ActualStandardSnapshotSize (Deprecated)
'unit'=> Byte*hours

'meterid'=> 95b0c03f-8a82-4524-8961-ccfbf575f536
'name'=> ActualPremiumSnapshotSize (Deprecated)
'unit'=> Byte*hours

'meterid'=> 75d4b707-1027-4403-9986-6ec7c05579c8 
'name'=> ActualStandardSnapshotSize (Deprecated)
'unit'=> GB*month

'meterid'=> 5ca1cbb9-6f14-4e76-8be8-1ca91547965e 
'name'=> ActualPremiumSnapshotSize (Deprecated)
'unit'=> GB*month  

'meterid'=> CBCFEF9A-B91F-4597-A4D3-01FE334BED82
'name'=> DatabaseSizeHourSqlMeter
'unit'=> MB*hours

'meterid'=> E6D8CFCD-7734-495E-B1CC-5AB0B9C24BD3
'name'=> DatabaseSizeHourMySqlMeter
'unit'=> MB*hours


'meterid'=> EBF13B9F-B3EA-46FE-BF54-396E93D48AB4
'name'=> Key Vault transactions
'unit'=> Request count in 10,000's

'meterid'=> 2C354225-B2FE-42E5-AD89-14F0EA302C87
'name'=> Advanced keys transactions
'unit'=> 10K transactions

'meterid'=> 190C935E-9ADA-48FF-9AB8-56EA1CF9ADAA
'name'=> App Service
'unit'=> Virtual core hours


'meterid'=> 67CC4AFC-0691-48E1-A4B8-D744D1FEDBDE
'name'=> Functions Requests
'unit'=> 10 Requests

'meterid'=> D1D04836-075C-4F27-BF65-0A1130EC60ED
'name'=> Functions - Compute
'unit'=> GB-s

'meterid'=> 957E9F36-2C14-45A1-B6A1-1723EF71A01D
'name'=> Shared App Service Hours
'unit'=> 1 hour

'meterid'=> 539CDEC7-B4F5-49F6-AAC4-1F15CFF0EDA9
'name'=> Free App Service Hours
'unit'=> 1 hour

'meterid'=> 88039D51-A206-3A89-E9DE-C5117E2D10A6
'name'=> Small Standard App Service Hours
'unit'=> 1 hour

'meterid'=> 83A2A13E-4788-78DD-5D55-2831B68ED825
'name'=> Medium Standard App Service Hours
'unit'=> 1 hour

'meterid'=> 1083B9DB-E9BB-24BE-A5E9-D6FDD0DDEFE6
'name'=> Large Standard App Service Hours
'unit'=> 1 hour

'meterid'=> Custom Worker Tiers
'name'=> Custom Worker Tiers
'unit'=> Hours

'meterid'=> 264ACB47-AD38-47F8-ADD3-47F01DC4F473
'name'=> SNI SSL
'unit'=> Per SNI SSL Binding

'meterid'=> 60B42D72-DC1C-472C-9895-6C516277EDB4
'name'=> IP SSL
'unit'=> Per IP Based SSL Binding

'meterid'=> 73215A6C-FA54-4284-B9C1-7E8EC871CC5B
'name'=> Web Process
'unit'=> Per active site hour

'meterid'=> 5887D39B-0253-4E12-83C7-03E1A93DFFD9
'name'=> External Egress Bandwidth
'unit'=> GB
