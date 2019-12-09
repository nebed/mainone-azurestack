@component('mail::message')
## Alert : {{ $alert_type }} --{{$time}}


### Customer Details
* **Customer Name** : {{$tenant}}
* **Tenant ID** : {{$tenant_id}}


### Resource Info
* **Resource Name** : {{$resource_name}}  
* **Resource Type** : {{$resource_type}}

@if($alert_type == 'Changed Resource')

---

**Old Resource Details**

{{$old_resource_details}}

---

---

**New Resource Details**

{{$resource_details}}

---


@else

---

**New Resource Details**

{{$resource_details}}

---

@endif
 
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
