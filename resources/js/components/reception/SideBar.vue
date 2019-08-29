<template>
  <div class="col-3">
        <div class="card">
        <ul class="list-group list-group-flush">
            <router-link to="/reception/new" class="list-group-item">New</router-link>
            <router-link to="/reception/queue" class="list-group-item">Add to queue</router-link>
        </ul>
        </div>
 </div>
</template>

<script>
export default {
    name:"SideBar"
}
</script>

<style>

</style>
