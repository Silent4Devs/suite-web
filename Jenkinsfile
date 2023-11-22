pipeline {
  agent any
  parameters {
    string(name: 'container_name', defaultValue: 'nginx-tabantaj', description: 'Nombre del contenedor de docker.')
    string(name: 'image_name', defaultValue: 'nginx-tabantaj', description: 'Nombre de la imagene docker.')
    string(name: 'tag_image', defaultValue: 'lts', description: 'Tag de la imagen de la página.')
    string(name: 'container_port', defaultValue: '80', description: 'Puerto que usa el contenedor')
  }

  stages {
    stage('install') {
      steps {
        git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
      }
    }

    stage('test') {
      steps {
      }
    }

    stage('build') {
      steps {
        dir('docker-compose.yml') {
          script {
            try {
              sh 'docker-compose down'
              sh 'docker rmi ${image_name}:${tag_image}'
            } catch (Exception e) {
              echo 'Exception occurred: ' + e.toString()
            }
          }
          sh 'npm run build'
          writeFile file: 'docker-compose.yml', text: """
            version: '3'
            services:
              ${container_name}:
                image: ${image_name}:${tag_image}
                ports:
                  - "${container_port}:80"
          """
          sh 'docker-compose up -d'
        }
      }
    }
  }
}
