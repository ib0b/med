<template>
    <div class="col-9">
        <div class="card">
            <div class="card-header">Refer or End Visit</div>
            <div class="card-body">
                <p>Patients Details<br>
                ID :<b>{{patient.id}} </b><br>
                Name:<b>{{patient.name}}</b><br>
                </p>
                <form action="" @submit.prevent="handleSubmit">
                    <div class="form-group">
                        <label for="">Choose Queue</label>
                        <select v-model="refDepartment" class="custom-select" name="" id="">
                            <option :key="dep" v-for="dep in possibleReferrals">{{dep}}</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Refer</button>
                    <button @click.prevent="endVisit" class="btn btn-danger float-right">End Visit</button>

                </form>
            </div>
        </div>


    </div>


</template>

<script>
import { setTimeout } from 'timers';
export default {
    data(){
        return{
            patient:{},
            possibleReferrals:['laboratory','radiology','treatment','optical'],
            refDepartment:'treatment'
        }
    },
    methods:{
        async endVisit(){
            let visitId = this.$route.params.visitId
            let department =this.$route.params.department
            let response = await axios.post('/patientvisit/end',{visitId})
            this.$router.push({name:'depQueue',params:{department}})
            console.log(response.data)
        },
        async handleSubmit(){
            let department =this.$route.params.department
            let response = await axios.post('/queue',{
                id:this.patient.id,
                department:this.refDepartment
            })
            this.$router.push({name:'depQueue',params:{department}})
            console.log(response.data)
        }

    },
    computed:{

    },
    async created(){
        //gets patient data
        let response = await axios.post('/patientvisit/patient',
        {
            id:this.$route.params.visitId
        })
        this.patient = response.data
        console.log(response.data)


    },
    mounted(){

    }


}
</script>

<style>

</style>
