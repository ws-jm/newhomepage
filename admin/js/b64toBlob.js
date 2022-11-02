(function(root, globalName, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD:
        define([], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node:
        module.exports = factory();
        // Use module export as simulated ES6 default export:
        module.exports.default = module.exports;
    } else {
        // Browser:
        window[globalName] = factory();
    }
}(this, 'b64toBlob', function() {
    'use strict';

    return function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    };
}));