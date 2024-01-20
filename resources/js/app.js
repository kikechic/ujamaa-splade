import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import "@protonemedia/laravel-splade/dist/style.css";
import FloatingVue from "floating-vue";
import "floating-vue/dist/style.css";
import { createApp, defineAsyncComponent } from "vue/dist/vue.esm-bundler.js";
import "../css/app.css";
import "../css/choices.scss";
// import "../css/filepond.scss";
// import "../css/flatpickr.styl";
import "./bootstrap";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el }),
})
    .use(SpladePlugin, {
        max_keep_alive: 10,
        transform_anchors: false,
        progress_bar: true,
    })
    .use(FloatingVue)
    .component(
        "Timesheet",
        defineAsyncComponent(() => import("../js/components/Timesheet.vue"))
    )
    .component(
        "Dropdown",
        defineAsyncComponent(() => import("../js/components/Dropdown.vue"))
    )
    .mount(el);
