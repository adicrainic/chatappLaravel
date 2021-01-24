<template>
    <app-layout>
        <form action="#" class="form" @submit.prevent="formSubmit">

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div class="mb-4">
                <label class="block required text-grey-darker text-sm font-bold mb-2" for="name">
                    Enter Room Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="name" type="text" placeholder="Room Name" v-model="name">
                <has-error :form="form" field="name"></has-error>

            <div class="clearfix"></div>
            </div>
            <button type="submit" class="mr-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg float-right"> Create </button>
        </div>
        </form>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'


export default {
    components: {
        AppLayout
    },
    data () {
        return {
                name: ''
        }
    },
    methods : {
        // createRoom () {
        //     axios.post('/chat/newRoom', {
        //         name: this.name
        //     })
        //         .then(( response ) => {
        //
        //             this.$emit('roomcreated');
        //             this.form.reset();
        //
        //         })
        //         .catch( error => {
        //             console.log(error);
        //         })
        // },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            axios.post('/chat/newRoom', {
                name: this.name,
            })
                .then(function (response) {
                    currentObj.output = response.data;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        }
    }
}
</script>

<style scoped>

</style>
