<template>

    <div class="top-controls has-background-light">
        <div class="row d-block d-md-flex d-lg-flex flex-row align-items-center justify-content-between">

            <div class="col text-center text-md-left text-lg-left table-controls">
                <div class="btn-group mr-2" role="group">
                    <length-menu :template="template" class="mr-2"
                                 :length="length"
                                 v-on="$listeners"
                    />
                    <column-visibility
                            :template="template"
                            v-on="$listeners"
                    />
                </div>
                <div class="btn-group" role="group">
                    <button class="btn" type="button"
                            @click="$emit('reload')">
                        <span class="icon is-small">
                            <fa icon="sync"/>
                        </span>
                    </button>
                    <button class="btn" type="button"
                            @click="$emit('reset')">
                        <span class="icon is-small">
                            <fa icon="undo"/>
                        </span>
                    </button>
                </div>
                <div>
                    <button class="button"
                            @click="$emit('request-full-info')"
                            v-if="info">
                        <span class="icon is-small has-text-info">
                            <fa icon="info-circle"/>
                        </span>
                    </button>
                </div>
            </div>

            <div class="col p-sm-2 mb-0 pb-0" v-if="template.searchable">
                <div class="search-wrapper">
                    <input class="form-control has-text-centered search-input"
                           type="text"
                           :value="value"
                           @input="$emit('input', $event.target.value)"
                           :placeholder="$t('search')">
                    <fa icon="search" class="search-prepend"/>
                </div>
            </div>

            <div class="col text-center text-md-right text-lg-right table-buttons">
                <button class="btn ml-sm-1"
                    v-for="button in template.buttons.global"
                    :class="button.class"
                    :key="button.label"
                    :href="button.action === 'href' ? button.path : null"
                    @click="button.confirmation ? showModal(button) : doAction(button)">
                    <span class="d-none d-md-inline-block d-lg-inline-block">
                        {{ $t(button.label) }}
                    </span>
                    <span class="icon is-small">
                        <fa :icon="button.icon"/>
                    </span>
                    <span class="d-none d-md-inline-block d-lg-inline-block"/>
                </button>
            </div>

        </div>
        <modal v-if="modal"
            :show="modal"
            :message="button.message"
            @close="closeModal()"
            @commit="doAction(button)"/>
    </div>

</template>

<script>

import { library } from '@fortawesome/fontawesome-svg-core';
import { faSync, faUndo, faSearch, faInfoCircle } from '@fortawesome/free-solid-svg-icons';
import LengthMenu from './topControls/LengthMenu.vue';
import ColumnVisibility from './topControls/ColumnVisibility.vue';
import Modal from './Modal.vue';

library.add(faSync, faUndo, faSearch, faInfoCircle);

export default {
    name: 'TopControls',

    components: {
        LengthMenu, ColumnVisibility, Modal,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
        length: {
            type: Number,
            required: true,
        },
        value: {
            type: String,
            required: true,
        },
        info: {
            type: Boolean,
            required: true,
        },
        loading: {
            type: Boolean,
            required: true,
        },
    },

    data() {
        return {
            lengthMenu: false,
            columnVisibility: false,
            modal: false,
            button: null,
        };
    },

    methods: {
        showModal(button) {
            this.button = button;
            this.modal = true;
        },
        closeModal() {
            this.modal = false;
            this.button = null;
        },
        doAction(button) {
            if (this.modal) {
                this.closeModal();
            }

            if (button.event) {
                this.$emit(button.event);
            }

            if (button.action === 'export') {
                this.$emit('export-data', button.path);
                return;
            }

            if (button.action === 'router') {
                this.$router.push({ name: button.route });
                return;
            }

            if (button.action === 'ajax') {
                this.$emit('action', button.method, button.path, button.postEvent);
            }
        },
    },
};

</script>

<style lang="scss" scoped>

    .top-controls {

        .search-wrapper {
            position: relative;
            .search-input {
                border-radius: 25px;
                padding: 0.75rem 0.75rem 0.75rem 2rem;
                height: calc(2.5rem + 2px);
            }
            .search-prepend {
                position: absolute;
                top: 14px;
                left: 10px;
                fill: #e6e6e6;
                color: #e6e6e6;
            }
        }


        .control.has-icons-right .icon.clear-button {
            pointer-events: all;
        }
    }

</style>
