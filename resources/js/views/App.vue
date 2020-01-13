<template>
  <div>
    <app-navbar></app-navbar>
    <notifications group="foo" />
    <router-view/>
  </div>
</template>

<script>
  export default {
    name: 'App',
  }
</script>

<style>

body {
    color: #4a4a4a;
    font-size: 1em;
    font-weight: 400;
    line-height: 1.5;
}

</style>