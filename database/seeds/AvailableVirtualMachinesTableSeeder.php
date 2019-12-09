<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailableVirtualMachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('available_virtual_machines')->insert([
            ['vmsize' =>	'Standard_F2s_v2',	'vcpu'=>	'2',	'memory' =>	'4'],
			['vmsize' =>	'Standard_F4s_v2',	'vcpu'=>	'4',	'memory' =>	'8'],
			['vmsize' =>	'Standard_F8s_v2',	'vcpu'=>	'8',	'memory' =>	'16'],
			['vmsize' =>	'Standard_F16s_v2',	'vcpu'=>	'16',	'memory' =>	'32'],
			['vmsize' =>	'Standard_F32s_v2',	'vcpu'=>	'32',	'memory' =>	'64'],
			['vmsize' =>	'Standard_DS1_v2',	'vcpu'=>	'1',	'memory' =>	'3.5'],
			['vmsize' =>	'Standard_DS2_v2',	'vcpu'=>	'2',	'memory' =>	'7'],
			['vmsize' =>	'Standard_DS3_v2',	'vcpu'=>	'4',	'memory' =>	'14'],
			['vmsize' =>	'Standard_DS4_v2',	'vcpu'=>	'8',	'memory' =>	'28'],
			['vmsize' =>	'Standard_DS5_v2',	'vcpu'=>	'16',	'memory' =>	'56'],
			['vmsize' =>	'Standard_DS11_v2',	'vcpu'=>	'2',	'memory' =>	'14'],
			['vmsize' =>	'Standard_DS12_v2',	'vcpu'=>	'4',	'memory' =>	'28'],
			['vmsize' =>	'Standard_DS13_v2',	'vcpu'=>	'8',	'memory' =>	'56'],
			['vmsize' =>	'Standard_DS14_v2',	'vcpu'=>	'16',	'memory' =>	'112'],
			['vmsize' =>	'Standard_F1s',	'vcpu'=>	'1',	'memory' =>	'2'],
			['vmsize' =>	'Standard_F2s',	'vcpu'=>	'2',	'memory' =>	'4'],
			['vmsize' =>	'Standard_F4s',	'vcpu'=>	'4',	'memory' =>	'8'],
			['vmsize' =>	'Standard_F8s',	'vcpu'=>	'8',	'memory' =>	'16'],
			['vmsize' =>	'Standard_F16s',	'vcpu'=>	'16',	'memory' =>	'32'],
			['vmsize' =>	'Standard_D1_v2',	'vcpu'=>	'1',	'memory' =>	'3.5'],
			['vmsize' =>	'Standard_D2_v2',	'vcpu'=>	'2',	'memory' =>	'7'],
			['vmsize' =>	'Standard_D3_v2',	'vcpu'=>	'4',	'memory' =>	'14'],
			['vmsize' =>	'Standard_D4_v2',	'vcpu'=>	'8',	'memory' =>	'28'],
			['vmsize' =>	'Standard_D5_v2',	'vcpu'=>	'16',	'memory' =>	'56'],
			['vmsize' =>	'Standard_D11_v2',	'vcpu'=>	'2',	'memory' =>	'14'],
			['vmsize' =>	'Standard_D12_v2',	'vcpu'=>	'4',	'memory' =>	'28'],
			['vmsize' =>	'Standard_D13_v2',	'vcpu'=>	'8',	'memory' =>	'56'],
			['vmsize' =>	'Standard_D14_v2',	'vcpu'=>	'16',	'memory' =>	'112'],
			['vmsize' =>	'Standard_F1',	'vcpu'=>	'1',	'memory' =>	'2'],
			['vmsize' =>	'Standard_F2',	'vcpu'=>	'2',	'memory' =>	'4'],
			['vmsize' =>	'Standard_F4',	'vcpu'=>	'4',	'memory' =>	'8'],
			['vmsize' =>	'Standard_F8',	'vcpu'=>	'8',	'memory' =>	'16'],
			['vmsize' =>	'Standard_F16',	'vcpu'=>	'16',	'memory' =>	'32'],
			['vmsize' =>	'Standard_A1_v2',	'vcpu'=>	'1',	'memory' =>	'2'],
			['vmsize' =>	'Standard_A2_v2',	'vcpu'=>	'2',	'memory' =>	'4'],
			['vmsize' =>	'Standard_A4_v2',	'vcpu'=>	'4',	'memory' =>	'8'],
			['vmsize' =>	'Standard_A8_v2',	'vcpu'=>	'8',	'memory' =>	'16'],
			['vmsize' =>	'Standard_A2m_v2',	'vcpu'=>	'2',	'memory' =>	'16'],
			['vmsize' =>	'Standard_A4m_v2',	'vcpu'=>	'4',	'memory' =>	'32'],
			['vmsize' =>	'Standard_A8m_v2',	'vcpu'=>	'8',	'memory' =>	'64'],
			['vmsize' =>	'Standard_F64s_v2 ',	'vcpu'=>	'64',	'memory' =>	'128']
        ]);
    }
}

