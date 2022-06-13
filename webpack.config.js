const path = require("path");

module.exports = {
    resolve: {
        alias: {
            "@": path.resolve("resources/js"),
            "@img": path.resolve(__dirname, "resources/img"),
            "@svg": path.resolve(__dirname, "resources/svg"),
        },
    },

    experiments: {
        topLevelAwait: true,
    },
};
