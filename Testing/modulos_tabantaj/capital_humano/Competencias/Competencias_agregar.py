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
tiempo_modulos=4
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


#TestEntraraModulos
#Resgistrar Competencias

btn=driver.find_element(By.XPATH,"//A[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/competencias']")
btn.click()
time.sleep(tiempo_modulos)
btn2=driver.find_element(By.XPATH,"//A[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/competencias/create'][text()='Registrar Competencia']")
btn2.click()
time.sleep(tiempo_modulos)

#TestLlenarCampos
nombre_competencia=driver.find_element(By.XPATH,"//INPUT[@id='nombre']").send_keys("PRUEBASAUTCOPETENCIAS")
time.sleep(tiempo_modulos)
descripcion=driver.find_element(By.XPATH,"(//TEXTAREA[@class='form-control '])[2]").send_keys("PruebaAutomatizada")
time.sleep(tiempo_modulos)

tipocompetencia=driver.find_element(By.XPATH,"//SELECT[@id='tipo_id']").send_keys("Competencia Gerencial")

time.sleep(tiempo_modulos)

btn3=driver.find_element(By.XPATH,"//BUTTON[@type='submit'][text()='Guardar']")
btn3.click()




