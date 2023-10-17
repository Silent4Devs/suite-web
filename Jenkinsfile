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
         script {
          dockerImage = docker.build("nginx:stable-alpine", "./infra/php/")
        }
      }
    }

    stage('deploy') {
      steps {
        sh 'docker-compose -f docker-compose.yml up -d'
      }
    }
  }

}
