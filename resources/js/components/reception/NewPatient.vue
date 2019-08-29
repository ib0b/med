<template>

    <div class="col-9">
        <div class="card">
            <div class="card-header">Add New Patient</div>
            <div class="card-body">
                <form action="" @submit.prevent="addNew">
                    <div class="form-group">
                      <label for="">Patient Name</label>
                      <input type="text" v-model="patientName" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="card mt-4" v-if="showSuccess">
            <div class="card-header">Success</div>
            <div class="card-body">

                <p class="text-success"> Added Patient</p>
                <p class="">
                    Patient ID: {{patientData.id}}<br>
                    Name :{{patientData.name}}
                </p>

            </div>
        </div>
    </div>












</template>

<script>

export default {

    data(){
        return{
          showSuccess:false,
          patientName:'',
          patientData:{}
        }
    },
    methods:{
        async addNew(){
            let response = await axios.post('/patient',{
                name:this.patientName
            })
            console.log(response)
            this.patientData = response.data
            this.showSuccess=true
        }
    }
}
</script>

<style>

</style>
