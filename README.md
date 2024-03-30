# Exercise Task - Real-time Stock Price Aggregator

## Getting started

### Prerequisites

-   PHP 8.3
-   Composer
-   Node & NPM
-   [Docker Desktop](https://www.docker.com/products/docker-desktop/)

```bash
cp .env.example .env
composer install
npm install
npm run dev
sail up
sail artisan key:generate
```

To compile assets locally you can use `npm run dev`, which will enable hot reloading.
