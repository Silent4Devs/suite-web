FROM mcuadros/ofelia:latest

# Copy the Ofelia configuration file to the container
COPY ./infra/ofelia/run_queues_worker.sh run_queues_worker.sh

# Set execution permissions for the configuration file
RUN chmod +r run_queues_worker.sh
