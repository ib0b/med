<template>
  <div class="col-3">
        <div class="card">
        <ul class="list-group list-group-flush">
            <router-link :to="{ name: 'depQueue', params: { department } }" class="list-group-item">View Queue</router-link>
            <router-link :to="{ name: 'viewReports' }" class="list-group-item">View Reports</router-link>
        </ul>
        </div>
 </div>
</template>

<script>
export default {
    name:"SideBar",
    data(){
        return{
          department: this.$route.params.department
        }
    },
    created(){
        console.log(this.$route)
    }
}
</script>

<style>

</style>
