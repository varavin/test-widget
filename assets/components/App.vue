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
        fetch('https://test-widget.local/api/widget_data').then((response) => {
          console.log(response)



        })
    }
});
</script>