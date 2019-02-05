<template>
    <div v-on="$listeners"
         class="modal fade"
         data-keyboard="false" data-backdrop="static"
         tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $t('confirm' || "Confirm") }}
                    </h5>
                </div>
                <div class="modal-body">
                    <p>
                        {{ $t(message || "Are you sure that you want to perform this action?") }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"
                            @click="$emit('close')">
                        {{ $t("cancel") }}
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal"
                            @click="$emit('commit')">
                        {{ $t("yes") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: {
            show: {
                type: Boolean,
                required: true,
            },
            message: {
                type: String,
                default: null,
            },
        },

        mounted() {
            $(this.$el).modal({
                show: true,
                escapeClose: false,
                clickClose: false,
                showClose: false
            })
        }

    };

</script>
