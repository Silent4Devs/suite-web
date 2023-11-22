pipeline {
  agent any
  stages {

    stage('install') {
      steps {
        git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
      }
    }


     stage('build') {
      steps {
        script{
          try {
                sh 'docker-compose exec php cp .env.example .env'
                sh 'docker-compose exec php composer install --ignore-platform-reqs'
                sh 'docker-compose exec php php artisan key:generate'
                sh 'docker-compose exec php php artisan migrate'
                sh 'docker-compose exec php chmod 777 -R storage'
                sh 'docker-compose exec php php artisan optimize:clear'
            } catch (Exception e) {
              echo 'Exception occurred: ' + e.toString()
            }
        }
      }
    }

     stage('Deploy via SSH') {
       steps {
                // Despliegar el código a través de SSH en otra rama

                // Instalar paquete ssh en Jenkins
                sh 'apt-get install -y ssh'


                // sh 'scp -r ./* desarrollo@192.168.9.78:/var/contenedor/tabantaj'

                // Cambiar a la rama de destino
                sh 'ssh desarrollo@192.168.9.78 "cd /var/contenedor/tabantaj && git checkout stagging && git pull origin stagging"'
            }
     }


     }
}

