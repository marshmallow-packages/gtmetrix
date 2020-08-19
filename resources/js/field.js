Nova.booting(Vue => {
    Vue.component('index-marshmallow-gtmetrix-field', require('./components/IndexField'));
    Vue.component('detail-marshmallow-gtmetrix-field', require('./components/DetailField'));
    Vue.component('form-marshmallow-gtmetrix-field', require('./components/FormField'));
});
