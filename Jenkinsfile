pipeline {
  agent any

  parameters {
    string(name: 'container_name', defaultValue: 'nginx-tabantaj', description: 'Nombre del contenedor de dockers.')
    string(name: 'image_name', defaultValue: 'nginx:stable-alpine', description: 'Nombre de la imagene dockers.')
    string(name: 'tag_image', defaultValue: 'stagging', description: 'Tag de la imagen de la página.')
    string(name: 'container_port', defaultValue: '80', description: 'Puerto que usa el contenedor')
  }

  stages {
    stage('install') {
      steps {
        git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
      }
    }

    //build
    stage('build') {
      steps {
        dir('tabantaj') {
          script {
            try {
              sh '/usr/bin/docker stop ${container_name}'
              sh '/usr/bin/docker rm ${container_name}'
              sh '/usr/bin/docker rmi ${image_name}:${tag_image}'
            } catch (Exception e) {
              echo 'Exception occurred: ' + e.toString()
            }
          }
          sh '/usr/bin/docker build -t ${image_name}:${tag_image} .'
        }
      }
    }

    stage('deploy') {
      steps {
        sh '/usr/bin/docker run -d -p ${container_port}:80 --name ${container_name} ${image_name}:${tag_image}'
      }
    }
  }

}
