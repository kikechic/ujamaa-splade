import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import "@protonemedia/laravel-splade/dist/style.css";
import FloatingVue from "floating-vue";
import "floating-vue/dist/style.css";
import { createApp, defineAsyncComponent } from "vue/dist/vue.esm-bundler.js";
import "../css/app.css";
import "../css/choices.scss";
import "../css/filepond.scss";
import "../css/flatpickr.styl";
import "./bootstrap";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .use(FloatingVue)
    .component("Timesheet", defineAsyncComponent(() => import("../js/components/Timesheet.vue")))
    .component("Dropdown", defineAsyncComponent(() => import("../js/components/Dropdown.vue")))
    .mount(el);


/* Sidebar - Side navigation menu on mobile/responsive mode */
window.toggleNavbar = function (collapseID) {
    document.querySelector(`#${collapseID}`).classList.toggle("hidden");
    document.querySelector(`#${collapseID}`).classList.toggle("bg-white");
    document.querySelector(`#${collapseID}`).classList.toggle("m-2");
    document.querySelector(`#${collapseID}`).classList.toggle("py-3");
    document.querySelector(`#${collapseID}`).classList.toggle("px-6");
};

/* Opens sidebar navigation that contains sub-items */
window.openSubNav = function (el) {
    el.nextElementSibling.classList.toggle("hidden");
};

window.initialSubNavLoad = function () {
    document
        .querySelectorAll(".has-sub.sidebar-nav-active")
        .forEach(function (el) {
            window.openSubNav(el);
        });
};
