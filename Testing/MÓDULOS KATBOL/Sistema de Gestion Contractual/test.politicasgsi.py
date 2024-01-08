from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.firefox.options import Options

import time

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
menu_xpath = "//i[contains(@class,'fa-solid fa-bars')]"
gestion_normativa_xpath="//a[contains(.,'Gestión Normativa')]"
continuar_xpath = "//a[contains(.,'CONTINUAR')]"
seguridad_informacion_xpath = "//a[@href='https://192.168.9.78/admin/iso27001/guia']"
liderazgo_btn_xpath = "//li[@data-id='content-guia-iso-2' and @class='paso-menu-2']"
politica_sistema_gestion_xpath = "//a[@href='https://192.168.9.78/admin/politica-sgsis' and @class='btn-entrar']"
datatable_xpath = "//div[@class='datatable-fix datatable-rds']"
datatable_processing_xpath = "//div[@id='datatable-PoliticaSgsi_processing']"
opciones_xpath = "//button[@class='btn btn-action-show-datatables-global d-none']"



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

#Gestión Normativa
print("Dando click a Gestion Normativa")
gestion_normativa = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, gestion_normativa_xpath)))
gestion_normativa_url = gestion_normativa.get_attribute("href")
gestion_normativa.click()


#Continuar
print("Dando click a Continuar")
continuar_btn = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, continuar_xpath)))
continuar_btn_url = continuar_btn.get_attribute("href")
continuar_btn.click()


#SEGURIDAD DE LA INFORMACION
print("Dando click a Seguridad de la Información")
informacion_btn=WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, seguridad_informacion_xpath)))
informacion_btn_url=informacion_btn.get_attribute("href")
informacion_btn.click()


#LIDERAZGO
print("Dando click a Liderazgo")
liderazgo_btn=WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,liderazgo_btn_xpath) ))
liderazgo_btn_url=liderazgo_btn.get_attribute("href")
liderazgo_btn.click()

#POLÍTICA DE SISTEMA DE GESTIÓN
print("Dando click a Política de Sistema de Gestión")
politica_sistema_gestion_btn=WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, politica_sistema_gestion_xpath)))
politica_sistema_gestion_btn_url=politica_sistema_gestion_btn.get_attribute("href")
politica_sistema_gestion_btn.click()

#Datatable
print("Datatable")
datatable=WebDriverWait(driver, 1).until(EC.presence_of_element_located((By.XPATH, datatable_processing_xpath)))
driver.refresh()
time.sleep(2.7)
opc=WebDriverWait(driver, 24).until(EC.presence_of_element_located((By.XPATH, opciones_xpath)))
opc.click()
