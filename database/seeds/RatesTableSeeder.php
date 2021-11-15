$<?php

use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
         ['meterid' => 'F271A8A388C44D93956A063E1D2FA80B', 
			'name'=>'Static IP Address Usage',
			'rate'=>'0', 
			'unit' => 'IP Addresses', 
			'type'=>'Network'],
			['meterid' => '9E2739BA86744796B465F64674B822BA', 
			'name'=>'Dynamic IP Address Usage',
			'rate'=>'0', 
			'unit' => 'IP addresses',
			'type'=>'Network'],
			['meterid' => 'B5C15376-6C94-4FDD-B655-1A69D138ACA3', 
			'name'=>'PageBlobCapacity',
			'rate'=>'0', 
			'unit' => 'GB*hours', 
			'type'=>'Storage'],
			['meterid' => 'B4438D5D-453B-4EE1-B42A-DC72E377F1E4', 
			'name'=>'TableCapacity',
			'rate'=>'0', 
			'unit' => 'GB*hours', 
			'type'=>'Storage'],
			['meterid'=> 'B03C6AE7-B080-4BFA-84A3-22C800F315C6',
			'name'=> 'QueueCapacity',
			'rate'=>'0',
			'unit'=> 'GB*hours',
			'type'=> 'Storage'],
			['meterid'=> '09F8879E-87E9-4305-A572-4B7BE209F857',
			'name'=> 'BlockBlobCapacity',
			'rate'=>'0',
			'unit'=> 'GB*hours',
			'type'=> 'Storage'],
			['meterid'=> 'B9FF3CD0-28AA-4762-84BB-FF8FBAEA6A90',
			'name'=> 'TableTransactions',
			'rate'=>'0',
			'unit'=> "Request count in 10000's",
			'type'=> 'Storage'],
			['meterid'=> '50A1AEAF-8ECA-48A0-8973-A5B3077FEE0D',
			'name'=> 'TableDataTransIn',
			'rate'=>'0',
			'unit'=> 'Ingress data in GB',
			'type'=> 'Storage'],
			['meterid'=> '1B8C1DEC-EE42-414B-AA36-6229CF199370',
			'name'=> 'TableDataTransOut',
			'rate'=>'0',
			'unit'=> 'Egress in GB',
			'type'=> 'Storage'],
			['meterid'=> '43DAF82B-4618-444A-B994-40C23F7CD438',
			'name'=> 'BlobTransactions',
			'rate'=>'0',
			'unit'=> "Requests count in 10000's",
			'type'=> 'Storage'],
			['meterid'=> "9764F92C-E44A-498E-8DC1-AAD66587A810",
			'name'=> "BlobDataTransIn",
			'rate'=>'0',
			'unit'=> 'Ingress data in GB',
			'type'=> 'Storage'],
			['meterid'=> '3023FEF4-ECA5-4D7B-87B3-CFBC061931E8',
			'name'=> 'BlobDataTransOut',
			'rate'=>'0',
			'unit'=> 'Egress in GB',
			'type'=> 'Storage'],
			['meterid'=> 'EB43DD12-1AA6-4C4B-872C-FAF15A6785EA',
			'name'=> 'QueueTransactions',
			'rate'=>'0',
			'unit'=> "Requests count in 10000's",
			'type'=> 'Storage'],
			['meterid'=> 'E518E809-E369-4A45-9274-2017B29FFF25',
			'name'=> 'QueueDataTransIn',
			'rate'=>'0',
			'unit'=> 'Ingress data in GB',
			'type'=> 'Storage'],
			['meterid'=> 'DD0A10BA-A5D6-4CB6-88C0-7D585CEF9FC2',
			'name'=> 'QueueDataTransOut',
			'rate'=>'0',
			'unit'=> 'Egress in GB',
			'type'=> 'Storage'],
			['meterid'=> 'FAB6EB84-500B-4A09-A8CA-7358F8BBAEA5',
			'name'=> 'Base VM Size Hours',
			'rate'=>'0',
			'unit'=> 'Virtual core hours',
			'type'=> 'Compute'],
			['meterid'=> '9CD92D4C-BAFD-4492-B278-BEDC2DE8232A',
			'name'=> 'Windows VM Size Hours',
			'rate'=>'0',
			'unit'=> 'Virtual core hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Basic_A0',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Basic_A1',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Basic_A2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Basic_A3',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Basic_A4',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A0',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A1',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A3',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A4',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A5',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A6',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A7',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A1_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A2_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A4_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A8_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A2m_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A4m_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_A8m_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D1',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D3',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D4',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D11',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D12',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D13',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D14',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS1',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS3',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS4',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS11',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS12',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS13',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS14',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D1_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D2_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D3_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D4_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D5_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D11_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D12_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D13_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_D14_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS1_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS2_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS3_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS4_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS5_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS11_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS12_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS13_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_DS14_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F1',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F4',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F8',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F16',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F1s',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F2s',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F4s',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F8s',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F16s',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F2s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F4s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F8s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F16s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F32s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
			'name'=> 'Standard_F64s_v2',
			'rate'=>'0',
			'unit'=> 'VM hours',
			'type'=>'Compute'],
			['meterid'=> '380874f9-300c-48e0-95a0-d2d9a21ade8f',
			'name'=> 'S4 - Standard Managed Disk - 32 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> '1b77d90f-427b-4435-b4f1-d78adec53222',
			'name'=> 'S6 - Standard Managed Disk - 64 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> 'd5f7731b-f639-404a-89d0-e46186e22c8d',
			'name'=> 'S10 - Standard Managed Disk - 128 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> 'ff85ef31-da5b-4eac-95dd-a69d6f97b18a',
			'name'=> 'S15 - Standard Managed Disk - 256 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> '88ea9228-457a-4091-adc9-ad5194f30b6e',
			'name'=> 'S20 - Standard Managed Disk - 512 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> '5b1db88a-8596-4002-8052-347947c26940',
			'name'=> 'S30 - Standard Managed Disk - 1024 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> '7660b45b-b29d-49cb-b816-59f30fbab011',
			'name'=> 'P4 - Premium Managed Disk - 32 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> '817007fd-a077-477f-bc01-b876f27205fd',
			'name'=> 'P6 - Premium Managed Disk - 64 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> 'e554b6bc-96cd-4938-a5b5-0da990278519',
			'name'=> 'P10 - Premium Managed Disk - 128 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> 'cdc0f53a-62a9-4472-a06c-e99a23b02907',
			'name'=> 'P15 - Premium Managed Disk - 256 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'], 
			['meterid'=> 'b9cb2d1a-84c2-4275-aa8b-70d2145d59aa',
			'name'=> 'P20 - Premium Managed Disk - 512 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> '06bde724-9f94-43c0-84c3-d0fc54538369',
			'name'=> 'P30 - Premium Managed Disk - 1024 GB',
			'rate'=>'0',
			'unit'=> 'Count of Disks*month',
			'type'=>'Storage'],
			['meterid'=> '7ba084ec-ef9c-4d64-a179-7732c6cb5e28',
			'name'=> 'ActualStandardDiskSize',
			'rate'=>'0',
			'unit'=> 'GB*month',
			'type'=>'Storage'],
			['meterid'=> 'daef389a-06e5-4684-a7f7-8813d9f792d5',
			'name'=> 'ActualPremiumDiskSize',
			'rate'=>'0',
			'unit'=> 'GB*month',
			'type'=>'Storage'],
			['meterid'=> '108fa95b-be0d-4cd9-96e8-5b0d59505df1',
			'name'=> 'ActualStandardSnapshotSize',
			'rate'=>'0',
			'unit'=> 'GB*month',
			'type'=>'Storage'],
			['meterid'=> '578ae51d-4ef9-42f9-85ae-42b52d3d83ac',
			'name'=> 'ActualPremiumSnapshotSize',
			'rate'=>'0',
			'unit'=> 'GB*month',
			'type'=>'Storage'],
			['meterid'=> 'CBCFEF9A-B91F-4597-A4D3-01FE334BED82',
			'name'=> 'DatabaseSizeHourSqlMeter',
			'rate'=>'0',
			'unit'=> 'MB*hours',
			'type'=>'Database'],
			['meterid'=> 'E6D8CFCD-7734-495E-B1CC-5AB0B9C24BD3',
			'name'=> 'DatabaseSizeHourMySqlMeter',
			'rate'=>'0',
			'unit'=> 'MB*hours',
			'type'=>'Database'],
			['meterid'=> 'EBF13B9F-B3EA-46FE-BF54-396E93D48AB4',
			'name'=> 'Key Vault transactions',
			'rate'=>'0',
			'unit'=> "Request count in 10,000's",
			'type'=>'KeyVault'],
			['meterid'=> '2C354225-B2FE-42E5-AD89-14F0EA302C87',
			'name'=> 'Advanced keys transactions',
			'rate'=>'0',
			'unit'=> '10K transactions',
			'type'=>'KeyVault'],
			['meterid'=> '190C935E-9ADA-48FF-9AB8-56EA1CF9ADAA',
			'name'=> 'App Service',
			'rate'=>'0',
			'unit'=> 'Virtual core hours',
			'type'=>'AppService'],
			['meterid'=> '67CC4AFC-0691-48E1-A4B8-D744D1FEDBDE',
			'name'=> 'Functions Requests',
			'rate'=>'0',
			'unit'=> '10 Requests',
			'type'=>'AppService'],
			['meterid'=> 'D1D04836-075C-4F27-BF65-0A1130EC60ED',
			'name'=> 'Functions - Compute',
			'rate'=>'0',
			'unit'=> 'GB-s',
			'type'=>'AppService'],
			['meterid'=> '957E9F36-2C14-45A1-B6A1-1723EF71A01D',
			'name'=> 'Shared App Service Hours',
			'rate'=>'0',
			'unit'=> '1 hour',
			'type'=>'AppService'],
			['meterid'=> '539CDEC7-B4F5-49F6-AAC4-1F15CFF0EDA9',
			'name'=> 'Free App Service Hours',
			'rate'=>'0',
			'unit'=> '1 hour',
			'type'=>'AppService'],
			['meterid'=> '88039D51-A206-3A89-E9DE-C5117E2D10A6',
			'name'=> 'Small Standard App Service Hours',
			'rate'=>'0',
			'unit'=> '1 hour',
			'type'=>'AppService'],
			['meterid'=> '83A2A13E-4788-78DD-5D55-2831B68ED825',
			'name'=> 'Medium Standard App Service Hours',
			'rate'=>'0',
			'unit'=> '1 hour',
			'type'=>'AppService'],
			['meterid'=> '1083B9DB-E9BB-24BE-A5E9-D6FDD0DDEFE6',
			'name'=> 'Large Standard App Service Hours',
			'rate'=>'0',
			'unit'=> '1 hour',
			'type'=>'AppService'],
			['meterid'=> '264ACB47-AD38-47F8-ADD3-47F01DC4F473',
			'name'=> 'SNI SSL',
			'rate'=>'0',
			'unit'=> 'Per SNI SSL Binding',
			'type'=>'CustomWorkerTiers'],
			['meterid'=> '60B42D72-DC1C-472C-9895-6C516277EDB4',
			'name'=> 'IP SSL',
			'rate'=>'0',
			'unit'=> 'Per IP Based SSL Binding',
			'type'=>'CustomWorkerTiers'],
			['meterid'=> '73215A6C-FA54-4284-B9C1-7E8EC871CC5B',
			'name'=> 'Web Process',
			'rate'=>'0',
			'unit'=> 'Per active site hour',
			'type'=>'CustomWorkerTiers'],
			['meterid'=> '5887D39B-0253-4E12-83C7-03E1A93DFFD9',
			'name'=> 'External Egress Bandwidth',
			'rate'=>'0',
			'unit'=> 'GB',
			'type'=>'CustomWorkerTiers'],
		]);
    }
}
