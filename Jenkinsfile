pipeline {
    agent any

    stages {
        stage('Clonar repositorio') {
            steps {
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
        }
        stage('Copiar archivo a rama staging') {
            steps {
                sh 'git checkout stagging' // Cambiar a la rama staging
                sh 'git checkout develop Jenkinsfile' // Copiar el archivo de la rama develop a staging
                sh 'git config --global user.email "saul.ramirez@silent4business.com"' // Establecer el correo electrónico del usuario
                sh 'git config --global user.name "Saul"' // Establecer el nombre del usuario
                sh 'git commit -m "Copiar archivo a staging"' // Realizar commit en la rama staging
                sh 'git push origin stagging' // Subir cambios a la rama staging en el repositorio remoto
            }
        }
    }
}
