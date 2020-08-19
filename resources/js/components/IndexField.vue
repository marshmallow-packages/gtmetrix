<template>
    <div v-if="field.value" class="py-3 tags-index-field">
        <div v-if="field.value.pagespeed_score >= field.perfect.pagespeed_score && field.value.yslow_score >= field.perfect.yslow_score">
            <span class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold bg-success-light text-success-dark underline-none">
                Perfect score :)
            </span>
        </div>
        <div v-else>
            <a v-bind:href="field.value.report_url" target="_blank" class="underline-none">
                <div class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold metrix-badge"
                      v-bind:class="badgeColor('pagespeed_score')">
                    Pagespeed: {{field.value.pagespeed_score}}
                </div>
                <div class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold metrix-badge"
                      v-bind:class="badgeColor('yslow_score')">
                    Yslow: {{field.value.yslow_score}}
                </div>
            </a>
        </div>

    </div>
    <div v-else>
        <span class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold">
            n/a
        </span>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: ['field'],

    methods: {
        badgeColor(score_name) {

            let value = this.field.value[score_name]
            let badges = this.field.badges

            if (value >= badges.success) {
                return 'bg-success-light text-success-dark';
            } else if (value >= badges.warning){
                return 'bg-warning-light text-warning-dark';
            }

            return 'bg-danger-light text-danger-dark';
        }
    }
};
</script>
<style>
.underline-none {
    text-decoration: none !important;
}
.metrix-badge {
    display: inline-block;
}
</style>
