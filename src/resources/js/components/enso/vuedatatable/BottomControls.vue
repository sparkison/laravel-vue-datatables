<template>

    <div class="row">
        <div class="col">
            <records-info :body="body"
                :start="start"
                :selected="selected"/>
        </div>
        <div class="col text-right">
            <pagination :loading="loading"
                :start="start"
                :length="length"
                :records="body.filtered"
                :extended="body.fullRecordInfo"
                @jump-to="$emit('jump-to', $event)"
                v-if="hasEntries"/>
        </div>
    </div>

</template>

<script>

import RecordsInfo from './RecordsInfo.vue';
import Pagination from './Pagination.vue';

export default {
    name: 'BottomControls',

    components: { RecordsInfo, Pagination },

    props: {
        body: {
            type: Object,
            required: true,
        },
        start: {
            type: Number,
            required: true,
        },
        length: {
            type: Number,
            required: true,
        },
        loading: {
            type: Boolean,
            required: true,
        },
        selected: {
            type: Array,
            required: true,
        },
    },

    computed: {
        hasEntries() {
            return this.body.data.length > 0;
        },
    },
};

</script>
