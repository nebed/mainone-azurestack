<template>
	



</template>

<script>

export default {
  name: 'Report',
  props: ['report'],
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
    }
  },

  created () {

  }
}
</script>