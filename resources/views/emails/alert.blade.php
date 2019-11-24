@component('mail::message')
## Alert : {{ $alert_type }} --{{$time}}


### Customer Details
* **Customer Name** : {{$tenant}}
* **Tenant ID** : {{$tenant_id}}


### Resource Info
* **Resource Name** : {{$resource_name}}  
* **Resource Type** : {{$resource_type}}

@if($alert_type == 'Changed Resource')

| **Old Resource Details** | **New Resource Details** |
| _{{$old_resource_details}}_ | _{{$resource_details}}_ |

@else

**Resource Details**
_{{$resource_details}}_

@endif
 
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
