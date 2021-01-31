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
                <a href="/newRoom">
                <button class="mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg float-right"> + </button>
                </a>
            </div>
    </div>

</template>

<script>

export default {

    props: ['rooms', 'currentRoom'],
    data: function () {
        return {
            selected: ''
        }
    },
    created() {
        this.selected = this.currentRoom;
    }
}
</script>

<style scoped>

</style>
