<template>
    <div class="col-9">
        <div class="card">
            <div class="card-header">Enter Notes</div>
            <div class="card-body">
                <p>Patients Details<br>
                ID :<b>{{patient.id}} </b><br>
                Name:<b>{{patient.name}}</b><br>
                </p>
                <form action="" @submit.prevent="handleSubmit">
                    <div class="form-group">
                      <label for="">Enter Notes</label>
                      <textarea class="form-control" v-model="notes" name="" id="" rows="10"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
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
            notes:''
        }
    },
    methods:{
        async handleSubmit(){
            let visitId = this.$route.params.visitId
            let department = this.$route.params.department
            let response = await axios.post('/patientVisitTransaction/create',
            {visitId,
             notes:this.notes,
             department
            })
            this.$router.push({name:'DepReferral',params:{department,visitId}})
            console.log(response.data)
        }

    },
    computed:{

    },
    async created(){
        let response = await axios.post('/patientvisit/patient',
        {id:this.$route.params.visitId})
        this.patient = response.data
        console.log(response.data)


    },
    mounted(){

    }


}
</script>

<style>

</style>
