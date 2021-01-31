<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Administration
            </h2>
        </template>


        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                    <button @click="createUser()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New User</button>

                    <table class="table-fixed w-full">

                        <thead>

                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">Id</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
<!--                            <th class="px-4 py-2  w-50">Created At</th>-->
<!--                            <th class="px-4 py-2  w-50">Updated At</th>-->
                            <th class="px-4 py-2  w-100"></th>

                        </tr>

                        </thead>

                        <tbody>

                        <tr class="hover:bg-gray-100" v-for="user in users" :key="user.id">
                            <td class="px-4 text-center py-2 w-20">{{ user.id }}</td>
                            <td class="px-4 text-center py-2">{{ user.name }}</td>
                            <td class="px-4 text-center py-2">{{ user.email }}</td>
<!--                            <td class="px-4 py-2 w-50">{{ user.created_at }}</td>-->
<!--                            <td class="px-4 py-2 w-50">{{ user.updated_at }}</td>-->
                            <td class="px-6 py-2 w-100 float-right">
                                <div class="btn-group" role="group">
                                    <router-link :to="{name: 'edit', params: { id: user.id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit
                                    </router-link>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="deleteUser(user.id)">Delete</button>
                                </div>

                            </td>
                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import VueRouter from 'vue-router'

export default {
    components: {
        AppLayout
    },
    data: function () {
        return {
            users: []
        }
    },
    methods: {
        getUsers() {
            axios.get('/users')
                .then( response => {
                    this.users = response.data;
                })
                .catch( error => {
                    console.log(error);
                })
        },
        createUser() {

        },
        deleteUser(id) {
           axios
                .delete(`deleteUser/${id}`)
                .then(response => {
                    let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                    this.posts.splice(i, 1)
                })
                .catch( error => {
                    console.log(error);
                })
        },
    },

    created() {
        this.getUsers();
    }
}
</script>
