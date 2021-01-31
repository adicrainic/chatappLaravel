<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col-reverse overflow-scroll  bg-blue-100">
            <div v-for="(message, index) in messages" :key="index">
                <message-item :message="message" />
            </div>
        </div>
    </div>
</template>

<script>
import MessageItem from "@/Pages/Chat/messageItem";
import EmojiPicker from 'vue-emoji-picker';
export default {
    components: {MessageItem,
        EmojiPicker
    },
    props: ['messages']
}
</script>


