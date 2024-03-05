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
import pyautogui

tiempo_modulos = 3
tiempo_carga = 10
tiempo_espera = 2.5

menu_xpath = "//button[contains(@onclick,'menuHeader();')]"
gestion_xpath = "//a[@href='https://192.168.9.78/admin/capital-humano']"
competencias_xpath = "//a[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/competencias'][contains(.,'Competencias')]"

registrar_competencia_xpath = "//a[contains(.,'Registrar Competencia')]"
nombre_competencia_xpath = "//input[@id='nombre']"
tipo_competencia_xpath = "//select[@class='form-control' and @name='tipo_id' and @id='tipo_id']"
descripcion_xpath = "//textarea[@name='descripcion']"
imagen_xpath = "//span[@id='texto-imagen' and contains(@class, 'pl-2')]"



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
    time.sleep(4)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    print("URL actual:", driver.current_url)

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 3).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

#menú hamburguesa
print("Dando clic en el menú")
menu = WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, menu_xpath)))
menu_url = menu.get_attribute("href")
menu.click()
print("Dando clic en Gestión Normativa")
gestion=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, gestion_xpath)))
gestion_url = gestion.get_attribute("href")
gestion.click()
print("URL actual:", driver.current_url)

#Competencias
print("Dando clic en Competencias")
competencias=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, competencias_xpath)))
competencias_url = competencias.get_attribute("href")
competencias.click()
print("URL actual:", driver.current_url)
#Registrar Competencia
print("Dando clic en Registrar Competencia")
registrar_competencia=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, registrar_competencia_xpath)))
registrar_competencia_url = registrar_competencia.get_attribute("href")
registrar_competencia.click()
print("URL actual:", driver.current_url)

texto_ingresado = input("Ingresa el Nombre de la Competencia: ")
input_element = driver.find_element(By.XPATH, nombre_competencia_xpath)
input_element.clear()
input_element.send_keys(texto_ingresado)

elemento_select = driver.find_element(By.ID,"tipo_id")
dropdown = Select(elemento_select)
print("Competencias disponibles:")
opciones = dropdown.options
for i, opcion in enumerate(opciones, start=1):
    print(f"{i}. {opcion.text}")
opcion_elegida = int(input("Elige una opción (ingresa el número): "))
dropdown.select_by_index(opcion_elegida - 1)

text_ingresado1=input("Ingresa la descripción de la competencia: ")
input_element1 = driver.find_element(By.XPATH, descripcion_xpath)
input_element1.clear()
input_element1.send_keys(text_ingresado1)


