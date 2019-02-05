<template>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button"
                data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <slot name="label"/>
        </button>
        <div class="dropdown-menu"
             :style="[widthStyle, heightStyle]">
            <slot/>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'Dropdown',

        props: {
            height: {
                type: Number,
                default: 16,
            },
            hidesManually: {
                type: Boolean,
                default: false,
            },
            width: {
                type: Number,
                default: 4.5,
            },
        },

        computed: {
            heightStyle() {
                return {
                    'max-height': `${this.height}em`,
                };
            },
            widthStyle() {
                return {
                    'min-width': `${this.width}em`,
                };
            },
        },

    };

</script>

<style lang="scss" scoped>

    .dropdown-item {
        cursor: pointer;
    }

</style>