<template>

    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{ selected.name}} Chat
        </div>
            <div>
                <select
                    v-model="selected"
                    @change="$emit('roomchanged', selected)"
                    class="float-right">

                    <option
                        v-for="(room, index) in rooms"
                        :key="index"
                        :value="room"
                    >
                        {{ room.name }}
                    </option>
                </select>
<!--                <a href="/newRoom">-->
                <button @click="onRowClick" class="mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg float-right"> + </button>
<!--                </a>-->

            </div>
        <modal name="create-room" class="rounded flex flex-col">
            <form action="#" class="form" @submit.prevent="formSubmit">

                <div class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="mb-4">
                        <label class="block required text-grey-darker text-sm font-bold mb-2" for="name">
                            Enter Room Name
                        </label>
                        <input class="clearfix shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="name" type="text" placeholder="Room Name" v-model="name">

                    </div>
                    <button type="submit" class="mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg float-right"> Create </button>
                </div>
            </form>
        </modal>
    </div>

</template>

<script>
import Vue from 'vue';
import AppLayout from '@/Layouts/AppLayout';
import VueRouter from 'vue-router';
import Swal from 'sweetalert2';
import VModal from 'vue-js-modal';
Vue.use(VModal);
export default {

    props: ['rooms', 'currentRoom'],
    data: function () {
        return {
            selected: '',
            editMode: false,
            name: ''
        }
    },
    created() {
        this.selected = this.currentRoom;
    },
    methods: {
        onRowClick(params) {
            this.$modal.show('create-room');
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            axios.post('/chat/newRoom', {
                name: this.name
            })
                .then(function (response) {
                    currentObj.output = response.data;
                    if(response.data ) {
                        currentObj.$modal.hide('create-room');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success! ',
                            text: 'Room Created with success !',
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error.response.data.errors.name[0]);
                    currentObj.output = error;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error on creating Room!',
                        text: error.response.data.errors.name[0],
                    })
                });



        }
    }
}
</script>

<style scoped>

</style>
