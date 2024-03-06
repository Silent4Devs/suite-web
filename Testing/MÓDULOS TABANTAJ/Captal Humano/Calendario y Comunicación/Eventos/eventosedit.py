from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
import time
tiempo_espera2=15
tiempo_modulos=5
tiempo_carga=10
tiempo_espera=2.5
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/admin/capital-humano')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Login
usr=driver.find_element(By.XPATH,"//INPUT[@id='email']").send_keys("cesar.escobar@silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//INPUT[@id='password']").send_keys("6&b5lzoX!E")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

time.sleep(tiempo_modulos)

#Entrar a modulos

modulo=driver.find_element(By.XPATH,"//A[@id='nav-calendario-comunicacion-tab']")
modulo.click()
modulocalendario=driver.find_element(By.XPATH,"//A[@href='https://192.168.9.78/admin/tabla-calendario/index']").click()
time.sleep(tiempo_carga)

#Usar botones editables

btnedit=driver.find_element(By.XPATH,"(//I[@class='fa-solid fa-ellipsis-vertical'])[1]").click()
time.sleep(tiempo_modulos)

#Usar boton ver 
"""
btnver=driver.find_element(By.XPATH,"(//I[@class='fas fa-eye'])[2]").click()
time.sleep(tiempo_modulos)
btnreturn=driver.find_element(By.XPATH,"//a[@class='btn btn-default' and normalize-space(text())='Regresar']").click()
"""
#Usar boton editar
"""
btnedit=driver.find_element(By.XPATH,"(//I[@class='fas fa-edit'])[1]").click()
time.sleep(tiempo_modulos)
campodescripcion=driver.find_element(By.XPATH,"//INPUT[@id='nombre']").send_keys("ACTUALIZACION DE CAMPOS")
time.sleep(tiempo_modulos)
btnguardar=driver.find_element(By.XPATH,"//button[@class='btn btn-danger' and normalize-space(text())='Guardar']").click()
"""
#Usar boton eliminar y/o cancelar

btndelate=driver.find_element(By.XPATH,"(//I[@class='fas fa-trash'])[1]").click()
time.sleep(tiempo_espera)
#btmcancelar=driver.find_element(By.XPATH,"(//DIV[@class='mr-4 cancelar btn btn-outline-secondary'][text()='Cancelar'])[1]").click()
btnconfdelate=driver.find_element(By.XPATH,"(//BUTTON[@class='eliminar btn btn-info'][text()='Eliminar'])[1]").click()