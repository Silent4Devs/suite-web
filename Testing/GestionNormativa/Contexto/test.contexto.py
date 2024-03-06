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


tiempo_modulos = 3
tiempo_carga = 10
tiempo_espera = 2.5

menu_xpath = "//button[contains(@onclick,'menuHeader();')]"
gestion_xpath = "//a[@href='https://192.168.9.78/admin/iso27001/inicio-guia']"
analisis_brechas_xpath = "//a[@href='https://192.168.9.78/admin/analisis-brechas-2022-inicio' and contains(text(), 'Entrar')]"
continuar_xpath = "//a[@href='https://192.168.9.78/admin/iso27001/normas-guia' and normalize-space()='CONTINUAR']"
iso27001_xpath = "//div[@class='card-body']"


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
print("URL actual:", driver.current_url)

print("Dando clic en Gestión Normativa")
gestion=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, gestion_xpath)))
gestion_url = gestion.get_attribute("href")
gestion.click()
print("URL actual:", driver.current_url)

print("Dando clic en Continuar")
continuar=WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, continuar_xpath)))
continuar_url = continuar.get_attribute("href")
continuar.click()
print("URL actual:", driver.current_url)

print("Dando clic en ISO 27001")
url = "https://192.168.9.78/admin/iso27001/guia"
driver.get(url)
print("URL actual:", driver.current_url)

