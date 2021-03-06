const path = require('path');
const node = require('rollup-plugin-node-resolve');

const builds = {
    'es-dev': {
        format: 'es',
        env: 'development',
        extension: '.esm.js'
    },
    'prod': {
        format: 'es',
        env: 'production',
        extension: '.esm.min.js'
    },
    'cjs-dev': {
        format: 'cjs',
        env: 'development',
        extension: '.cjs.js',
    },
    'cjs-prod': {
        format: 'cjs',
        env: 'production',
        extension: '.cjs.min.js'
    },
    /*
        'umd-noStyle-dev': {
            format: 'umd',
            env: 'development',
            moduleName: 'agGrid',
            banner
        },
        'umd-noStyle-prod': {
            format: 'umd',
            env: 'production',
            moduleName: 'agGrid',
            banner
        }
    */
};

function genConfig(buildName, sourceDirectory, moduleName) {
    const packageJson = require(path.resolve(sourceDirectory, './package.json'));

    const banner = ['/**',
        ` * ${packageJson.name} - ${packageJson.description}` +
        ` * @version v${packageJson.version}`,
        ` * @link ${packageJson.homepage}`,
        `' * @license ${packageJson.license}`,
        ' */',
        ''].join('\n');

    const build = builds[buildName];

    const config = {
        input: path.resolve(sourceDirectory, `./dist/es6/main.js`),
        plugins: [
            node()      // for utils package - defaulting to use index.js
        ].concat(build.plugins || []),
        output: {
            file: path.resolve(sourceDirectory, `./dist/${moduleName}${build.extension}`),
            format: build.format,
            banner,
            name: build.moduleName
        },
        onwarn: (msg, warn) => {
            if (msg.code === 'THIS_IS_UNDEFINED') return;
            if (!/Circular/.test(msg)) {
                warn(msg)
            }
        }
    };

    Object.defineProperty(config, '_name', {
        enumerable: false,
        value: buildName
    });

    return config
}

exports.getAllBuilds = (sourceDirectory, moduleName) => Object.keys(builds).map(buildName => genConfig(buildName, sourceDirectory, moduleName));
