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
modulocalendario=driver.find_element(By.XPATH,"//A[@href='https://192.168.9.78/admin/comunicacion-sgis']").click()
time.sleep(tiempo_carga)

#Usar boton agregar Comunicados
btnregistrar=driver.find_element(By.XPATH,"//A[@href='https://192.168.9.78/admin/comunicacion-sgis/create'][text()='Registrar Comunicado']").click()
time.sleep(tiempo_carga)

#Llenar campos obligatorios para dias festivos
campotitulocomunicado=driver.find_element(By.XPATH,"//INPUT[@id='titulo']").send_keys("COMUNICADO DE PRUEBA")
time.sleep(tiempo_modulos)
campocontenido=driver.find_element(By.XPATH,"//iframe[@src='' and @frameborder='0' and @class='cke_wysiwyg_frame cke_reset' and @style='width: 100%; height: 100%;' and @title='Editor de Texto Enriquecido, descripcion' and @aria-describedby='cke_65' and @tabindex='0' and @allowtransparency='true']").send_keys("CAMPO DE PRUEBA, CAMPO DE PRUEBA,CAMPO DE PRUEBA")
time.sleep(tiempo_modulos)
campopublicaren=driver.find_element(By.XPATH,"//SELECT[@id='publicar_en']").send_keys("PUBLICAR DE PRUEBA,PUBLICAR DE PRUEBA")
time.sleep(tiempo_modulos)
btntodalaempresa=driver.find_element(By.XPATH,"//SELECT[@id='evaluados_objetivo']").send_keys("Toda la empresa")
time.sleep(tiempo_modulos)
campofechainicio=driver.find_element(By.XPATH,"//INPUT[@id='fecha_programable']").send_keys("03/01/2024")
time.sleep(tiempo_modulos)
campofechafin=driver.find_element(By.XPATH,"//INPUT[@id='fecha_programable_fin']").send_keys("07/05/2024")
time.sleep(tiempo_modulos)
#Guardar Cambios
btnguardar=driver.find_element(By.XPATH,"//button[@class='btn btn-danger' and normalize-space(text())='Guardar']").click()

