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
driver.get('https://192.168.9.78/')

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

menu_hamburgesa=driver.find_element(By.XPATH,"//BUTTON[@class='btn-menu-header']").click()
time.sleep(tiempo_modulos)
modulo_timesheet=driver.find_element(By.XPATH,"//I[@class='bi bi-calendar-plus']").click()
time.sleep(tiempo_modulos)


#Abrir pestaña izquierda ">"

btn_flecha=driver.find_element(By.XPATH,"//DIV[@class='option-fixed-admin']").click()
time.sleep(tiempo_modulos)

btn_administrador=driver.find_element(By.XPATH,"//IMG[@src='https://192.168.9.78/img/calendar-icon-time-config.svg']").click()
time.sleep(tiempo_modulos)

#Entrar a modulo Proyectos

modulo_proyectos=driver.find_element(By.XPATH,"(//H5)[4]").click()
time.sleep(tiempo_modulos)

#Usar buscador

buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").click()
time.sleep(tiempo_modulos)

buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").send_keys("204")
time.sleep(tiempo_modulos)

#Usar boton editar

btn_editar=driver.find_element(By.XPATH,"//i[contains(@class,'fa-solid fa-pen-to-square')]").click()
time.sleep(tiempo_modulos)

#Modificar repositorio

modificar_campo=driver.find_element(By.XPATH,"//INPUT[@id='name_proyect']").send_keys("CAMBIO DE TEXTO PARA PRUEBA")
time.sleep(tiempo_modulos)

#Campo Tipo

buscador=driver.find_element(By.XPATH,"//SELECT[@id='tipo']").click()
time.sleep(tiempo_modulos)

buscador=driver.find_element(By.XPATH,"//SELECT[@id='tipo']").send_keys("Interno")
time.sleep(tiempo_modulos)

buscador=driver.find_element(By.XPATH,"//SELECT[@id='tipo']").click()
time.sleep(tiempo_modulos)

#Guardar cambios

modificar_campo=driver.find_element(By.XPATH,"//BUTTON[@class='btn btn-success'][text()=' Guardar']").click()
time.sleep(tiempo_modulos)

#Usar de nuevo buscador

buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").click()
time.sleep(tiempo_modulos)

buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").send_keys("204")
time.sleep(tiempo_modulos)

#Eliminar registro

btn_eliminar=driver.find_element(By.XPATH,"//I[@class='fas fa-trash-alt']").click()
time.sleep(tiempo_modulos)

btn_eliminar_confirmar=driver.find_element(By.XPATH,"//i[@title='Eliminar']").click()
time.sleep(tiempo_modulos)

#Boton regresar de pestaña

driver.back("https://192.168.9.78/admin/portal-comunicacion")