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
                // sh 'docker-compose build'
                sh 'docker-compose up -d'
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

  stage('test') {
      steps {
        script{
          try {
                // sh 'docker-compose test'
                sh 'docker-compose up -d'
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

    stage('Deploy to QA') {
            steps {
                script {
                    // Replace 'qa-server-ip' with the actual IP address of your QA server
                    def qaServerIP = '192.168.9.78'
                    // Replace 'qa-ssh-user' with the SSH user for your QA server
                    def qaSSHUser = 'desarrollo'
                    // Define your QA server directory
                    def qaDirectory = '/path/to/qa/directory'
                    // Define the local path to your built application
                    def localAppPath = 'target/your-app.jar'
                    // Use the sshagent step to securely transfer the application using SCP
                    sshagent(['your-ssh-credentials-id']) {
                        sh "scp -r ${localAppPath} ${qaSSHUser}@${qaServerIP}:${qaDirectory}/"
                    }
                    echo 'Application deployed to QA server.'

                }

            }

        }


  }

  }

