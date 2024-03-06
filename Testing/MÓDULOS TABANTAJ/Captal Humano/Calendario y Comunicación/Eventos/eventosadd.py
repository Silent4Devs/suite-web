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

#Usar boton agregar dia festivo
btnfiltro=driver.find_element(By.XPATH,"//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']").click()
time.sleep(tiempo_carga)

#Llenar campos obligatorios para dias festivos
btnnombre=driver.find_element(By.XPATH,"//INPUT[@id='nombre']").send_keys("REGISTRO DE EVENTO DE PRUEBA")
time.sleep(tiempo_modulos)
btnfechaclear=driver.find_element(By.XPATH,"//INPUT[@id='fecha']").clear()
time.sleep(tiempo_modulos)
btnfecha=driver.find_element(By.XPATH,"//INPUT[@id='fecha']").send_keys("03/01/2024 - 03/25/2024")
time.sleep(tiempo_modulos)
btnfechaclear=driver.find_element(By.XPATH,"//BUTTON[@class='applyBtn btn btn-sm btn-primary'][text()='Apply']").click()
time.sleep(tiempo_modulos)
btncategorias=driver.find_element(By.XPATH,"//INPUT[@id='categoria']").send_keys("EVENTOS PARA PRUEBAS AUTOMATIZADAS")
time.sleep(tiempo_modulos)
btndescripcion=driver.find_element(By.XPATH,"//INPUT[@id='descripcion']").send_keys("EVENTOS PARA PRUEBAS AUTOMATIZADAS")
time.sleep(tiempo_modulos)

#Guardar Cambios y/o Cancelar
#btnguardar=driver.find_element(By.XPATH,"//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']").click()
btncancelar=driver.find_element(By.XPATH,"//a[@href='https://192.168.9.78/admin/tabla-calendario/index' and normalize-space()='Cancelar']").click()

