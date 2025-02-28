// resources/js/utils/assetHelper.js
export function getAssetUrl(path) {
    return new URL(`@assets/${path}`, import.meta.url).href
}
