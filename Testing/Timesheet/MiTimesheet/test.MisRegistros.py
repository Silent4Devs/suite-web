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

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
timesheet_xpath = "//i[@class='material-symbols-outlined' and text()='date_range']"
administrador_xpath = "//a[contains(.,'Administrador')]"
configurar_timesheet_xpath = "//a[contains(.,'Configuración Timesheet')]"
guardar_xpath = "//button[@class='btn btn-success' and contains(text(),'Guardar')]"
clientes_xpath="//a[contains(.,'Clientes')]"
registrar_timesheet_xpath="//a[contains(.,'Registrar TimeSheet')]"
eliminar_icono_xpath="(//i[@class='fa-solid fa-trash-can'])[1]"
confirmar_eliminar_xpath="(//button[contains(.,'Eliminar Cliente')])[1]"
mis_registros_xpath="//a[contains(.,'Mis Registros')]"
borrador_xpath="//button[@class='btn btn-primary' and @id='btn_papelera']"
pendientes_xpath="//button[@class='btn btn-primary' and @id='btn_pendiente']"
aprobados_xpath="//button[@class='btn btn-primary' and @id='btn_aprobado']"
rechazados_xpath="//button[@class='btn btn-primary' and @id='btn_rechazado']"


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
timesheet = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, timesheet_xpath)))
timesheet_url = timesheet.get_attribute("href")
timesheet.click()

#Mis Registros
print("Entrando en Mis Registros")
mis_registros = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, mis_registros_xpath)))
mis_registros_url = mis_registros.get_attribute("href")
mis_registros.click()

    #Borrador
print("Entrando en Borrador")
borrador=WebDriverWait(driver, 2).until(EC.presence_of_element_located((By.XPATH, borrador_xpath)))
borrador_url = borrador.get_attribute("href")
borrador.click()
time.sleep(1)

    #Pendientes
print("Entrando en Pendientes")
pendientes=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, pendientes_xpath)))
pendientes_url = pendientes.get_attribute("href")
pendientes.click()
time.sleep(1)

    #Aprobados
print("Entrando en Aprobados")
aprobados=WebDriverWait(driver, 4).until(EC.presence_of_element_located((By.XPATH, aprobados_xpath)))
aprobados_url = aprobados.get_attribute("href")
aprobados.click()
time.sleep(1)


    #Rechazados
print("Entrando en Rechazados")
rechazados=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, rechazados_xpath)))
rechazados_url = rechazados.get_attribute("href")
rechazados.click()
time.sleep(1)


