from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.action_chains import ActionChains
from selenium.common.exceptions import ElementNotInteractableException, TimeoutException
import time

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
sistema_gestion_xpath = "//font[@class='letra_blanca'][contains(.,'Sistema de Gestión')]"
determinacion_alcance_xpath="//a[contains(.,'Determinación de alcance')]"
registro_alcance_xpath="//a[contains(.,'Registrar Alcance')]"
nombre_alcance_xpath="//input[contains(@class,'form-control form')]"
alcance_xpath="//input[contains(@name,'alcancesgsi')]"
guardar_alcance_xpath="//button[@onclick='redirigirARuta()'][contains(.,'Guardar y enviar a aprobación')]"
# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = input("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    time.sleep(tiempo_modulos)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//font[@class='letra_blanca'][contains(.,'Mi perfil')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

#Sistema de Gestión
print("Entrando a Sistema de Gestión..")
element = driver.find_element(By.XPATH, sistema_gestion_xpath)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, sistema_gestion_xpath)))
print("Dando clic en Sistema de Gestión...")
element.click()

#Determiniación de alcance
print("Entrando a Determinacion de alcance ...")
determinacion= driver.find_element(By.XPATH, determinacion_alcance_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, determinacion_alcance_xpath)))
print("Dando clic en Determinacion de alcance  ..")
determinacion.click()

#Registrar alcance
print("Entrando a Registrar alcance ...")
registrar= driver.find_element(By.XPATH, registro_alcance_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, registro_alcance_xpath)))
registrar.click()

#ALCANCE
def nombrealcance(driver):
    # Obtener la entrada del usuario desde la terminal
    id_ingresado = input("Ingrese el nombre del alcance :  ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, nombre_alcance_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(id_ingresado)

#Llamando a la función ID
nombrealcance(driver)

def alcance(driver):
    # Obtener la entrada del usuario desde la terminal
    id_ingresado = input("Ingrese el alcance:  ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, alcance_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(id_ingresado)

#Llamando a la función ID
alcance(driver)

def fechapub(driver):
    try:
        # Espera a que el elemento esté presente en el DOM
        elemento_fecha = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.ID, "fecha_publicacion"))
        )

        # Solicita al usuario ingresar la fecha desde la terminal
        nueva_fecha = input("Ingresa la nueva fecha (formato YYYY-MM-DD): ")

        # Limpia cualquier valor existente en el campo de fecha
        elemento_fecha.clear()

        # Ingresa la nueva fecha en el campo
        elemento_fecha.send_keys(nueva_fecha)

        print(f"Fecha '{nueva_fecha}' ingresada con éxito en el campo.")
        return True

    except Exception as e:
        print(f"Error al interactuar con el campo de fecha: {e}")
        return False

# Uso de la función
fechapub(driver)

def fecharev(driver):
    try:
        # Espera a que el elemento esté presente en el DOM
        elemento_fecha = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.ID, "fecha_revision"))
        )

        # Solicita al usuario ingresar la fecha desde la terminal
        nueva_fecha = input("Ingresa la nueva fecha (formato YYYY-MM-DD): ")

        # Limpia cualquier valor existente en el campo de fecha
        elemento_fecha.clear()

        # Ingresa la nueva fecha en el campo
        elemento_fecha.send_keys(nueva_fecha)

        print(f"Fecha '{nueva_fecha}' ingresada con éxito en el campo.")
        return True

    except Exception as e:
        print(f"Error al interactuar con el campo de fecha: {e}")
        return False

# Uso de la función
fecharev(driver)

try:
    # Esperar hasta que el elemento esté presente en el DOM
    guardar = WebDriverWait(driver, 20).until(EC.presence_of_element_located((By.XPATH, guardar_alcance_xpath)))

    # Scroll al elemento
    driver.execute_script("arguments[0].scrollIntoView(true);", guardar)
    time.sleep(tiempo_modulos)

    # Esperar hasta que el elemento sea clickeable
    guardar = WebDriverWait(driver, 20).until(EC.element_to_be_clickable((By.XPATH, guardar_alcance_xpath)))
    time.sleep(tiempo_modulos)
    # Hacer clic en el elemento
    guardar.click()

except TimeoutException:
    print("Timeout: No se pudo encontrar el elemento a tiempo.")
except ElementNotInteractableException as e:
    print(f"Error al interactuar con el elemento: {e}")
except Exception as e:
    print(f"Error inesperado: {e}")

