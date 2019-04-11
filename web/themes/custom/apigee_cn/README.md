# Installation

`apigee_cn` theme uses [Webpack](https://webpack.js.org) to compile and bundle SASS and JS.

#### Step 1
Make sure you have Node and npm installed (Node v11.11.0 and NPM 6.9.0 are compatible with this setup).
You can read a guide on how to install node here: https://docs.npmjs.com/getting-started/installing-node

#### Step 2
Go to the root of `apigee_cn` theme and run the following commands: `npm install`.

#### Step 3
Update `proxy` in **webpack.mix.json** to point to the url of your local copy of the website.

#### Step 4
Run the following command to compile Sass and watch for changes: `npm run watch`.
