<template>
    <div class="mt-6 overflow-visible">
        <img :title="`${message.user.name}`"  class="h-8 w-8 rounded-full object-cover float-left" :src="`http://localhost:8080/storage/${message.user.profile_photo_path}`
" />
        <div class="ml-2 px-5 ml-2 max-w-5xl rounded py-1 px-1 bg-blue-300 bg-opacity-50 float-left break-normal md:break-all float-right">{{message.message}}</div>
    </div>

</template>

<script>
export default {
    props: ['message'],
    data: function () {
        return {
            profile_photo: ''
        }
    },
}
</script>

<style scoped>

</style>
