pipeline {
    agent any
    stages {
        stage('Clone Repository') {
            steps {
                withCredentials([string(credentialsId: 'github-token', variable: 'GITHUB_TOKEN')]) {
                    sh 'git clone -b develop_Onpremise https://github.com/Silent4Devs/suite-web.git'
                }
            }
        }
        stage('Deploy via SSH') {
            steps {
                script {
                    sh """
                    sshpass -p 'S3cur3.qa' scp -o StrictHostKeyChecking=no -r suite-web/* desarrollo@192.168.9.78:/var/contenedor/suite-web
                    """
                }
            }
        }
    }
}
