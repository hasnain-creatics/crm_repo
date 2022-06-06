<template>
    <div>
        <!-- Using value -->
        <b-button v-b-modal="'my-modal'">Show Modal</b-button>

        <!-- The modal -->
        <b-modal id="my-modal">

          
        </b-modal>
    </div>
</template>

<script>
    import { BButton, BModal, VBModal } from "bootstrap-vue";

    export default {
        components: {
            BButton,
            BModal
        },

        directives: { 
            'b-modal': VBModal 
        },
    }
</script>