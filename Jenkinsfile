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

    stage('Desplegar en Producción') {
            steps {
                sh 'ssh desarrollo@192.168.9.78 "cd /var/contenedor/tabantaj && git pull"'
            }
    }

//     stage('build') {
//       steps {
//         dir('tabantaj') {
//           script {
//             try {
//               sh 'docker stop ${container_name}'
//               sh 'docker rm ${container_name}'
//               sh 'docker rmi ${image_name}:${tag_image}'
//             } catch (Exception e) {
//               echo 'Exception occurred: ' + e.toString()
//             }
//           }
//           sh 'docker build -t ${image_name}:${tag_image} .'
//         }
//       }
//     }

//     stage('deploy') {
//       steps {
//         sh 'docker run -d -p ${container_port}:80 --name ${container_name} ${image_name}:${tag_image}'
//       }
//     }
//   }

}
