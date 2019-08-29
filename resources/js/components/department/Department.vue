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

            console.log("entering dep")
            console.log(to,from)
            //return;
            let response = await axios.get('/getDepartment')
            let authDep = response.data;

            if(to.params.department!=authDep){
                next('/'+authDep)
                return;
            }
            next();

        }

    }
</script>
