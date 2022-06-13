<template>
    <div
        v-html="require('!!html-loader!@img/' + this.image + '.svg').default"
        v-once
    ></div>
</template>

<script>
export default {
    props: ["image"],

    mounted() {
        this.$el.firstChild.removeAttribute("width");
        this.$el.firstChild.removeAttribute("height");

        // Reassign class list and remove the div wrapper
        this.$el.firstChild.classList.add(...this.$el.className.split(" "));
        this.$el.outerHTML = this.$el.innerHTML;
    },
};
</script>
