# Mini Project - Dockerized

This project has been dockerized so you can easily run it on any system without manually installing PHP, Apache, or MySQL.

## Prerequisites
- [Docker](https://docs.docker.com/get-docker/) installed.
- [Docker Compose](https://docs.docker.com/compose/install/) installed.

## How to Run

1. Open a terminal and navigate to this `mini project` directory.
2. Run the following command to build and start the application in the background:
   ```bash
   docker-compose up -d --build
   ```
3. Once the database container is healthy and the web container is up, you can access the application in your browser at:
   [http://localhost:8080](http://localhost:8080)

## Stopping the Application
To stop the running containers, run:
```bash
docker-compose down
```

## Database Information
- The database is automatically initialized using `database.sql` the first time you run `docker-compose up`.
- The MySQL container stores its data in a persistent Docker volume, so your data will not be lost when you stop the containers.
