<template>
    <div>
        zxczzzzzz
        {{ count }}
    </div>
</template>
<script lang="ts">
import {defineComponent} from "vue";
export default defineComponent({
    setup() {
        const count = 'test' as string
        return {
            count
        }
    },
    created() {
        fetch('').then(() => {})
    }
});
</script>