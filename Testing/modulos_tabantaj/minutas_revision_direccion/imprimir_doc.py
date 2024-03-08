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

modulo=driver.find_element(By.XPATH,"//INPUT[@type='search']").send_keys("minutasaltadireccions")
time.sleep(tiempo_modulos)
modulo_calendario=driver.find_element(By.XPATH,"//LI[@class='list-group-item text-black']").click()


#Entrar a filro #10
modulo_filtro=driver.find_element(By.XPATH,"//SELECT[@name='datatable-Minutasaltadireccion_length']").click()
time.sleep(tiempo_carga)
modulo_filtro=driver.find_element(By.XPATH,"//SELECT[@name='datatable-Minutasaltadireccion_length']").send_keys("10")
modulo_filtro=driver.find_element(By.XPATH,"//SELECT[@name='datatable-Minutasaltadireccion_length']").click()
time.sleep(tiempo_carga)


#Entrar a repositorio
btnentrar_repositorio=driver.find_element(By.XPATH,"(//I[@class='fa-solid fa-ellipsis-vertical'])[7]").click()
time.sleep(tiempo_carga)

btn_ver=driver.find_element(By.XPATH,"(//I[@class='fa fa-eye'])[7]").click()

time.sleep(tiempo_carga)

#Usar boton imprimir
btnimprimir=driver.find_element(By.XPATH,"//BUTTON[@class='boton-transparentev2']").click()
time.sleep(tiempo_carga)
