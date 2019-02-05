<template>

    <div class="records-info has-text-centered-touch">
        {{ chunkInfo }}
        <span v-if="body.filters">
            {{ fromInfo }}
        </span>
        <span v-if="hasSelected">
            {{ selectedInfo }}
        </span>
    </div>

</template>

<script>

export default {
    name: 'RecordsInfo',

    props: {
        start: {
            type: Number,
            required: true,
        },
        body: {
            type: Object,
            required: true,
        },
        selected: {
            type: Array,
            required: true,
        },
    },

    computed: {
        hasRecords() {
            return this.body.data.length > 0;
        },
        hasSelected() {
            return this.selected.length > 0;
        },
        startInfo() {
            return this.hasRecords
                ? this.start + 1
                : 0;
        },
        filteredInfo() {
            return this.body.filters
                ? `${this.$t('of')} ${this.body.fullRecordInfo ? this.body.filtered : '...'} \
                 ${this.$t('entries')}`
                : `${this.$t('of')} ${this.body.count} ${this.$t('entries')}`;
        },
        selectedInfo() {
            return this.hasSelected
                ? `(${this.selected.length} ${this.$t('selected')})`
                : ``;
        },
        chunkInfo() {
            return this.hasRecords
                ? `${this.$t('from')} ${this.startInfo} ${this.$t('to')} \
                ${this.start + this.body.data.length} \
                ${this.filteredInfo}`
                : this.$t('no_records_found');
        },
        fromInfo() {
            return `(${this.$t('filtered_from')} ${this.body.count} ${this.$t('total_records')})`;
        },
    },
};

</script>

<style lang="scss" scoped>

    .records-info {
        font-size: 0.9em;
        padding: 1em;
    }

</style>
