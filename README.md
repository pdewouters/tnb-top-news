# Top News for WordPress

## Description

Top News for WordPress is a plugin that allows you to display the top news from the NewsAPI service in a block on your website.

## Installation

To install and run this project locally, you will need to have the following installed on your local machine:

- Docker
- Node.js

Steps
- git clone the repo
- cd into the repo
- run `npm install`
- run 'npm run wp-env start' ( This can take a few minutes the first time as it will download the images and build the containers )
- run 'npm start'

## Usage

Once the process is finished, you can visit http://localhost:8888/wp-admin to access the WordPress admin dashboard. You can log in with the username `admin` and the password `password`.

The plugin will already be installed and activated.

Next navigate to Settings > Top News, and enter your API key in the Top News API Key field.

Finally, add the "Top News" block to any page or post to display the top news from the NewsAPI service.

## License

MIT License
