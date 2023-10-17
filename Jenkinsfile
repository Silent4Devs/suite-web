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
            docker.build('php-tabantaj:latest')
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
