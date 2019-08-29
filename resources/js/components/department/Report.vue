<template>
    <div class="col-9">
        <div class="card">
            <div class="card-header">Search Patient</div>
            <div class="card-body">
                <div class="form-group">
                  <label for="">Search For Patient</label>
                  <input type="text" v-model="searchQuery" @keyup="searchPatient" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Patient Name">

                </div>
            </div>
        </div>
        <div  v-if="noResults" class="card mt-4">
            <div class="card-body">
               <p class="text-danger">No results found for <b>{{searchQuery}}</b></p>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Patients Visits</div>
            <div class="card-body">

                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Patient Seen</th>
                            <th>Department</th>
                            <th>Date and Time</th>
                            <th>Medical Practitioner</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="visit in visits" :key="visit.id">
                                <td>{{visit.patient}}</td>
                                <td>{{visit.department}}</td>
                                <td>{{visit.time}}</td>
                                <td>{{visit.practitioner}}</td>

                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>



</template>

<script>
export default {


    data(){
        return{
            searchQuery:'',
            visits:[],
            refDepartment:'treatment',
            noResults:false
        }
    },
    methods:{
        viewReport(id){
           this.$router.push({name:"report",params:{visitId:id}})
        },
        async searchPatient(){
            let {searchQuery} = this
            let response = await axios.post('/patientVisitTransaction/search',{
                        searchQuery
            })
            this.visits=response.data
            this.visits.length==0? this.noResults =true: this.noResults =false


        }
    },




}
</script>

<style>

</style>
