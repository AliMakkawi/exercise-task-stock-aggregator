# Exercise Task - Real-time Stock Price Aggregator

## Introduction 
This project implements a real-time stock price aggregator API.
It utilizes domain-driven design principles to manage business logic effectively.
Laravel Sanctum is employed for token management, allowing API users to authenticate securely. 
Redis is used for caching and storing real-time data.
Laravel Sail streamlines Docker-based development, enabling easy deployment and testing.
Laravel Pint is used to ensure coding standards are met, automatically formatting the code to maintain consistency and readability.
Additionally, Larastan is used with level 5 for static analysis, ensuring code quality and correctness.

## Getting started

### Prerequisites

-   PHP 8.3
-   Composer
-   [Docker Desktop](https://www.docker.com/products/docker-desktop/)
-   [Alpha Vantage API Key](https://www.alphavantage.co/support/#api-key)

```bash
cp .env.example .env
composer install
sail up
sail artisan key:generate
sail artisan migrate
sail artisan schedule:work
```

## Routes

### User Management

#### Create User

- **Endpoint**: `POST /users`
- **Description**: Creates a new user and returns an API token.

### Stock Market Info

#### List All Stocks

- **Endpoint**: `GET /stocks`
- **Description**: Retrieves a list of all available stocks.
- **Parameters**: None.


#### Query Stocks

- **Endpoint**: `GET /stocks/query`
- **Description**: Retrieves prices and percentage changes for all stocks.
- **Parameters**: None.

<!-- Blank line -->

- **Endpoint**: `GET /stocks/query?symbol={symbol}`
- **Description**: Retrieves prices and percentage changes for the specified stock.
- **Parameters**: `symbol` - The symbol of the stock.

#### Current Stock Information

- **Endpoint**: `GET /stocks/current?symbol={symbol}`
- **Description**: Retrieves the current price and percentage change for the specified stock.
- **Parameters**: `symbol` - The symbol of the stock.



