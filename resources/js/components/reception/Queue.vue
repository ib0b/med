<template>
    <div class="col-9">
        <div class="card">
            <div class="card-header">Queue Patient</div>

            <div class="card-body">
                <div class="form-group">
                  <label for="">Search For Patient</label>
                  <input type="text" v-model="searchQuery" @keyup="searchPatient" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Patient Name">

                </div>
            </div>
        </div>
        <div :key="patient.id" v-for="patient in results" class="card mt-4">
            <div class="card-body">
                <p>
                    Patient ID : <b>{{patient.id}}</b><br>
                    Patient Name:<b>{{patient.name}}</b>
                </p>

                <div class="form-group">
                    <label for="">Choose Queue</label>
                    <select v-model="refDepartment" class="custom-select" name="" id="">
                        <option :key="dep" v-for="dep in possibleReferrals">{{dep}}</option>
                    </select>
                </div>
                <button @click="addToQueue(patient.id)" class="btn btn-primary">Add To Queue</button>

            </div>
        </div>
        <div v-if="searchQuery!='' &&results.length==0" class="card mt-4">
            <div class="card-header">Results </div>

            <div class="card-body">
                <p>No results found</p>
            </div>
        </div>
        <Modal>
            <p  class="text-success" slot="body">{{successMessage}}</p>
        </Modal>
    </div>



</template>

<script>
import Modal from './Modal'
export default {


    data(){
        return{
            searchQuery:'',
            results:[],
            possibleReferrals:['nursing','laboratory','radiology','treatment','optical'],
            refDepartment:'treatment',
            successMessage:''
        }
    },components:{
        Modal
    },
    methods:{
        async searchPatient(){
            let response = await axios.post('/patient/search',{
                name:this.searchQuery
            })
            this.results=response.data
            console.log(response)
        },
        async addToQueue(id){

            let response = await axios.post('/queue',{
                id,
                department:this.refDepartment
            })
            console.log(response)
            this.successMessage = "Added Patient to queue successfully"
            $('#successModal').modal('show')
        }
    }



}
</script>

<style>

</style>
