<template>
	
	<tr :class="!resource.compliant ? 'has-background-warning':'has-background-success'">
		<td @click="emitClick">{{resource.name}}</td>
		<td>{{resource.type}}</td>
		<td>{{resource.compliant == 0 ? "No" : "Yes"}}</td>
		<td>{{resource.updated_at}}</td>
		<td><button v-if="!resource.compliant" @click="makeCompliant(resource.id)" class="button is-link">Make Compliant</button></td>
	</tr>


</template>

<script>

export default {
  name: 'Resource',
  props: ['resource'],
  data () {
    return {
      errors : {
        'resources' : null,
        'subscriptions' : null,
      }  
    }
  },

  methods: {
    redirectTo(path) {
      return this.$router.push(path)
    },
    makeCompliant(id) {
    	this.$http({
            method: 'post',
            url: 'resources/approve/'+id,
          }).then((res) => {
            this.errors.resources = false;
          }).catch((error) => {
            this.errors.resources = true;
          });
    	this.$emit('changed', {'name':this.resource.name});
    },
    emitClick() {
      this.$emit('clicked');
    }
  },

  created () {

  }
}
</script>