from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import getpass
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support.ui import Select

# Configuración de tiempos
tiempo_modulos = 4
tiempo_carga = 10
tiempo_carga_timesheet = 35
tiempo_espera = 2.7

# Inicialización de identificadores
identificador = 1
identificador_proyecto = 1
identificador_tarea = 1

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5

timesheet_xpath = "//i[@class='material-symbols-outlined' and text()='date_range']"
guardar_xpath = "//button[@class='btn btn-success' and contains(text(),'Guardar')]"
registrar_timesheet_xpath="//a[contains(.,'Registrar TimeSheet')]"
eliminar_icono_xpath="(//i[@class='fa-solid fa-trash-can'])[1]"
registrar="//a[@href='https://192.168.9.78/admin/timesheet/create']"



# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = getpass.getpass("Ingresa tu contraseña: ")

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
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 3).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

#Timesheet
print("Entrando en Timesheet")
timesheet = WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, timesheet_xpath)))
timesheet_url = timesheet.get_attribute("href")
timesheet.click()
