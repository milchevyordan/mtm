import typescriptEslint from "@typescript-eslint/eslint-plugin";
import vue from "eslint-plugin-vue";
import _import from "eslint-plugin-import";
import { fixupPluginRules } from "@eslint/compat";
import parser from "vue-eslint-parser";
import path from "node:path";
import { fileURLToPath } from "node:url";
import js from "@eslint/js";
import { FlatCompat } from "@eslint/eslintrc";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const compat = new FlatCompat({
    baseDirectory: __dirname,
    recommendedConfig: js.configs.recommended,
    allConfig: js.configs.all
});

export default [
    ...compat.extends("plugin:@typescript-eslint/recommended", "plugin:vue/recommended").map(config => ({
        ...config,
        files: ["resources/js/**/*.vue"],
    })),
    {
        files: ["resources/js/**/*.vue"],

        plugins: {
            "@typescript-eslint": typescriptEslint,
            vue,
            import: fixupPluginRules(_import),
        },

        languageOptions: {
            parser: parser,
            ecmaVersion: 5,
            sourceType: "script",

            parserOptions: {
                parser: "@typescript-eslint/parser",
            },
        },

        rules: {
            "vue/html-indent": ["error", 4],

            "vue/script-indent": ["error", 4, {
                baseIndent: 0,
                switchCase: 1,
            }],

            "vue/order-in-components": ["error", {
                order: [
                    "el",
                    "name",
                    "parent",
                    "functional",
                    ["delimiters", "comments"],
                    ["components", "directives", "filters"],
                    "extends",
                    "mixins",
                    "inheritAttrs",
                    "model",
                    ["props", "propsData"],
                    "fetch",
                    "asyncData",
                    "data",
                    "computed",
                    "watch",
                    "LIFECYCLE_HOOKS",
                    "methods",
                    "head",
                    ["template", "render"],
                    "renderError",
                ],
            }],

            "import/order": ["error", {
                groups: [["builtin", "external"], "internal", ["parent", "sibling", "index"]],
                "newlines-between": "always",

                alphabetize: {
                    order: "asc",
                    caseInsensitive: true,
                },
            }],

            "vue/multi-word-component-names": "off",
            "vue/no-multiple-template-root": "off",
            "vue/no-mutating-props": "off",
            "@typescript-eslint/no-explicit-any": "off",
            "vue/no-unused-vars": "off",
            "vue/valid-v-slot": "off",
            "vue/require-default-prop": "off",
        },
    },
];