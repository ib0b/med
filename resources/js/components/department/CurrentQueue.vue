<template>
    <div class="col-9">
        <div v-if="!queueEmpty" class="card mt-4">
            <button @click="callNext" class="btn btn-success">Call Next Patient</button>
        </div>
        <div class="card mt-4">
            <div class="card-header">Current Queued Patients</div>
            <div class="card-body">
                <p v-if="queueEmpty" class="text-danger">No patient in queue</p>
                <table v-if="!queueEmpty" class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Date and Time</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pat in queue" :key="pat.id">
                                <td>{{pat.id}}</td>
                                <td>{{pat.name}}</td>
                                <td>{{pat.time}}</td>
                            </tr>

                        </tbody>
                </table>
            </div>
        </div>


    </div>


</template>

<script>
import { setTimeout } from 'timers';
export default {
    data(){
        return{
           queue:[],
           queueEmpty:false,
           pollInterval:null
        }
    },
    methods:{
        async callNext(){
           let dep = this.$route.params.department
           let response = await axios.get(`/queue/${dep}/next`)
           console.log(response)
           let visitId = response.data.id
           this.$router.push({ name: 'notes',params: {department:dep, visitId}})
        },
        pollData(){
            this.pollInterval = setInterval(async () => {
                let dep = this.$route.params.department
                let response = await axios.get(`/queue/${dep}`)
                console.log(response.data)
                this.queue = response.data
                this.queueEmpty = this.queue.length==0?true:false
            }, 1000)
        }
    },
    beforeDestroy () {
        clearInterval(this.pollInterval)
    },
    created () {
        this.pollData()
    }


}
</script>

<style>

</style>
