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
                            <th class="px-4 py-2">Role</th>
<!--                            <th class="px-4 py-2  w-50">Created At</th>-->
<!--                            <th class="px-4 py-2  w-50">Updated At</th>-->
                            <th class="px-4 py-2  w-100"></th>

                        </tr>

                        </thead>

                        <tbody>

                        <tr class="hover:bg-blue-100 bg-opacity-50" v-for="user in users" :key="user.id">
                            <td class="px-4 text-center py-2 w-20">{{ user.id }}</td>
                            <td class="px-4 text-center py-2">{{ user.name }}</td>
                            <td class="px-4 text-center py-2">{{ user.email }}</td>
                            <td class="px-4 text-center py-2">{{ user.role }}</td>
<!--                            <td class="px-4 py-2 w-50">{{ user.created_at }}</td>-->
<!--                            <td class="px-4 py-2 w-50">{{ user.updated_at }}</td>-->
                            <td class="px-6 py-2 w-100 float-right">
                                <div class="btn-group" role="group">
<!--                                    <router-link :to="{name: 'edit', params: { id: user.id }}" class="text-white font-bold py-2 px-4 rounded w-16 h-16 red">-->
                                    <button class="text-white font-bold py-2 px-4 rounded w-16 h-16 red" @click="editUser(user.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#0288d1">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-white font-bold py-2 px-4 rounded w-16 h-16 red" @click="deleteUser(user.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

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
                    Swal.fire(
                        'Deleted!',
                        'User deleted successfully',
                        'success'
                    )
                })
                .catch( error => {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                })
        },
    },

    created() {
        this.getUsers();
    }
}
</script>
