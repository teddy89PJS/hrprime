import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import html from '@rollup/plugin-html';
import glob from 'glob'; // ✅ Works with glob@7 (CommonJS)

// Helper: Get files from a directory using glob.sync
function GetFilesArray(query) {
  return glob.sync(query);
}

// JS Files
const pageJsFiles = GetFilesArray('resources/assets/js/*.js');
const vendorJsFiles = GetFilesArray('resources/assets/vendor/js/*.js');
const libsJsFiles = GetFilesArray('resources/assets/vendor/libs/**/*.js');

// SCSS & CSS Files
const coreScssFiles = GetFilesArray('resources/assets/vendor/scss/**/!(_)*.scss');
const libsScssFiles = GetFilesArray('resources/assets/vendor/libs/**/!(_)*.scss');
const libsCssFiles = GetFilesArray('resources/assets/vendor/libs/**/*.css');
const fontsScssFiles = GetFilesArray('resources/assets/vendor/fonts/**/!(_)*.scss');

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/assets/css/demo.css',
        'resources/js/app.js',
        ...pageJsFiles,
        ...vendorJsFiles,
        ...libsJsFiles,
        ...coreScssFiles,
        ...libsScssFiles,
        ...libsCssFiles,
        ...fontsScssFiles
      ],
      refresh: true
    }),
    html()
  ]
});
