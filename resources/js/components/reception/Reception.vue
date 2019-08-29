<template>
        <div class="row">
           <SideBar/>
           <router-view></router-view>
        </div>
</template>

<script>
    import SideBar from './SideBar'
    export default {

        components:{
            SideBar
        },
        async beforeRouteEnter (to,from,next){


            let response = await axios.get('/getDepartment')
            let authDep = response.data;
            console.log(authDep)
            if(authDep!="reception"){
                next('/'+authDep)
            }
            next();

        }

    }
</script>
