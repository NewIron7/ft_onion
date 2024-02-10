# ft_onion: A Tor Network Web Service via Docker 🌐🔒

## Introduction

ft_onion simplifies the deployment of web services on the Tor network using Docker. Aimed at enhancing privacy and security, this project allows users to easily set up and access a web page through the Tor network with minimal configuration.

## Getting Started

### Prerequisites

- Docker installed on your machine 🐳

### Installation and Usage

1. **Clone the Repository:**
   - `git clone https://github.com/NewIron7/ft_onion`
   - `cd ft_onion`

2. **Environment Setup:**
   - Create a `.env` file based on the `example.env` provided in the repository.

3. **Build and Run with Docker:**
   - Simply run `make` in the project directory. This command will build the Docker image and start the service automatically.
   - To access the web service, run `make logs` to reveal the onion address of your site.

4. **SSH Access:**
   - An SSH port is opened on `4242` for the user specified in the .env file.

## Dockerized Environment

This project is fully containerized, requiring only Docker to run. It includes:
- A Docker image encapsulating the Tor service and web server.
- Automated scripts for easy build and deployment.
