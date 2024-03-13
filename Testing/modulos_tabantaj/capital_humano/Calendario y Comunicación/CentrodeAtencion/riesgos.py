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
modulo_calendario=driver.find_element(By.XPATH,"(//A[@href='https://192.168.9.78/admin/desk'])[2]").click()
time.sleep(tiempo_carga)



#Entrar a submodulo Riesgos
modulo_calendario=driver.find_element(By.XPATH,"(//A[@href='#'])[9]").click()
time.sleep(tiempo_modulos)

#Usar boton agregar Centro de atención
btncrear_reporte=driver.find_element(By.XPATH,"(//A[@class='btn btn-danger'][text()='Crear reporte'])[2]").click()
time.sleep(tiempo_carga)

#Llenar campos obligatorios para Icidentes de seguridad

titulo_incidente=driver.find_element(By.XPATH,"(//INPUT[@class='form-control'])[1]").send_keys("TITULO RIESGO DE PRUEBA")
time.sleep(tiempo_modulos)

campo_fechayhora=driver.find_element(By.XPATH,"//INPUT[@type='datetime-local']").send_keys("17/12/1998 - 04:30 a.m")
time.sleep(tiempo_modulos)

campo_sede=driver.find_element(By.XPATH,"(//SELECT[@class='form-control'])[1]").send_keys("Torre Murano")
time.sleep(tiempo_modulos)

campo_ubicacion_exacta=driver.find_element(By.XPATH,"//INPUT[@type='']").send_keys("UBICACION DE PRUEBA")
time.sleep(tiempo_modulos)

campo_describa_incidente=driver.find_element(By.XPATH,"//TEXTAREA[@name='descripcion']").send_keys("DESCRIPCION DE PRUEBA,DESCRIPCION DE PRUEBA,DESCRIPCION DE PRUEBA")
time.sleep(tiempo_modulos)

btn_areas_afectadas=driver.find_element(By.XPATH,"//SELECT[@id='activos']").click()
time.sleep(tiempo_espera)
btn_areas_afectadas=driver.find_element(By.XPATH,"//SELECT[@id='activos']").send_keys("Desarrollo")

#Enviar Cambios
btnguardar=driver.find_element(By.XPATH,"//INPUT[@type='submit']").click()