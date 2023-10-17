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
         sh 'docker-compose exec php composer install --ignore-platform-reqs --no-dotenv'
         sh 'docker-compose exec php php artisan key:generate'
         sh 'docker-compose exec php php artisan migrate'
         sh 'docker-compose exec php chmod 777 -R storage'
         sh 'docker-compose exec php php artisan optimize:clear'
      }
    }

    stage('deploy') {
       steps {
        sh 'docker-compose build'
        sh 'docker-compose up -d'
        sh 'docker-compose -f docker-compose.staging.yml up -d'
      }
    }
  }

}
