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

#Usar buscador
"""
buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").send_keys("Auditoría")
time.sleep(tiempo_carga)
buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").clear()
time.sleep(tiempo_carga)
buscador=driver.find_element(By.XPATH,"(//INPUT[@type='search'])[2]").click()
"""
#Usar boton de registros
"""
buscador=driver.find_element(By.XPATH,"//SELECT[@name='DataTables_Table_0_length']").click()
time.sleep(tiempo_carga)
buscador=driver.find_element(By.XPATH,"//SELECT[@name='DataTables_Table_0_length']").send_keys("10") 
"""
#Usar botones para exportar

btnfiltro=driver.find_element(By.XPATH,"//I[@class='fas fa-filter']").click()
time.sleep(tiempo_modulos)
btnfiltro=driver.find_element(By.XPATH,"(//A[@class='dt-button dropdown-item buttons-columnVisibility active'])[4]").click() 
time.sleep(tiempo_espera2)
btnregresartodo=driver.find_element(By.XPATH,"//I[@class='fas fa-undo']").click() 
"""
xportarcsv=driver.find_element(By.XPATH,"//I[@class='fas fa-file-csv']").click()
exportarexcel=driver.find_element(By.XPATH,"//I[@class='fas fa-file-excel']").click()
exportarpdf=driver.find_element(By.XPATH,"//I[@class='fas fa-file-pdf']").click()
exportarimprimir=driver.find_element(By.XPATH,"//I[@class='fas fa-print']").click()
"""
""" estos botones van en conjunto

btnfiltro=driver.find_element(By.XPATH,"//I[@class='fas fa-filter']").click()
time.sleep(tiempo_modulos)
btnfiltro=driver.find_element(By.XPATH,"(//A[@class='dt-button dropdown-item buttons-columnVisibility active'])[4]").click() 
time.sleep(tiempo_espera2)
btnvertodo=driver.find_element(By.XPATH,"(//I[@class='fas fa-eye'])[1]").click()
btnregresartodo=driver.find_element(By.XPATH,"//I[@class='fas fa-undo']").click() 
"""
