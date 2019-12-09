<template>

	<div class="panel is-primary">
	  <p class="panel-heading">
	    Virtual Machines
	  </p>
	  <div class="panel-block">
	  	<table class="table is-fullwidth">
	      <thead>
		    <tr>
		      <th>S/N</th>
		      <th>Name</th>
		      <th>VM Size</th>
		      <th>Provisioning State</th>
		      <th>OS Type</th>
		    </tr>
		  </thead>
		  <tbody>
			  <tr v-for="(resource,location) in resources">
				  	<th>{{location+1}}</th>
				  	<td>{{resource.name}}</td>
				  	<td>{{resource.vmsize}}</td>
				  	<td>{{resource.state}}</td>
				  	<td>{{resource.os_type}}</td>
			  </tr>
		  </tbody>
		</table>
	  </div>

	  
	</div>

	
</template>

<script>
	export default {
		name: 'VirtualMachines',
		props: ['resources'],
		data () {
			return {
				
			}

		},
		methods: {

		},
		created() {

		}
	}
</script>