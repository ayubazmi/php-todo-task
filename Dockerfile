FROM php:8.0-cli

# Install dependencies for mysqli
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli

# Set the working directory
WORKDIR /app

# Copy the application code into the container
COPY . /app
COPY .env /app/
# Expose the port
EXPOSE 8090

# Command to run the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8090"]
