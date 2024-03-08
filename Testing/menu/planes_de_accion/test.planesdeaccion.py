from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
menu_xpath = "//i[contains(@class,'fa-solid fa-bars')]"
planes_de_accion_xpath = "//a[contains(.,'Planes de acción')]"


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
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

#Menú Hamburguesa
print("Dando click al menú")
menu=driver.find_element(By.XPATH,menu_xpath)
WebDriverWait(driver, 1).until(EC.presence_of_element_located((By.XPATH, menu_xpath)))
menu.click()

#Planes de Acción
print("Dando click a Planes de Acción")
plan=driver.find_element(By.XPATH,planes_de_accion_xpath)
WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, planes_de_accion_xpath)))
plan.click()
