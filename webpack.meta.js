/**
 * Define configuration
 * @param {Object} env
 * @param {Object} argv
 * @returns {Object}
 * @see https://webpack.js.org/configuration/configuration-types/
 */
export const config = {
    /**
     * entry: Relative to src directory - Entrypoint file
     * versionFile: Relative to entry directory - File to get version from
     * @type {Object}
     */
    entrypoints: {
        // app: `./js/app.js`,
        app_ts: `./ts/app.ts`,
        print: `./scss/print.scss`,
        breakpoints: `./scss/breakpoints.scss`,
        print: `./scss/print.scss`,
        breakpoints: `./scss/breakpoints.scss`,
    },

    /**
     * Add additional entrypoints in development mode
     * @type {Object}
     */
    entrypointsDev: {
        debug: './ts/debug.ts',
    },

    /**
     * Define library name
     * can b e overwritten by --lib FooBar
     * leave empty to disable
     * @type {string}
     */
    library: '',

    /**
     * Define functions to keep unchanged in terser plugin
     * @type {Array}
     */
    reserveFunctions: [],

    /**
     * Define functions to remove in terser plugin
     * @type {Array}
     */
    removeFunctions: [],

    /**
     * Define console methods to remove
     * @type {Array}
     */
    removeConsoleMethods: [
        'assert',
        'clear',
        'count',
        'countReset',
        'debug',
        'dir',
        'dirxml',
        // "error",
        'group',
        'groupCollapsed',
        'groupEnd',
        'info',
        'log',
        'profile',
        'profileEnd',
        'table',
        'time',
        'timeEnd',
        'timeLog',
        'timeStamp',
        'trace',
        'warn',
    ],

    /**
     * Define source directory
     * @type {string}
     */
    sourceDir: 'src',

    /**
     * Define directory with static files
     * @type {string}
     */
    staticDir: 'static',

    /**
     * Define output directory
     * @type {string}
     */
    outputDir: 'assets',
};
