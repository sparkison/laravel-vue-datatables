<template>

    <dropdown hides-manually>
        <span slot="label"
            class="icon is-small">
            <fa icon="eye"/>
        </span>
        <span v-for="(column, index) in visibleColumns"
            :key="index"
            class="dropdown-item"
            :class="{ 'active': column.meta.visible }"
            @click="column.meta.visible = !column.meta.visible;$emit('update-visibility')">
            {{ $t(column.label) }}
        </span>
    </dropdown>

</template>

<script>

import { library } from '@fortawesome/fontawesome-svg-core';
import { faEye } from '@fortawesome/free-solid-svg-icons';
import Dropdown from './Dropdown.vue';

library.add(faEye);

export default {
    name: 'ColumnVisibility',

    components: { Dropdown },

    props: {
        template: {
            type: Object,
            required: true,
        }
    },

    computed: {
        visibleColumns() {
            return this.template.columns
                .filter(({ meta }) => !meta.rogue);
        },
    },
};

</script>

