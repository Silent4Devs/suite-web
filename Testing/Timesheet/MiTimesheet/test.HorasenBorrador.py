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
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Login
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("ranas289")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

#HORAS EN BORRADOR
time.sleep(tiempo_carga)
btn = driver.find_element(By.XPATH, "//font[@class='letra_blanca'][contains(.,'Timesheet')]")
btn.click()
time.sleep(tiempo_modulos)
btn = driver.find_element(By.XPATH, "//a[contains(.,'Horas en Borrador')]")
time.sleep(tiempo_modulos)
btn.click()
time.sleep(tiempo_carga)

#TIMESHEET: BORRADOR
    #CSV
csv_btn=driver.find_element(By.XPATH,"//i[contains(@class,'fas fa-file-csv')]")
csv_btn.click()
time.sleep(tiempo_espera)
    #EXCEL
excel_btn=driver.find_element(By.XPATH,"//i[contains(@class,'fas fa-file-excel')]")
excel_btn.click()
time.sleep(tiempo_espera)
    #IMPRIMIR
#imprimir_btn=driver.find_element(By.XPATH,"//i[contains(@class,'fas fa-print')]")
#imprimir_btn.click()
#time.sleep(tiempo_espera)
    #FILTRO
filtro_btn=driver.find_element(By.XPATH,"//i[contains(@class,'fas fa-filter')]")
filtro_btn.click()
time.sleep(tiempo_espera)

# Repite la acción dos veces
for _ in range(2):
    # Fin de semana
    select_container1_xpath = f"//span[contains(.,'Fin de semana')]"
    select_container1 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container1_xpath)))
    select_container1.click()
    time.sleep(tiempo_espera)

    #Estatus
    select_container2_xpath = f"//span[contains(.,'Estatus')]"
    select_container2 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container2_xpath)))
    select_container2.click()
    time.sleep(tiempo_espera)
    #Opciones
    select_container3_xpath = f"//span[contains(.,'opciones')]"
    select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
    select_container3.click()
    time.sleep(tiempo_espera)

#Visualizar
    eye_btn=driver.find_element(By.XPATH,"(//i[contains(@class,'fa-solid fa-eye')])[1]")
    eye_btn.click()
    time.sleep(tiempo_carga)

#Regresar
driver.back()

#Editar
edit_btn=driver.find_element(By.XPATH,"(//i[contains(@class,'fa-solid fa-pen-to-square')])[1]")
edit_btn.click()
time.sleep(tiempo_carga)
    #Registra Horas
registrar_btn=driver.find_element(By.XPATH,"//label[@for='estatus_pendiente'][contains(.,'Registrar')]")
registrar_btn.click()
time.sleep(tiempo_carga)
    #Enviar a Aprobación
aprobacion_btn=driver.find_element(By.XPATH,"//button[contains(.,'Enviar a Aprobación')]")
aprobacion_btn.click()
time.sleep(tiempo_carga)
ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(.,'OK')]")
ok_btn.click()
time.sleep(tiempo_carga)

# Cerrar el navegador al finalizar
driver.quit()
