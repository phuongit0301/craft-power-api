#!/bin/node
'use strict';
function bright(str) {
    return "\u001B[1m" + str + "\u001B[0m";
}
function yellow(str) {
    return "\u001B[33m" + str + "\u001B[0m";
}
process.stderr.write("\n  " + bright(yellow('WARNING!')) + "\n\n  " + bright('graphql-language-service') + " command line interface has been moved to\n\n  " + bright('graphql-language-service-cli') + "\n\n  as of version 3.0.0\n\n  \n  " + bright('Re-Installation:') + "\n\n  yarn:\n    " + bright('yarn global remove graphql-language-service') + "\n    " + bright('yarn global add graphql-language-service-cli') + "\n\n  npm:\n    " + bright('npm uninstall -g graphql-language-service') + "\n    " + bright('npm i -g graphql-language-service-cli') + "\n\n\n  " + bright('New Binary Path:') + "\n\n  the executable will now be available as " + bright('graphql-lsp') + " instead of " + bright('graphql') + "\n\n");
//# sourceMappingURL=temp-bin.js.map