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

#Login with errornous credentials
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("12345")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

# Esperamos de nuevo la pantalla de inicio de sesión
time.sleep(tiempo_espera)
fgpw=driver.find_element(By.XPATH,"//a[@class='btn'][contains(.,'¿Olvidó su contraseña?')]")
time.sleep(tiempo_modulos)
fgpw.click()

# Esperamos la interfaz de recuperación de contraseña
time.sleep(tiempo_espera)
mail=driver.find_element(By.XPATH,"//input[contains(@type,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
btnrecuperar=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Recuperar contraseña')]")
btnrecuperar.click()

# Esperar hasta 10 segundos para encontrar un elemento que indique el envio de recuperación de contraseña
try:
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//a[contains(.,'contacto@silent4business.com')]"))
    )
    print("Se envió el correo de recuperación de contraseña")
except TimeoutException:
    print("No se envió el correo de recuperación de contraseña")
