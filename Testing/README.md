# Automatización de Pruebas con Selenium y pytest

Este proyecto es una suite de pruebas automatizadas utilizando Selenium y pytest para realizar pruebas en aplicaciones web. La automatización de pruebas se realiza en el entorno de Python 3.11.7 en macOS.

# Requisitos

1. Asegúrate de tener Python 3.11.7 instalado en tu sistema.

# Para instalar las dependencias del proyecto, ejecuta el siguiente comando:

pip install -r requirements.txt

Esto instalará todas las bibliotecas necesarias, incluyendo Selenium, pytest y los plugins específicos mencionados en el archivo requirements.txt.

# Estructura del Proyecto

    /tests: Contiene todos los archivos de prueba escritos con pytest. Puedes organizar tus pruebas en subdirectorios según sea necesario.
    /utils: Aquí puedes almacenar funciones y clases de utilidad para reutilizar en tus pruebas.
    /reports: Este directorio contendrá los informes generados por pytest-html y Allure.

# Ejecución de las Pruebas

2.  Para ejecutar todas las pruebas, simplemente ejecuta el siguiente comando en la raíz del proyecto:

* pytest

3. Puedes ejecutar pruebas en paralelo utilizando pytest-xdist agregando la opción -n seguido del número de procesos que deseas utilizar.


* pytest -n 4  # Ejecutar pruebas en 4 procesos en paralelo

# Generación de Informes

# Informes HTML

4. pytest-html generará informes HTML detallados automáticamente después de cada ejecución de las pruebas. Los informes se almacenarán en el directorio reports/html.

# Informes Allure

5. Si deseas generar informes Allure, asegúrate de tener Allure instalado en tu sistema. Puedes instalarlo siguiendo las instrucciones en Allure Framework. Después de la instalación, puedes generar un informe Allure ejecutando el siguiente comando:


* pytest --alluredir=reports/allure
* allure serve reports/allure

6. Esto generará los informes Allure en el directorio reports/allure y los abrirá en tu navegador web predeterminado.
