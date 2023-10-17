pipeline {
  agent any

  parameters {
    string(name: 'container_name', defaultValue: 'php-tabantaj', description: 'Nombre del contenedor de dockers.')
    string(name: 'image_name', defaultValue: 'php-tabantaj', description: 'Nombre de la imagene dockers.')
    string(name: 'tag_image', defaultValue: 'stagging', description: 'Tag de la imagen de la página.')
    string(name: 'container_port', defaultValue: '90', description: 'Puerto que usa el contenedor')
  }

  stages {
    stage('install') {
      steps {
        git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
      }
    }

    stage('build') {
      steps {
         script {
          dockerImage = docker.build("php-tabantaj", "./infra/php/")
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
