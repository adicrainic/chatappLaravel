<template>
    <div class="relative h-10 m-1">
        <div style="border-top:1px solid #6E6E6E;" class="grid grid-cols-6">
            <input type="text"
                   v-model="message"
                   @keyup.enter="sendMessage()"
                   placeholder="Say something..."
                   class="col-span-5 outline-none p-1"
                   />
            <button @click="sendMessage()"
                    class="place self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                Send
            </button>
        </div>
    </div>


</template>

<script>
import Button from "@/Jetstream/Button";
export default {
    components: {Button},
    props: ['room'],
    data: function () {
        return {
            message: ''
        }
    },
    methods: {
        sendMessage() {
            if(this.message == ''){
                //or other validations...
                return;
            }

            axios.post('/chat/room/' + this.room.id + '/message', {
                message: this.message
            })
            .then (response => {
                if( response.status = 201 ) {
                    this.message= '';
                    this.$emit('messagesent');
                }
            })
            .catch( error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>

</style>
