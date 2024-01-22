from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import getpass
from selenium.webdriver.support.ui import Select


tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
menu_xpath = "//i[contains(@class,'fa-solid fa-bars')]"
planes_de_accion_xpath = "//a[contains(.,'Planes de acción')]"
timesheet_xpath = "//i[@class='material-symbols-outlined' and text()='date_range']"
administrador_xpath = "//a[contains(.,'Administrador')]"
configurar_timesheet_xpath = "//a[contains(.,'Configuración Timesheet')]"
guardar_xpath = "//button[@class='btn btn-success' and contains(text(),'Guardar')]"
proyectos_xpath="(//a[contains(.,'Proyectos')])[2]"
registrar_timesheet_xpath="//a[contains(.,'Registrar TimeSheet')]"
proceso_xpath= "//button[contains(@class, 'btn btn-primary ml-3') and contains(text(), 'En Proceso')]"
cancelados_xpath= "//button[contains(@class, 'btn btn-primary ml-3') and contains(text(), 'Cancelados')]"
terminados_xpath= "//button[contains(@class, 'btn btn-primary ml-3') and contains(text(), 'Terminados')]"
todos_xpath= "//button[contains(@class, 'btn btn-primary ml-3') and contains(text(), 'Todos')]"
proyectos_xpath= "//a[@class='btn btn-success' and contains(text(),'Crear Proyecto')]"

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
#ADMINISTRADOR
def admin(driver, xpath):
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,xpath))).click()
admin(driver, administrador_xpath)

#PROYECTOS
print("Entrando a Proyectos")
proyectos = WebDriverWait(driver, 4).until(EC.presence_of_element_located((By.XPATH, proyectos_xpath)))
proyectos.click()


#Proyectos cancelados
print("Viendo los proyectos cancelados")
cancelados = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, cancelados_xpath)))
cancelados.click()

#CREAR PROYECTO
print("Creando un proyecto")
crear_proyecto = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, proyectos_xpath)))
crear_proyecto.click()

