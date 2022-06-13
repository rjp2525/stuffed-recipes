import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { Head, Link } from "@inertiajs/inertia-vue3";
import route from "ziggy-js";

const Ziggy = await fetch("/api/v1/routes").then((res) => res.json());

window.route = route;
window.Ziggy = Ziggy;

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({
                methods: {
                    route: (name, params, absolute) =>
                        route(name, params, absolute, Ziggy),
                },
            })
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#F06543" });
