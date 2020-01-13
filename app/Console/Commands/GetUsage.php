<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Endpoint;

class GetUsage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:usage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $endpoint = new Endpoint;
        $usage_result = $endpoint->get_usage();
        $billing_period = $usage_result[0];
        $usage_data = $usage_result[1]->groupBy(['subscriptionId','meterId','resourcename']);

        foreach ($usage_data as $subscriptionId => $meters) {
            foreach ($meters as $meterId => $resources) {
                if($meterId != '6dab500f-a4fd-49c4-956d-229bb9c8c793')
                {
                    $name = \App\Rate::where('meterid',$meterId)->first()->name;
                    $totalusage = $resources->flatten()->sum('quantity'); 
                    $this->modelCreateOrUpdate('Usage',['usage'=>$totalusage,'meterid'=>$meterId],['metername'=>$name,'billing_period'=>$billing_period,'subscriptionid'=>$subscriptionId]);  
                }
                else
                {
                    $vms = $resources->flatten()->groupBy(function($item){
                        return $item->additionalInfo->ServiceType;
                    });
                    foreach ($vms as $key => $value) {
                        $sum = $value->flatten()->sum('quantity');
                        $this->modelCreateOrUpdate('Usage',['meterid'=>$meterId,'usage'=>$sum],['metername'=>$key,'billing_period'=>$billing_period,'subscriptionid'=>$subscriptionId]);
                    }
                }
            }
        }
    }


    public function modelCreateOrUpdate($modelname,$data,$column_to_match)
    {
        //Capitalize first letter of $modelname
        $modelname = ucfirst($modelname);

        $r = new \ReflectionClass('App\\'.$modelname);

        // @param ClassPeer $instance

        $modelinstance =  $r->newInstanceWithoutConstructor();

        //dynamically call the Model class using $modelname param
        $model_data = $modelinstance->updateOrCreate($column_to_match,$data);

        //change updated_at column even if data was not updated to show it still exists
        $model_data->touch();

        //\Log::info(print_r($model_data, true));

    }
}
