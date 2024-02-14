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
tiempo_nespera=10
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

menu_hambuerguesa=driver.find_element(By.XPATH,"//BUTTON[@class='btn-menu-header']")
menu_hambuerguesa.click()
time.sleep(tiempo_modulos)

#Entrar a Submodulo Ajustes SG
btnAjustesSG=driver.find_element(By.XPATH,"(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[1]").click()
time.sleep(tiempo_modulos)

#Entrar a Lista de Distribución
btnlista_de_distribucion=driver.find_element(By.XPATH,"//a[@href='https://192.168.9.78/admin/lista-distribucion' and normalize-space()='Lista de distribución']").click()
time.sleep(tiempo_modulos)

#Usar boton 3 puntos
btn3puntos=driver.find_element(By.XPATH,"(//I[@class='fa-solid fa-ellipsis-vertical'])[1]").click()
time.sleep(tiempo_modulos)

#Usar boton ver
btnnombre=driver.find_element(By.XPATH,"(//I[@class='fa fa-eye'])[1]").click()
time.sleep(tiempo_modulos)

#Usar boton regresar
btnRegresar=driver.find_element(By.XPATH,"//A[@id='btn_cancelar']").click()
time.sleep(tiempo_modulos)
  



