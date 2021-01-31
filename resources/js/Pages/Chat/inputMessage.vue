<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6">
            <input type="text"
                   v-model="message"
                   @keyup.enter="sendMessage()"
                   placeholder="Say something..."
                   class="col-span-5 outline-none p-1"
                   />
            <button @click="sendMessage()"
                    class="mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 w-full rounded-lg">
                Send
            </button>
        </div>
    </div>

</template>

<script>
import Button from "@/Jetstream/Button";
import EmojiPicker from 'vue-emoji-picker';

export default {
    components: {Button,EmojiPicker},
    props: ['room'],
    data: function () {
        return {
            message: '',
            input: '',
            search: '',
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
        },
        insert(emoji) {
            this.input += emoji
        },
    }
}
</script>

<style scoped>

</style>
